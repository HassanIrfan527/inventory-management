<div class="bg-white dark:bg-zinc-950">
    {{-- Hero Header --}}
    <div class="relative bg-zinc-50 dark:bg-zinc-900/50 border-b border-zinc-200 dark:border-zinc-800">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 py-12 sm:py-16">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm mb-8">
                <a href="{{ route('blog.index') }}" wire:navigate class="text-zinc-500 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400 transition-colors">
                    Blog
                </a>
                <flux:icon name="chevron-right" class="size-4 text-zinc-400" />
                <span class="text-zinc-500 dark:text-zinc-400">{{ $post['category'] ?? 'Article' }}</span>
            </nav>

            {{-- Category Badge --}}
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-400">
                    {{ $post['category'] ?? 'General' }}
                </span>
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $post['read_time'] ?? '5 min read' }}</span>
            </div>

            {{-- Title --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-zinc-900 dark:text-white leading-tight mb-6">
                {{ $post['title'] ?? 'Blog Post' }}
            </h1>

            {{-- Excerpt --}}
            @if(!empty($post['excerpt']))
                <p class="text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 max-w-3xl">
                    {{ $post['excerpt'] }}
                </p>
            @endif

            {{-- Author & Date --}}
            <div class="flex items-center gap-4 mt-8">
                <div class="h-12 w-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-lg font-bold text-emerald-700 dark:text-emerald-400">
                    {{ substr($post['author']['name'] ?? 'F', 0, 1) }}
                </div>
                <div>
                    <div class="font-semibold text-zinc-900 dark:text-white">
                        {{ $post['author']['name'] ?? 'Folio Team' }}
                    </div>
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $post['date'] ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Featured Image --}}
    @if(!empty($post['featured_image']))
        <div class="max-w-5xl mx-auto px-6 lg:px-8 -mt-4 mb-8">
            <div class="rounded-2xl overflow-hidden shadow-xl">
                <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}" class="w-full h-64 sm:h-96 object-cover">
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-8 sm:py-12">
        <article class="prose prose-lg prose-zinc dark:prose-invert max-w-none
                       prose-headings:scroll-mt-24
                       prose-h2:text-2xl prose-h2:border-b prose-h2:border-zinc-200 prose-h2:dark:border-zinc-800 prose-h2:pb-3 prose-h2:mb-4
                       prose-h3:text-xl
                       prose-a:text-emerald-600 prose-a:dark:text-emerald-400 prose-a:no-underline hover:prose-a:underline
                       prose-code:bg-zinc-100 prose-code:dark:bg-zinc-800 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:before:content-none prose-code:after:content-none
                       prose-pre:bg-zinc-900 prose-pre:dark:bg-zinc-950
                       prose-blockquote:border-l-emerald-500 prose-blockquote:bg-emerald-50 prose-blockquote:dark:bg-emerald-900/20 prose-blockquote:py-1 prose-blockquote:not-italic
                       prose-img:rounded-xl prose-img:shadow-lg">
            {!! $post['html'] ?? '' !!}
        </article>

        {{-- Tags --}}
        @if(!empty($post['tags']))
            <div class="flex flex-wrap gap-2 mt-12 pt-8 border-t border-zinc-200 dark:border-zinc-800">
                @foreach($post['tags'] as $tag)
                    <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-sm">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Share Section --}}
        <div class="mt-12 pt-8 border-t border-zinc-200 dark:border-zinc-800">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <span class="font-semibold text-zinc-900 dark:text-white">Share this article</span>
                <div class="flex items-center gap-3">
                    <button
                        onclick="navigator.clipboard.writeText(window.location.href); this.querySelector('span').textContent = 'Copied!'; setTimeout(() => this.querySelector('span').textContent = 'Copy Link', 2000)"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-sm font-medium"
                    >
                        <flux:icon name="link" class="size-4" />
                        <span>Copy Link</span>
                    </button>
                    <a
                        href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post['title'] ?? '') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center justify-center size-10 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors"
                    >
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a
                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center justify-center size-10 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors"
                    >
                        <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Posts --}}
    @if($relatedPosts->isNotEmpty())
        <div class="bg-zinc-50 dark:bg-zinc-900/50 border-t border-zinc-200 dark:border-zinc-800 py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <a
                            href="{{ route('blog.show', $relatedPost['slug']) }}"
                            wire:navigate
                            class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 overflow-hidden hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300"
                        >
                            @if(!empty($relatedPost['featured_image']))
                                <div class="h-40 overflow-hidden">
                                    <img src="{{ $relatedPost['featured_image'] }}" alt="{{ $relatedPost['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                            @else
                                <div class="h-40 bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                                    <flux:icon name="document-text" class="size-12 text-white/50" />
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">{{ $relatedPost['category'] }}</span>
                                    <span class="text-zinc-400">•</span>
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ $relatedPost['read_time'] }}</span>
                                </div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                    {{ $relatedPost['title'] }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Back to Blog --}}
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-8">
        <a
            href="{{ route('blog.index') }}"
            wire:navigate
            class="inline-flex items-center gap-2 text-zinc-600 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors"
        >
            <flux:icon name="arrow-left" class="size-4" />
            Back to all articles
        </a>
    </div>
</div>
