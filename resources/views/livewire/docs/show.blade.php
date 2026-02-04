<?php

use App\Services\DocumentationService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public string $slug;
    public array $page = [];
    public array $sidebar = [];
    public array $toc = [];
    public array $navigation = [];
    public ?string $section = null;

    public function mount(string $slug, DocumentationService $docs): void
    {
        $this->slug = $slug;
        $this->page = $docs->getPage($slug) ?? [];
        $this->sidebar = $docs->getSidebar();
        $this->navigation = $docs->getNavigation($slug);
        $this->section = $docs->getPageSection($slug);

        if (empty($this->page)) {
            abort(404, 'Documentation page not found.');
        }

        $this->page['html'] = $docs->addHeadingIds($this->page['html']);
        $this->toc = $docs->getTableOfContents($this->page['html']);
    }

    public function title(): string
    {
        return ($this->page['title'] ?? 'Documentation').' - '.config('app.name').' Docs';
    }
};
?>

<div class="bg-white dark:bg-zinc-950">
    {{-- Header --}}
    <div class="border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('docs') }}" class="text-zinc-500 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400 transition-colors">
                    Docs
                </a>
                @if($section)
                    <flux:icon name="chevron-right" class="size-4 text-zinc-400" />
                    <span class="text-zinc-500 dark:text-zinc-400">{{ $section }}</span>
                @endif
                <flux:icon name="chevron-right" class="size-4 text-zinc-400" />
                <span class="text-zinc-900 dark:text-white font-medium">{{ $page['title'] ?? 'Page' }}</span>
            </nav>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar --}}
            <aside class="w-full lg:w-64 shrink-0">
                <nav class="lg:sticky lg:top-24 space-y-6">
                    @foreach($sidebar['sections'] ?? [] as $sidebarSection)
                        <div>
                            <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500 mb-3">
                                @if(isset($sidebarSection['icon']))
                                    <flux:icon :name="$sidebarSection['icon']" class="size-4" />
                                @endif
                                {{ $sidebarSection['title'] }}
                            </h3>
                            <ul class="space-y-1">
                                @foreach($sidebarSection['items'] ?? [] as $item)
                                    <li>
                                        <a
                                            href="{{ route('docs.show', $item['slug']) }}"
                                            wire:navigate
                                            @class([
                                                'block px-3 py-2 rounded-lg text-sm font-medium transition-colors',
                                                'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $slug === $item['slug'],
                                                'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-white dark:hover:bg-zinc-800' => $slug !== $item['slug'],
                                            ])
                                        >
                                            {{ $item['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </nav>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 min-w-0">
                <article class="prose prose-zinc dark:prose-invert max-w-none prose-headings:scroll-mt-24 prose-h1:text-3xl prose-h2:text-2xl prose-h2:border-b prose-h2:border-zinc-200 prose-h2:dark:border-zinc-800 prose-h2:pb-2 prose-a:text-emerald-600 prose-a:dark:text-emerald-400 prose-code:bg-zinc-100 prose-code:dark:bg-zinc-800 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:before:content-none prose-code:after:content-none prose-pre:bg-zinc-900 prose-pre:dark:bg-zinc-950 prose-table:text-sm">
                    {!! $page['html'] ?? '' !!}
                </article>

                {{-- Navigation --}}
                <div class="mt-12 pt-8 border-t border-zinc-200 dark:border-zinc-800">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between">
                        @if($navigation['prev'])
                            <a
                                href="{{ route('docs.show', $navigation['prev']['slug']) }}"
                                wire:navigate
                                class="group flex items-center gap-3 p-4 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500 dark:hover:border-emerald-500 transition-colors"
                            >
                                <flux:icon name="arrow-left" class="size-5 text-zinc-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors" />
                                <div class="flex flex-col">
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">Previous</span>
                                    <span class="text-sm font-medium text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                        {{ $navigation['prev']['title'] }}
                                    </span>
                                </div>
                            </a>
                        @else
                            <div></div>
                        @endif

                        @if($navigation['next'])
                            <a
                                href="{{ route('docs.show', $navigation['next']['slug']) }}"
                                wire:navigate
                                class="group flex items-center gap-3 p-4 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:border-emerald-500 dark:hover:border-emerald-500 transition-colors text-right sm:ml-auto"
                            >
                                <div class="flex flex-col">
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">Next</span>
                                    <span class="text-sm font-medium text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                        {{ $navigation['next']['title'] }}
                                    </span>
                                </div>
                                <flux:icon name="arrow-right" class="size-5 text-zinc-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors" />
                            </a>
                        @endif
                    </div>
                </div>
            </main>

            {{-- Table of Contents (Desktop) --}}
            @if(count($toc) > 0)
                <aside class="hidden xl:block w-48 shrink-0">
                    <div class="sticky top-24">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500 mb-4">
                            On this page
                        </h4>
                        <ul class="space-y-2 text-sm">
                            @foreach($toc as $item)
                                <li @class(['pl-3' => $item['level'] === 3])>
                                    <a
                                        href="#{{ $item['id'] }}"
                                        class="text-zinc-500 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400 transition-colors"
                                    >
                                        {{ $item['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            @endif
        </div>
    </div>
</div>
