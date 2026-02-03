<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public function title(): string
    {
        return 'Privacy Policy | ' . config('app.name');
    }
};
?>

<div class="relative isolate overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl mb-8">
            Privacy Policy
        </h1>
        
        <div class="prose prose-zinc dark:prose-invert max-w-none">
            <p class="text-xl text-zinc-600 dark:text-zinc-400 leading-8 mb-12">
                Last updated: {{ date('F j, Y') }}
            </p>

            <section class="space-y-6">
                <h2 class="text-2xl font-bold text-emerald-600">1. Information We Collect</h2>
                <p>
                    We collect information you provide directly to us when you create an account, use our services, or communicate with us. This may include your name, email address, company name, and payment information.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">2. How We Use Your Information</h2>
                <p>
                    We use the information we collect to provide, maintain, and improve our services, to process your transactions, and to send you technical notices and support messages.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">3. Data Security</h2>
                <p>
                    We take reasonable measures to help protect information about you from loss, theft, misuse, and unauthorized access. We use industry-standard encryption to protect your data in transit and at rest.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">4. Sharing of Information</h2>
                <p>
                    We do not share your personal information with third parties except as described in this policy or with your consent. We may share information with vendors who perform services for us.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">5. Changes to this Policy</h2>
                <p>
                    We may change this privacy policy from time to time. If we make changes, we will notify you by revising the date at the top of the policy.
                </p>
            </section>
        </div>
    </div>
</div>