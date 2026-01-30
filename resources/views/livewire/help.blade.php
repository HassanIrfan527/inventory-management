<div class="relative isolate">
    {{-- Hero/Search Header --}}
    <div class="relative bg-zinc-900 py-24 sm:py-32 overflow-hidden">
        {{-- Decorative Gradients --}}
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-blue-600 to-indigo-800 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10 py-12 sm:py-20">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-6xl mb-6">
                How can we help you?
            </h1>
            <p class="text-base sm:text-lg leading-8 text-zinc-400 mb-10 max-w-2xl mx-auto">
                Search our knowledge base or browse through the frequently asked questions below to find the answers you need.
            </p>

            <div class="max-w-xl mx-auto relative group px-4 sm:px-0">
                <div class="absolute inset-y-0 left-4 sm:left-0 pl-4 flex items-center pointer-events-none">
                    <flux:icon.magnifying-glass class="size-5 text-zinc-500 group-focus-within:text-blue-500 transition-colors" />
                </div>
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Describe your issue..."
                    class="block w-full rounded-2xl border-0 py-4 pl-12 pr-4 text-zinc-900 ring-1 ring-inset ring-zinc-800 placeholder:text-zinc-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 text-sm sm:leading-6 bg-white dark:bg-zinc-950 dark:text-white dark:ring-zinc-800"
                >
            </div>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
            {{-- FAQ Sidebar/Categories --}}
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Categories</h2>
                <nav class="space-y-2">
                    <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-700 dark:bg-blue-900/10 dark:text-blue-400 font-semibold border border-blue-100 dark:border-blue-900/20 transition-all">
                        <flux:icon.question-mark-circle class="size-5" />
                        Common Questions
                    </a>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 text-zinc-600 dark:text-zinc-400 font-medium transition-all">
                        <flux:icon.user class="size-5" />
                        Account & Billing
                    </a>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 text-zinc-600 dark:text-zinc-400 font-medium transition-all">
                        <flux:icon.shield-check class="size-5" />
                        Security & Privacy
                    </a>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 text-zinc-600 dark:text-zinc-400 font-medium transition-all">
                        <flux:icon.puzzle-piece class="size-5" />
                        Integrations
                    </a>
                </nav>

                <div class="mt-12 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950/50">
                    <h3 class="font-bold text-zinc-900 dark:text-white mb-2">Still need support?</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">Our dedicated team is here to help you solve any technical issues.</p>
                    <flux:button variant="primary" class="w-full" href="{{ route('contact.us') }}">Contact Support</flux:button>
                </div>
            </div>

            {{-- FAQs --}}
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Frequently Asked Questions</h2>

                <div class="space-y-6">
                    <flux:card class="p-0 overflow-hidden border-zinc-200 dark:border-zinc-800">
                        <div class="p-6">
                            <flux:heading size="lg" class="mb-3">How do I reset my password?</flux:heading>
                            <flux:text>You can reset your password by going to the login page and clicking on "Forgot Password?". We will send a secure link to your registered email address to help you regain access to your account.</flux:text>
                        </div>
                    </flux:card>

                    <flux:card class="p-0 overflow-hidden border-zinc-200 dark:border-zinc-800">
                        <div class="p-6">
                            <flux:heading size="lg" class="mb-3">Can I export my inventory data?</flux:heading>
                            <flux:text>Yes! Kinetic Hub allows you to export your entire inventory, orders, and contact lists in CSV or Excel formats. Simply navigate to the specific section and look for the "Export" button in the top actions bar.</flux:text>
                        </div>
                    </flux:card>

                    <flux:card class="p-0 overflow-hidden border-zinc-200 dark:border-zinc-800">
                        <div class="p-6">
                            <flux:heading size="lg" class="mb-3">Managing multi-user permissions</flux:heading>
                            <flux:text>As an administrator, you can invite team members and assign them specific roles (e.g., Viewer, Manager, Admin). This ensures that each team member has access only to the data they need to perform their duties.</flux:text>
                        </div>
                    </flux:card>

                    <flux:card class="p-0 overflow-hidden border-zinc-200 dark:border-zinc-800">
                        <div class="p-6">
                            <flux:heading size="lg" class="mb-3">What integrations do you support?</flux:heading>
                            <flux:text>We currently support direct integrations with Shopify, WooCommerce, and Stripe. We are actively working on adding more marketplaces and shipping carriers to our platform.</flux:text>
                        </div>
                    </flux:card>
                </div>
            </div>
        </div>
    </div>
</div>
