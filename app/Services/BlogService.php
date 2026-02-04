<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class BlogService
{
    protected string $blogPath;

    protected MarkdownRenderer $markdown;

    public function __construct(MarkdownRenderer $markdown)
    {
        $this->blogPath = resource_path('blog');
        $this->markdown = $markdown;
    }

    /**
     * Get all published blog posts sorted by date.
     */
    public function getAllPosts(): Collection
    {
        $cacheKey = 'blog.all_posts';

        if (app()->environment('production')) {
            return Cache::remember($cacheKey, 3600, fn () => $this->loadAllPosts());
        }

        return $this->loadAllPosts();
    }

    /**
     * Load all blog posts from markdown files.
     */
    protected function loadAllPosts(): Collection
    {
        if (! File::exists($this->blogPath)) {
            return collect();
        }

        $files = File::glob($this->blogPath.'/*.md');
        $posts = collect();

        foreach ($files as $file) {
            $filename = basename($file);

            // Skip config files
            if (Str::startsWith($filename, '_')) {
                continue;
            }

            $content = File::get($file);
            $parsed = $this->parseFrontmatter($content);

            // Extract date from filename (format: YYYY-MM-DD-slug.md)
            preg_match('/^(\d{4}-\d{2}-\d{2})-(.+)\.md$/', $filename, $matches);
            $fileDate = $matches[1] ?? null;
            $fileSlug = $matches[2] ?? Str::slug(pathinfo($filename, PATHINFO_FILENAME));

            $slug = $parsed['frontmatter']['slug'] ?? $fileSlug;
            $publishedAt = $parsed['frontmatter']['published_at'] ?? $fileDate;

            // Skip if no publish date or in future
            if (! $publishedAt || $publishedAt > now()->format('Y-m-d')) {
                continue;
            }

            $posts->push([
                'title' => $parsed['frontmatter']['title'] ?? Str::title(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'excerpt' => $parsed['frontmatter']['excerpt'] ?? Str::limit(strip_tags($parsed['content']), 150),
                'author' => $this->getAuthor($parsed['frontmatter']['author'] ?? 'folio-team'),
                'category' => $parsed['frontmatter']['category'] ?? 'General',
                'featured' => filter_var($parsed['frontmatter']['featured'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'published_at' => $publishedAt,
                'date' => \Carbon\Carbon::parse($publishedAt)->format('M d, Y'),
                'read_time' => ($parsed['frontmatter']['read_time'] ?? $this->estimateReadTime($parsed['content'])).' min read',
                'featured_image' => $parsed['frontmatter']['featured_image'] ?? null,
                'tags' => $this->parseTags($parsed['frontmatter']['tags'] ?? ''),
                'file' => $file,
            ]);
        }

        return $posts->sortByDesc('published_at')->values();
    }

    /**
     * Get a single blog post by slug.
     */
    public function getPost(string $slug): ?array
    {
        $cacheKey = 'blog.post.'.md5($slug);

        if (app()->environment('production')) {
            return Cache::remember($cacheKey, 3600, fn () => $this->loadPost($slug));
        }

        return $this->loadPost($slug);
    }

    /**
     * Load a single post from file.
     */
    protected function loadPost(string $slug): ?array
    {
        // First try to find post from all posts
        $posts = $this->loadAllPosts();
        $post = $posts->firstWhere('slug', $slug);

        if (! $post) {
            return null;
        }

        $content = File::get($post['file']);
        $parsed = $this->parseFrontmatter($content);

        return array_merge($post, [
            'content' => $parsed['content'],
            'html' => $this->markdown->toHtml($parsed['content']),
        ]);
    }

    /**
     * Get featured posts.
     */
    public function getFeaturedPosts(): Collection
    {
        return $this->getAllPosts()->where('featured', true);
    }

    /**
     * Get related posts based on category and tags.
     */
    public function getRelatedPosts(string $slug, int $limit = 3): Collection
    {
        $currentPost = $this->getPost($slug);

        if (! $currentPost) {
            return collect();
        }

        return $this->getAllPosts()
            ->reject(fn ($post) => $post['slug'] === $slug)
            ->sortByDesc(function ($post) use ($currentPost) {
                $score = 0;
                if ($post['category'] === $currentPost['category']) {
                    $score += 10;
                }
                $commonTags = array_intersect($post['tags'], $currentPost['tags']);
                $score += count($commonTags) * 5;

                return $score;
            })
            ->take($limit)
            ->values();
    }

    /**
     * Get authors configuration.
     */
    public function getAuthors(): array
    {
        $path = $this->blogPath.'/_authors.json';

        if (! File::exists($path)) {
            return [];
        }

        return json_decode(File::get($path), true) ?? [];
    }

    /**
     * Get a single author's data.
     */
    public function getAuthor(string $key): array
    {
        $authors = $this->getAuthors();

        return $authors[$key] ?? [
            'name' => Str::title(str_replace('-', ' ', $key)),
            'avatar' => null,
            'bio' => '',
        ];
    }

    /**
     * Parse YAML frontmatter from markdown content.
     *
     * @return array{frontmatter: array, content: string}
     */
    protected function parseFrontmatter(string $content): array
    {
        $pattern = '/^---\s*\n(.*?)\n---\s*\n(.*)$/s';

        if (preg_match($pattern, $content, $matches)) {
            $frontmatter = [];
            $lines = explode("\n", trim($matches[1]));

            foreach ($lines as $line) {
                if (str_contains($line, ':')) {
                    [$key, $value] = explode(':', $line, 2);
                    $value = trim($value);
                    // Remove surrounding quotes
                    if (preg_match('/^["\'](.*)["\']\s*$/', $value, $quoteMatches)) {
                        $value = $quoteMatches[1];
                    }
                    $frontmatter[trim($key)] = $value;
                }
            }

            return [
                'frontmatter' => $frontmatter,
                'content' => trim($matches[2]),
            ];
        }

        return [
            'frontmatter' => [],
            'content' => $content,
        ];
    }

    /**
     * Parse tags from frontmatter value.
     */
    protected function parseTags(string $tagsValue): array
    {
        if (empty($tagsValue)) {
            return [];
        }

        // Handle JSON array format: ["tag1", "tag2"]
        if (Str::startsWith($tagsValue, '[')) {
            $decoded = json_decode($tagsValue, true);

            return is_array($decoded) ? $decoded : [];
        }

        // Handle comma-separated format
        return array_map('trim', explode(',', $tagsValue));
    }

    /**
     * Estimate read time based on word count.
     */
    protected function estimateReadTime(string $content): int
    {
        $wordCount = str_word_count(strip_tags($content));
        $wordsPerMinute = 200;

        return max(1, (int) ceil($wordCount / $wordsPerMinute));
    }
}
