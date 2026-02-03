<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.public')] class extends Component
{
    public function title(): string
    {
        return 'Terms of Service | ' . config('app.name');
    }
};
?>

<div class="relative isolate overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-24 sm:py-32">
        <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl mb-8">
            Terms of Service
        </h1>
        
        <div class="prose prose-zinc dark:prose-invert max-w-none">
            <p class="text-xl text-zinc-600 dark:text-zinc-400 leading-8 mb-12">
                Effective Date: {{ date('F j, Y') }}
            </p>

            <section class="space-y-6">
                <h2 class="text-2xl font-bold text-emerald-600">1. Agreement to Terms</h2>
                <p>
                    By accessing or using {{ config('app.name') }}, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">2. User Accounts</h2>
                <p>
                    You are responsible for maintaining the confidentiality of your account and password. You agree to notify us immediately of any unauthorized use of your account.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">3. Subscription and Billing</h2>
                <p>
                    Our services are provided on a subscription basis. You agree to pay the fees associated with your plan. All fees are non-refundable except as required by law.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">4. Prohibited Uses</h2>
                <p>
                    You agree not to use {{ config('app.name') }} for any illegal purpose or in a way that violates the rights of others. You may not attempt to gain unauthorized access to our systems.
                </p>

                <h2 class="text-2xl font-bold text-emerald-600">5. Limitation of Liability</h2>
                <p>
                    To the maximum extent permitted by law, {{ config('app.name') }} shall not be liable for any indirect, incidental, or consequential damages arising out of your use of the service.
                </p>
            </section>
        </div>
    </div>
</div>