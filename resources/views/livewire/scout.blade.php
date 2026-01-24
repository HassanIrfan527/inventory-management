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
    <div class="flex-1 flex flex-col items-center justify-center p-4 z-10">
        <!-- Logo & Title -->
        <div class="flex flex-col items-center mb-12 animate-fade-in-up">
            <div class="relative w-24 h-24 mb-6 group">
                <!-- Glowing effect behind logo -->
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 via-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity duration-500 animate-pulse"></div>
                
                <div class="relative w-full h-full bg-white dark:bg-zinc-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-zinc-700/50 shadow-2xl flex items-center justify-center overflow-hidden">
                    <!-- Aesthetic Logo: Smart Shopping Bag -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-14 h-14">
                        <defs>
                            <linearGradient id="bag-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#3b82f6" /> <!-- Blue-500 -->
                                <stop offset="100%" style="stop-color:#8b5cf6" /> <!-- Violet-500 -->
                            </linearGradient>
                            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="2" result="blur" />
                                <feComposite in="SourceGraphic" in2="blur" operator="over" />
                            </filter>
                        </defs>
                        
                        <!-- Bag Handle -->
                        <path d="M16 11V7a4 4 0 0 0-8 0v4" stroke="url(#bag-gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <!-- Bag Body -->
                        <path d="M5 9h14l1 12H4L5 9z" fill="url(#bag-gradient)" fill-opacity="0.1" stroke="url(#bag-gradient)" stroke-width="2" stroke-linejoin="round"/>
                        
                        <!-- Digital Brain / Sparkle Center -->
                        <g transform="translate(12, 16)">
                            <path d="M-3 -1 L0 -4 L3 -1 L0 2 Z" fill="#fff" class="dark:fill-white">
                                <animate attributeName="opacity" values="0.5;1;0.5" dur="2s" repeatCount="indefinite" />
                            </path>
                            <!-- Connecting Circuit Lines -->
                            <line x1="-3" y1="-1" x2="-6" y2="-2" stroke="#60a5fa" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="3" y1="-1" x2="6" y2="-2" stroke="#a78bfa" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="0" y1="2" x2="0" y2="4" stroke="#818cf8" stroke-width="1.5" stroke-linecap="round" />
                            <circle cx="-6" cy="-2" r="1" fill="#60a5fa" />
                            <circle cx="6" cy="-2" r="1" fill="#a78bfa" />
                            <circle cx="0" cy="4" r="1" fill="#818cf8" />
                        </g>
                    </svg>
                </div>
            </div>

            <h1
                class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zinc-900 to-zinc-600 dark:from-white dark:to-zinc-400">
                Scout
            </h1>
            <p class="mt-2 text-zinc-500 dark:text-zinc-400 text-lg">
                Your intelligent shopping assistant
            </p>
        </div>

        <!-- Suggestions / Capabilities (Optional decorative elements) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-3xl w-full px-4 animate-fade-in-up delay-100">
            <button
                class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                <div
                    class="mb-2 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.magnifying-glass class="w-5 h-5" />
                </div>
                <div class="font-medium text-zinc-900 dark:text-zinc-100">Find products</div>
                <div class="text-sm text-zinc-500 dark:text-zinc-400">Search logic inventory...</div>
            </button>
            <button
                class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                <div
                    class="mb-2 w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.chart-bar class="w-5 h-5" />
                </div>
                <div class="font-medium text-zinc-900 dark:text-zinc-100">Analyze sales</div>
                <div class="text-sm text-zinc-500 dark:text-zinc-400">Show me this week's revenue...</div>
            </button>
            <button
                class="p-4 rounded-xl text-left border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                <div
                    class="mb-2 w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.plus class="w-5 h-5" />
                </div>
                <div class="font-medium text-zinc-900 dark:text-zinc-100">Create order</div>
                <div class="text-sm text-zinc-500 dark:text-zinc-400">Draft a new order for...</div>
            </button>
        </div>
    </div>

    <!-- Bottom Command Palette Area -->
    <div class="w-full max-w-3xl mx-auto p-4 md:p-6 z-20">
        <div class="relative group">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500">
            </div>
            <div
                class="relative flex items-center bg-white dark:bg-zinc-800/90 backdrop-blur-xl rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-2xl overflow-hidden p-2">
                <div class="pl-4 text-zinc-400">
                    <flux:icon.sparkles class="w-6 h-6 text-yellow-500 animate-pulse" />
                </div>
                <input type="text" placeholder="Ask Scout anything..."
                    class="w-full h-14 bg-transparent border-0 focus:ring-0 text-lg px-4 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500"
                    autofocus>
                <div class="flex items-center gap-2 pr-2">
                    <button
                        class="p-2 rounded-xl bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 text-zinc-500 dark:text-zinc-300 transition-colors"
                        title="Voice Input">
                        <flux:icon.microphone class="w-5 h-5" />
                    </button>
                    <button class="p-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-colors"
                        title="Submit">
                        <flux:icon.paper-airplane class="w-5 h-5" />
                    </button>
                </div>
            </div>
            <div class="text-center mt-3">
                <p class="text-xs text-zinc-400 dark:text-zinc-500">
                    Scout can make mistakes. Please verify important information.
                </p>
            </div>
        </div>
    </div>
</div>
