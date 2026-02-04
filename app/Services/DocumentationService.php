<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class DocumentationService
{
    protected string $docsPath;

    protected MarkdownRenderer $markdown;

    public function __construct(MarkdownRenderer $markdown)
    {
        $this->docsPath = resource_path('docs');
        $this->markdown = $markdown;
    }

    /**
     * Get the sidebar configuration.
     *
     * @return array{title: string, version: string, sections: array}
     */
    public function getSidebar(): array
    {
        $cacheKey = 'docs.sidebar';

        if (app()->environment('production')) {
            return Cache::remember($cacheKey, 3600, fn () => $this->loadSidebar());
        }

        return $this->loadSidebar();
    }

    /**
     * Load sidebar configuration from JSON file.
     */
    protected function loadSidebar(): array
    {
        $path = $this->docsPath.'/_sidebar.json';

        if (! File::exists($path)) {
            return ['title' => 'Documentation', 'version' => '1.0', 'sections' => []];
        }

        return json_decode(File::get($path), true) ?? [];
    }

    /**
     * Get a documentation page by slug.
     *
     * @return array{title: string, description: string, content: string, html: string}|null
     */
    public function getPage(string $slug): ?array
    {
        $cacheKey = 'docs.page.'.md5($slug);

        if (app()->environment('production')) {
            return Cache::remember($cacheKey, 3600, fn () => $this->loadPage($slug));
        }

        return $this->loadPage($slug);
    }

    /**
     * Load a page from the markdown file.
     */
    protected function loadPage(string $slug): ?array
    {
        $path = $this->docsPath.'/'.$slug.'.md';

        if (! File::exists($path)) {
            return null;
        }

        $content = File::get($path);
        $parsed = $this->parseFrontmatter($content);

        return [
            'title' => $parsed['frontmatter']['title'] ?? Str::title(str_replace('-', ' ', basename($slug))),
            'description' => $parsed['frontmatter']['description'] ?? '',
            'content' => $parsed['content'],
            'html' => $this->renderMarkdown($parsed['content']),
            'slug' => $slug,
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
                    $frontmatter[trim($key)] = trim($value);
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
     * Render markdown to HTML using spatie/laravel-markdown.
     *
     * This provides:
     * - Syntax highlighting via Shiki
     * - GitHub Flavored Markdown (tables, task lists)
     * - Auto-linked URLs
     * - Anchor links on headings
     */
    public function renderMarkdown(string $content): string
    {
        return $this->markdown->toHtml($content);
    }

    /**
     * Extract table of contents from HTML.
     *
     * @return array<array{id: string, title: string, level: int}>
     */
    public function getTableOfContents(string $html): array
    {
        $toc = [];

        // Match headings with id attributes (added by spatie/laravel-markdown)
        $pattern = '/<h([2-3])[^>]*id="([^"]+)"[^>]*>.*?<a[^>]*>([^<]+)<\/a>.*?<\/h\1>/is';

        if (preg_match_all($pattern, $html, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $toc[] = [
                    'id' => $match[2],
                    'title' => trim(strip_tags($match[3])),
                    'level' => (int) $match[1],
                ];
            }
        }

        // Fallback: try matching headings without anchors
        if (empty($toc)) {
            $pattern = '/<h([2-3])[^>]*id="([^"]+)"[^>]*>([^<]+)<\/h\1>/i';

            if (preg_match_all($pattern, $html, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $toc[] = [
                        'id' => $match[2],
                        'title' => trim(strip_tags($match[3])),
                        'level' => (int) $match[1],
                    ];
                }
            }
        }

        return $toc;
    }

    /**
     * Add IDs to headings in HTML for anchor links.
     * Note: spatie/laravel-markdown already does this, but this is kept for compatibility.
     */
    public function addHeadingIds(string $html): string
    {
        // spatie/laravel-markdown already adds IDs when 'add_anchors_to_headings' is true
        return $html;
    }

    /**
     * Get previous and next pages for navigation.
     *
     * @return array{prev: array|null, next: array|null}
     */
    public function getNavigation(string $currentSlug): array
    {
        $sidebar = $this->getSidebar();
        $allPages = [];

        foreach ($sidebar['sections'] ?? [] as $section) {
            foreach ($section['items'] ?? [] as $item) {
                $allPages[] = [
                    'title' => $item['title'],
                    'slug' => $item['slug'],
                    'section' => $section['title'],
                ];
            }
        }

        $currentIndex = null;
        foreach ($allPages as $index => $page) {
            if ($page['slug'] === $currentSlug) {
                $currentIndex = $index;
                break;
            }
        }

        return [
            'prev' => $currentIndex !== null && $currentIndex > 0 ? $allPages[$currentIndex - 1] : null,
            'next' => $currentIndex !== null && $currentIndex < count($allPages) - 1 ? $allPages[$currentIndex + 1] : null,
        ];
    }

    /**
     * Get the section a page belongs to.
     */
    public function getPageSection(string $slug): ?string
    {
        $sidebar = $this->getSidebar();

        foreach ($sidebar['sections'] ?? [] as $section) {
            foreach ($section['items'] ?? [] as $item) {
                if ($item['slug'] === $slug) {
                    return $section['title'];
                }
            }
        }

        return null;
    }

    /**
     * Check if a page exists.
     */
    public function pageExists(string $slug): bool
    {
        return File::exists($this->docsPath.'/'.$slug.'.md');
    }

    /**
     * Get all pages for search indexing.
     *
     * @return array<array{title: string, slug: string, description: string, section: string}>
     */
    public function getAllPages(): array
    {
        $sidebar = $this->getSidebar();
        $pages = [];

        foreach ($sidebar['sections'] ?? [] as $section) {
            foreach ($section['items'] ?? [] as $item) {
                $page = $this->getPage($item['slug']);
                if ($page) {
                    $pages[] = [
                        'title' => $page['title'],
                        'slug' => $page['slug'],
                        'description' => $page['description'],
                        'section' => $section['title'],
                    ];
                }
            }
        }

        return $pages;
    }
}
