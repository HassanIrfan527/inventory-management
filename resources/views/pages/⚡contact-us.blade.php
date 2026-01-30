<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

new #[Title('Contact Us | Kinetic Hub')] #[Layout('layouts.public')] class extends Component
{
    #[Validate('required|min:3')]
    public string $name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|min:5')]
    public string $subject = '';

    #[Validate('required|min:10')]
    public string $message = '';

    public bool $sent = false;

    public function submit(): void
    {
        $this->validate();

        // In a real app, you'd send an email here.
        // For this demo, we'll just show a success state.

        $this->sent = true;

        $this->reset(['name', 'email', 'subject', 'message']);
    }
};
?>

<div class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-950/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
            {{--
                DESIGN CHOICE: Contact Page
                - Psychological Trigger: Trust & Availability.
                - Direct, clear communication options.
                - Minimalist form to reduce friction.
            --}}

            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">
                    Let's talk about <span class="text-blue-600">your growth.</span>
                </h2>
                <p class="mt-6 text-base sm:text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    Have questions about Kinetic Hub? We're here to help you optimize your business operations. Reach out and our team will get back to you within 24 hours.
                </p>

                <div class="mt-12 space-y-8">
                    <div class="flex gap-4 items-start">
                        <div class="size-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center shrink-0">
                            <flux:icon.envelope class="size-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Email</p>
                            <p class="text-zinc-600 dark:text-zinc-400">hello@kinetichub.io</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="size-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center shrink-0">
                            <flux:icon.map-pin class="size-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Office</p>
                            <p class="text-zinc-600 dark:text-zinc-400">123 Kinetic Ave, Tech City, 90210</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative bg-white dark:bg-zinc-900/50 p-6 sm:p-12 rounded-[2rem] sm:rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 shadow-xl">
                @if ($sent)
                    <div class="text-center py-12" wire:transition>
                        <div class="size-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                            <flux:icon.check-circle class="size-10 text-emerald-600 dark:text-emerald-400" />
                        </div>
                        <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">Message Sent!</h3>
                        <p class="mt-2 text-zinc-600 dark:text-zinc-400">Thank you for reaching out. We'll be in touch soon.</p>
                        <flux:button variant="ghost" class="mt-8" wire:click="$set('sent', false)">Send another message</flux:button>
                    </div>
                @else
                    <form wire:submit="submit" class="space-y-6">
                        <flux:field>
                            <flux:label>Full Name</flux:label>
                            <flux:input wire:model="name" placeholder="John Doe" />
                            <flux:error name="name" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Email Address</flux:label>
                            <flux:input type="email" wire:model="email" placeholder="john@example.com" />
                            <flux:error name="email" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Subject</flux:label>
                            <flux:input wire:model="subject" placeholder="How can we help?" />
                            <flux:error name="subject" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Message</flux:label>
                            <flux:textarea wire:model="message" rows="5" placeholder="Tell us more about your business needs..." />
                            <flux:error name="message" />
                        </flux:field>

                        <flux:button type="submit" variant="primary" icon-trailing="paper-airplane" class="w-full py-4 shadow-lg shadow-blue-500/20">
                           Send Message
                        </flux:button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
