<div class="flex flex-col h-[calc(100vh-4rem)] relative bg-white dark:bg-zinc-900 overflow-hidden">
    <!-- Background Gradients -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-4xl opacity-30 pointer-events-none">
        <div
            class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-1/3 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col items-center p-4 z-10 overflow-y-auto scrollbar-hide" id="chat-container">
        @if (empty($history))
            <!-- Logo & Title (Show only when empty) -->
            <div class="flex-1 flex flex-col items-center justify-center animate-fade-in-up">
                <div class="relative w-24 h-24 mb-6 group">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-blue-600 via-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity duration-500 animate-pulse">
                    </div>

                    <div
                        class="relative w-full h-full bg-white dark:bg-zinc-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-zinc-700/50 shadow-2xl flex items-center justify-center overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-14 h-14">
                            <defs>
                                <linearGradient id="cart-gradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#3b82f6" />
                                    <stop offset="100%" style="stop-color:#a855f7" />
                                </linearGradient>
                            </defs>
                            <path
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17"
                                stroke="url(#cart-gradient)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1.5" fill="url(#cart-gradient)" />
                            <circle cx="17" cy="20" r="1.5" fill="url(#cart-gradient)" />
                            <g class="animate-pulse">
                                <path d="M15 6L16 3L17 6L20 7L17 8L16 11L15 8L12 7L15 6Z" fill="#fbbf24"
                                    class="dark:fill-yellow-400" />
                            </g>
                        </svg>
                    </div>
                </div>

                <h1
                    class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-900 to-zinc-600 dark:from-white dark:to-zinc-400">
                    Vector
                </h1>
                <p class="mt-2 text-zinc-500 dark:text-zinc-400 text-lg">
                    How can I help you manage your inventory today?
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-3xl w-full px-4 mt-12">
                    <button wire:click="$set('userInput', 'Show me an inventory summary')"
                        class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div
                            class="mb-2 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <flux:icon.chart-bar class="w-5 h-5" />
                        </div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Inventory Summary</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">Total value and stats...</div>
                    </button>
                    <button wire:click="$set('userInput', 'Create a new category named New Stock')"
                        class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div
                            class="mb-2 w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <flux:icon.plus class="w-5 h-5" />
                        </div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Add Category</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">Create a new organizational category...
                        </div>
                    </button>
                    <button wire:click="$set('userInput', 'Search for products named Shirt')"
                        class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div
                            class="mb-2 w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <flux:icon.magnifying-glass class="w-5 h-5" />
                        </div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Find Products</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">Search for specific items...</div>
                    </button>
                </div>
            </div>
        @else
            <!-- Chat History -->
            <div class="w-full max-w-4xl space-y-6 pt-8 pb-32">
                @foreach ($history as $chat)
                    @if ($chat['role'] === 'user')
                        <div class="flex justify-end pr-4 animate-fade-in-up">
                            <div
                                class="max-w-[80%] bg-zinc-100 dark:bg-zinc-800 px-4 py-3 rounded-2xl rounded-tr-none text-zinc-900 dark:text-zinc-100 shadow-sm">
                                {{ $chat['content'] }}
                            </div>
                        </div>
                    @elseif($chat['role'] === 'assistant')
                        <div class="flex justify-start pl-4 animate-fade-in-up">
                            <div class="flex gap-4 max-w-[90%]">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-500 to-purple-500 flex-shrink-0 flex items-center justify-center shadow-lg">
                                    <flux:icon.sparkles class="w-5 h-5 text-white" />
                                </div>
                                <div
                                    class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 px-5 py-4 rounded-3xl rounded-tl-none text-zinc-800 dark:text-zinc-200 shadow-sm leading-relaxed prose prose-zinc dark:prose-invert max-w-none">
                                    {!! \Illuminate\Support\Str::markdown($chat['content'] ?? '') !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Loading State -->
                <div wire:loading wire:target="sendMessage" class="flex justify-start pl-4">
                    <div class="flex gap-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-500 to-purple-500 flex-shrink-0 flex items-center justify-center animate-pulse">
                            <flux:icon.sparkles class="w-5 h-5 text-white" />
                        </div>
                        <div class="flex items-center gap-2 px-5 py-4 bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl">
                            <div class="w-2 h-2 bg-zinc-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-zinc-400 rounded-full animate-bounce [animation-delay:-.3s]"></div>
                            <div class="w-2 h-2 bg-zinc-400 rounded-full animate-bounce [animation-delay:-.5s]"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bottom Command Palette Area -->
    <div class="w-full max-w-4xl mx-auto p-4 md:p-6 z-20">
        <form wire:submit.prevent="sendMessage" class="relative group">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500">
            </div>
            <div
                class="relative flex items-center bg-white dark:bg-zinc-800/90 backdrop-blur-xl rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-2xl overflow-hidden p-2">
                <div class="pl-4 text-zinc-400">
                    <flux:icon.sparkles class="w-6 h-6 text-yellow-500 transition-colors group-hover:text-yellow-400" />
                </div>
                <input type="text" wire:model.defer="userInput"
                    placeholder="Ask Vector to manage inventory, find products, or create categories..."
                    class="w-full h-14 bg-transparent border-0 focus:ring-0 text-lg px-4 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500"
                    autofocus required>
                <div class="flex items-center gap-2 pr-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="p-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        title="Send message">
                        <flux:icon.paper-airplane wire:loading.remove wire:target="sendMessage" class="w-5 h-5" />
                        <div wire:loading wire:target="sendMessage"
                            class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-center mt-3 px-2">
                <p class="text-xs text-zinc-400 dark:text-zinc-500">
                    Vector is powered by **ollama / qwen2.5** and can create records in your database.
                </p>
                <div class="flex gap-4 text-xs font-medium text-zinc-400 dark:text-zinc-500">
                    <span>Press <kbd
                            class="px-1 py-0.5 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 font-sans">Enter</kbd>
                        to send</span>
                </div>
            </div>
        </form>
    </div>
</div>
