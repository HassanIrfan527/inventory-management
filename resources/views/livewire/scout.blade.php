<div class="flex flex-col h-[calc(100vh-4rem)] relative bg-white dark:bg-zinc-950 overflow-hidden font-sans selection:bg-blue-100 dark:selection:bg-blue-900/30">
    <!-- Full-Page Interactive Background Gradients -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-500/10 dark:bg-blue-600/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[30%] bg-purple-500/10 dark:bg-purple-600/10 rounded-full blur-[100px] animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[50%] h-[50%] bg-indigo-500/10 dark:bg-indigo-600/10 rounded-full blur-[150px] animate-pulse animation-delay-4000"></div>
    </div>

    <!-- Main Chat Interface -->
    <div class="flex-1 flex flex-col items-center p-4 md:p-8 z-10 overflow-y-auto scrollbar-hide space-y-8" id="chat-container">
        @if (empty($history))
            <!-- Professional Empty State -->
            <div class="flex-1 flex flex-col items-center justify-center max-w-2xl text-center space-y-8 py-12">
                <div class="relative group">
                    <div class="absolute inset-0 bg-blue-500/20 dark:bg-blue-400/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-all duration-700"></div>
                    <div class="relative w-24 h-24 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-2xl flex items-center justify-center transform transition-transform group-hover:scale-105 duration-500">
                        <!-- Custom Robot Icon SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-blue-600 dark:text-blue-400">
                            <path d="M12 8V4H8" />
                            <rect width="16" height="12" x="4" y="8" rx="2" />
                            <path d="M2 14h2" />
                            <path d="M20 14h2" />
                            <path d="M15 13v2" />
                            <path d="M9 13v2" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-3">
                    <h1 class="text-5xl font-extrabold tracking-tight text-zinc-900 dark:text-white">
                        Scout <span class="bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full align-top ml-1 uppercase tracking-widest">AI</span>
                    </h1>
                    <p class="text-xl text-zinc-500 dark:text-zinc-400 font-medium">
                        Your intelligent operations partner.
                    </p>
                </div>

                <!-- Strategic Quick Starts -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                    <button wire:click="$set('userInput', 'Show me an inventory summary')" class="p-5 rounded-2xl text-left border border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm hover:border-blue-500/50 hover:bg-white dark:hover:bg-zinc-800/80 transition-all group">
                        <div class="mb-3 w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <flux:icon.chart-bar class="w-5 h-5" />
                        </div>
                        <h3 class="font-bold text-zinc-900 dark:text-zinc-100">Analytics</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1 line-clamp-2">Get real-time stock levels and valuation.</p>
                    </button>
                    
                    <button wire:click="$set('userInput', 'Search for products named Shirt')" class="p-5 rounded-2xl text-left border border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm hover:border-purple-500/50 hover:bg-white dark:hover:bg-zinc-800/80 transition-all group">
                        <div class="mb-3 w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <flux:icon.magnifying-glass class="w-5 h-5" />
                        </div>
                        <h3 class="font-bold text-zinc-900 dark:text-zinc-100">Find Items</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1 line-clamp-2">Quickly locate products in the catalog.</p>
                    </button>

                    <button wire:click="$set('userInput', 'Create a new category named New Stock')" class="p-5 rounded-2xl text-left border border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm hover:border-green-500/50 hover:bg-white dark:hover:bg-zinc-800/80 transition-all group">
                        <div class="mb-3 w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <flux:icon.plus class="w-5 h-5" />
                        </div>
                        <h3 class="font-bold text-zinc-900 dark:text-zinc-100">Organize</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1 line-clamp-2">Efficiently categorize your inventory.</p>
                    </button>
                </div>
            </div>
        @else
            <!-- Refined Chat History -->
            <div class="w-full max-w-3xl space-y-10 pb-32">
                @foreach ($history as $chat)
                    <div class="flex flex-col @if($chat['role'] === 'user') items-end @else items-start @endif space-y-2 animate-fade-in-up">
                        <div class="flex items-center gap-2 @if($chat['role'] === 'user') flex-row-reverse @endif">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center @if($chat['role'] === 'user') bg-zinc-200 dark:bg-zinc-800 @else bg-blue-600 @endif text-white shadow-sm overflow-hidden">
                                @if($chat['role'] === 'user')
                                    <flux:icon.user class="w-4 h-4 text-zinc-600 dark:text-zinc-400" />
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-white" stroke="currentColor" stroke-width="2">
                                        <rect width="16" height="12" x="4" y="8" rx="2" />
                                        <path d="M12 8V4H8" />
                                        <path d="M9 13v2" />
                                        <path d="M15 13v2" />
                                    </svg>
                                @endif
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                                {{ $chat['role'] === 'user' ? 'YOU' : 'SCOUT' }}
                            </span>
                        </div>

                        <div class="relative group max-w-[85%] @if($chat['role'] === 'user') items-end @endif">
                            <div class="px-5 py-3.5 rounded-2xl shadow-sm text-sm md:text-base leading-relaxed
                                @if($chat['role'] === 'user') 
                                    bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 rounded-tr-none
                                @else 
                                    bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-800 dark:text-zinc-200 rounded-tl-none prose prose-zinc dark:prose-invert max-w-none
                                @endif">
                                @if($chat['role'] === 'user')
                                    {{ $chat['content'] }}
                                @else
                                    {!! \Illuminate\Support\Str::markdown($chat['content'] ?? '') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Enhanced Thinking State -->
                <div wire:loading wire:target="sendMessage" class="flex flex-col items-start space-y-2">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center shadow-lg animate-bounce">
                             <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-white" stroke="currentColor" stroke-width="2">
                                <rect width="16" height="12" x="4" y="8" rx="2" />
                                <path d="M12 8V4H8" />
                                <path d="M9 13v2" />
                                <path d="M15 13v2" />
                            </svg>
                        </div>
                         <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400">SCOUT IS THINKING...</span>
                    </div>
                    <div class="px-5 py-4 bg-zinc-50/50 dark:bg-zinc-900/50 rounded-2xl rounded-tl-none border border-zinc-200/50 dark:border-zinc-800/50 flex gap-1.5">
                        <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce [animation-delay:-.3s]"></div>
                        <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce [animation-delay:-.15s]"></div>
                        <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bottom Integrated Command Palette -->
    <div class="w-full max-w-4xl mx-auto p-4 md:p-8 z-20">
        <form wire:submit.prevent="sendMessage" class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[22px] blur opacity-15 group-focus-within:opacity-40 transition duration-500"></div>
            
            <div class="relative flex items-center bg-white/80 dark:bg-zinc-900/80 backdrop-blur-2xl rounded-[20px] border border-zinc-200/50 dark:border-zinc-800/50 shadow-xl overflow-hidden p-1.5 ring-1 ring-zinc-900/5 dark:ring-white/5">
                <div class="pl-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-zinc-500 dark:text-zinc-400" stroke="currentColor" stroke-width="2">
                            <rect width="16" height="12" x="4" y="8" rx="2" />
                            <path d="M12 8V4H8" />
                        </svg>
                    </div>
                </div>

                <input type="text" wire:model.defer="userInput"
                    placeholder="Ask Scout anything..."
                    class="w-full h-14 bg-transparent border-0 focus:ring-0 text-lg md:text-xl px-4 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600"
                    autofocus required>

                <div class="flex items-center gap-2 pr-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="h-12 w-12 rounded-xl bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 flex items-center justify-center hover:scale-105 transition-all duration-200 disabled:opacity-50 shadow-lg ring-1 ring-white/10"
                        title="Send message">
                        <flux:icon.paper-airplane wire:loading.remove wire:target="sendMessage" class="w-5 h-5" />
                        <div wire:loading wire:target="sendMessage" class="w-5 h-5 border-2 border-zinc-400/30 border-t-zinc-400 dark:border-zinc-900/30 dark:border-t-zinc-900 rounded-full animate-spin"></div>
                    </button>
                </div>
            </div>

            <!-- Footer Details -->
            <div class="flex justify-between items-center mt-4 px-4 text-[11px] font-semibold tracking-wide uppercase text-zinc-400 dark:text-zinc-600">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                    System Ready
                </div>
                <div class="flex gap-4">
                    <span class="hover:text-zinc-600 dark:hover:text-zinc-400 transition-colors cursor-default underline decoration-zinc-300 dark:decoration-zinc-800 underline-offset-4">⌘+Enter to Send</span>
                </div>
            </div>
        </form>
    </div>

    <!-- Clean Animations -->
    <style>
        .animate-fade-in-up {
            animation: sc-fade-in-up 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes sc-fade-in-up {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const chatContainer = document.getElementById('chat-container');
        const scrollToBottom = () => {
            if (chatContainer) {
                chatContainer.scrollTo({
                    top: chatContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }
        };

        Livewire.on('messageSent', () => { setTimeout(scrollToBottom, 50); });
        setTimeout(scrollToBottom, 100);

        if (chatContainer) {
            new MutationObserver(scrollToBottom).observe(chatContainer, { childList: true, subtree: true });
        }
    });

    // Handle Keyboard Shortcuts
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'Enter') {
            const form = document.querySelector('form');
            if (form) form.dispatchEvent(new Event('submit'));
        }
    });
</script>

