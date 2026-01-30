<div class="relative isolate overflow-hidden">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-blue-600 to-indigo-800 opacity-10 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        <div class="mx-auto max-w-3xl">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('home') }}" class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300">
                                <flux:icon.home class="size-5 shrink-0" />
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <flux:icon.chevron-right class="size-5 shrink-0 text-zinc-400" />
                            <a href="#" class="ml-4 text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300">Documentation</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl mb-8">
                User Documentation
            </h1>

            <div class="prose prose-zinc dark:prose-invert max-w-none">
                <p class="text-xl text-zinc-600 dark:text-zinc-400 leading-8">
                    Welcome to the Kinetic Hub documentation. This guide will help you understand how to navigate and make the most of our inventory management system.
                </p>

                <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2">
                    <flux:card class="p-6 transition-all hover:ring-2 hover:ring-blue-500/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-lg bg-blue-600/10 text-blue-600">
                                <flux:icon.rocket-launch class="size-6" />
                            </div>
                            <flux:heading size="lg">Getting Started</flux:heading>
                        </div>
                        <flux:text>Learn the basics of setting up your account, importing your first products, and configuring your dashboard.</flux:text>
                        <flux:button variant="ghost" size="sm" class="mt-4" icon-trailing="arrow-right">Read Guide</flux:button>
                    </flux:card>

                    <flux:card class="p-6 transition-all hover:ring-2 hover:ring-indigo-500/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-lg bg-indigo-600/10 text-indigo-600">
                                <flux:icon.queue-list class="size-6" />
                            </div>
                            <flux:heading size="lg">Inventory Management</flux:heading>
                        </div>
                        <flux:text>Master the art of tracking stock levels, managing multi-warehouse locations, and setting up low-stock alerts.</flux:text>
                        <flux:button variant="ghost" size="sm" class="mt-4" icon-trailing="arrow-right">Read Guide</flux:button>
                    </flux:card>

                    <flux:card class="p-6 transition-all hover:ring-2 hover:ring-emerald-500/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-lg bg-emerald-600/10 text-emerald-600">
                                <flux:icon.shopping-cart class="size-6" />
                            </div>
                            <flux:heading size="lg">Orders & Fulfillment</flux:heading>
                        </div>
                        <flux:text>Efficiently process incoming orders, manage shipments, and stay updated with live tracking statuses.</flux:text>
                        <flux:button variant="ghost" size="sm" class="mt-4" icon-trailing="arrow-right">Read Guide</flux:button>
                    </flux:card>

                    <flux:card class="p-6 transition-all hover:ring-2 hover:ring-amber-500/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-lg bg-amber-600/10 text-amber-600">
                                <flux:icon.cog-6-tooth class="size-6" />
                            </div>
                            <flux:heading size="lg">Advanced Settings</flux:heading>
                        </div>
                        <flux:text>Deep dive into API integrations, custom reporting, and user permission management for your team.</flux:text>
                        <flux:button variant="ghost" size="sm" class="mt-4" icon-trailing="arrow-right">Read Guide</flux:button>
                    </flux:card>
                </div>

                <div class="mt-16 p-8 rounded-3xl bg-zinc-900 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold mb-4">Need more help?</h2>
                        <p class="text-zinc-400 mb-6">If you can't find what you're looking for, our help center and support team are always available.</p>
                        <flux:button href="{{ route('help') }}" class="bg-white text-zinc-900 hover:bg-zinc-100">Visit Help Center</flux:button>
                    </div>
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <flux:icon.lifebuoy class="size-32" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
