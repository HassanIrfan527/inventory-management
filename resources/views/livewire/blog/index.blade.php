<div class="py-12 sm:py-20 bg-zinc-50/50 dark:bg-zinc-950">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-16">
            <h2 class="text-base font-semibold leading-7 text-blue-600 uppercase tracking-wide">The Kinetic Blog</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                Insights for modern business.
            </p>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                Weekly articles on inventory management, growth strategies, and industry trends.
            </p>
        </div>

        {{-- Magazine Grid Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Featured Post (Spans 2 columns on desktop) --}}
            @php
                $featured = collect($posts)->firstWhere('featured', true);
                $others = collect($posts)->where('featured', false);
            @endphp
            
            @if($featured)
            <div class="lg:col-span-2 group cursor-pointer">
                <div class="relative h-96 w-full overflow-hidden rounded-3xl mb-6">
                    <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-flex items-center rounded-full bg-blue-600/90 px-3 py-1 text-xs font-medium text-white backdrop-blur-md">
                                {{ $featured['category'] }}
                            </span>
                            <span class="text-zinc-300 text-xs">{{ $featured['read_time'] }}</span>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-2 leading-tight group-hover:underline decoration-blue-500 underline-offset-4 decoration-2">
                            {{ $featured['title'] }}
                        </h3>
                         <p class="text-zinc-300 line-clamp-2 max-w-xl">
                            {{ $featured['excerpt'] }}
                        </p>
                         <div class="flex items-center gap-3 mt-4">
                             <div class="h-8 w-8 rounded-full bg-zinc-100 flex items-center justify-center text-xs font-bold text-zinc-900 border border-white/20">
                                {{ substr($featured['author'], 0, 1) }}
                            </div>
                            <div class="text-sm font-medium text-white">
                                {{ $featured['author'] }} <span class="text-zinc-400 mx-1">•</span> {{ $featured['date'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Sidebar / Top stories --}}
            <div class="space-y-8 flex flex-col justify-between">
                <div class="bg-blue-600 rounded-3xl p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>
                    <h3 class="font-bold text-2xl mb-2 relative z-10">Subscribe to our newsletter</h3>
                    <p class="text-blue-100 mb-6 relative z-10">Get the latest insights delivered straight to your inbox.</p>
                    <div class="flex gap-2 relative z-10">
                        <input type="email" placeholder="you@example.com" class="bg-white/10 border-white/20 text-white placeholder-blue-200 rounded-xl w-full px-4 py-2 focus:ring-2 focus:ring-white/50 focus:border-transparent outline-none">
                        <button class="bg-white text-blue-600 rounded-xl px-4 font-bold hover:bg-blue-50 transition-colors">
                            <flux:icon.paper-airplane class="size-5" />
                        </button>
                    </div>
                </div>
                
                {{-- Quick links list --}}
                <div class="bg-white dark:bg-zinc-900 rounded-3xl p-6 border border-zinc-200 dark:border-zinc-800">
                    <h4 class="font-bold text-zinc-900 dark:text-white mb-4">Trending Topics</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-xs hover:bg-zinc-200 dark:hover:bg-zinc-700 cursor-pointer transition-colors">Supply Chain</span>
                        <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-xs hover:bg-zinc-200 dark:hover:bg-zinc-700 cursor-pointer transition-colors">AI & Tech</span>
                        <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-xs hover:bg-zinc-200 dark:hover:bg-zinc-700 cursor-pointer transition-colors">Leadership</span>
                         <span class="px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-xs hover:bg-zinc-200 dark:hover:bg-zinc-700 cursor-pointer transition-colors">Finance</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Standard Grid for other posts --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            @foreach($others as $post)
            <flux:card class="group cursor-pointer hover:shadow-xl transition-all duration-300 !bg-white dark:!bg-zinc-900 !border-zinc-200 dark:!border-zinc-800 hover:!border-blue-500/30 overflow-hidden flex flex-col p-0">
                <div class="h-48 w-full overflow-hidden relative">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center rounded-lg bg-white/90 dark:bg-black/80 px-2 py-1 text-xs font-semibold text-zinc-900 dark:text-white backdrop-blur-sm">
                            {{ $post['category'] }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-xs text-zinc-500 dark:text-zinc-500 mb-2 flex items-center justify-between">
                        <span>{{ $post['date'] }}</span>
                        <span>{{ $post['read_time'] }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $post['title'] }}
                    </h3>
                    
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-3 flex-1">
                        {{ $post['excerpt'] }}
                    </p>
                    
                    <div class="flex items-center gap-2 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                         <div class="h-6 w-6 rounded-full bg-zinc-200 flex items-center justify-center text-[10px] font-bold text-zinc-600">
                            {{ substr($post['author'], 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $post['author'] }}</span>
                    </div>
                </div>
            </flux:card>
            @endforeach
        </div>
        
        <div class="mt-16 text-center">
             <flux:button variant="outline" icon-trailing="arrow-right">View all articles</flux:button>
        </div>
    </div>
</div>
