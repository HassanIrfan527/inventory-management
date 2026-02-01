<div class="flex h-full w-full flex-1 flex-col gap-6">
    @php
        $breadcrumbItem = [
            [
                'name' => 'Contacts',
                'href' => route('contacts.all'),
                'icon' => 'users',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>
    {{-- Page Header --}}
    <div class="flex flex-col gap-2">

        <flux:heading size="xl" level="1">Contacts</flux:heading>
        <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
            Manage and view all your contacts in one place.
        </flux:text>
    </div>

    {{-- Search & Filters Section --}}
    <div class="flex flex-col gap-4 rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
        x-data="{ showFilters: false }">

        {{-- Search Bar --}}
        <div class="flex gap-3">
            <div class="flex-1 relative">
                <flux:input wire:model.live.debounce.300ms="search" placeholder="Search contacts by name or email..."
                    icon="magnifying-glass" />
            </div>

            {{-- Filter Toggle Button --}}
            <flux:button @click="showFilters = !showFilters" icon="adjustments-horizontal" variant="ghost" />

            {{-- Add New Contact Button --}}
            <flux:modal.trigger name="add-contact-modal">
                <flux:button variant="primary" icon="plus"
                    class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-0">
                    Add Contact
                </flux:button>
            </flux:modal.trigger>
        </div>

        {{-- Filter Options (Hidden by default) --}}
        <div x-show="showFilters" x-transition class="flex gap-3 pt-3 border-t border-zinc-200 dark:border-zinc-800">
            <flux:select wire:model.live="sortBy" class="max-w-xs">
                <flux:select.option value="name">Name (A-Z)</flux:select.option>
                <flux:select.option value="created_at">Newest First</flux:select.option>
                <flux:select.option value="updated_at">Recently Updated</flux:select.option>
            </flux:select>

            <flux:button variant="ghost" wire:click="$set('search', ''); $set('sortBy', 'name');">
                Reset Filters
            </flux:button>
        </div>
    </div>

    {{-- Contacts Grid/Table --}}
    <div
        class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="border-b border-zinc-200 bg-gradient-to-r from-emerald-50/50 to-teal-50/50 dark:border-zinc-800 dark:from-emerald-950/20 dark:to-teal-950/20">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                            Contact
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                            Email & Phone
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                            Type & Status
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                            Last Updated
                        </th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-zinc-900 dark:text-white">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($this->contacts as $contact)
                        <tr class="group hover:bg-emerald-50/30 transition-colors dark:hover:bg-emerald-950/10">
                            {{-- Contact Name with Avatar --}}
                            <td class="px-6 py-4">
                                <a href="{{ route('contact.show', $contact) }}" wire:navigate
                                    class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-sm font-semibold text-white">
                                        {{ mb_substr($contact->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-semibold text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                            {{ $contact->name }}
                                        </p>
                                        @if ($contact->company_name)
                                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                                {{ $contact->company_name }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            </td>

                            {{-- Email & Phone --}}
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}"
                                            class="flex items-center gap-2 text-sm text-zinc-600 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400">
                                            <flux:icon name="envelope" class="h-4 w-4" />
                                            <span class="truncate max-w-[200px]">{{ $contact->email }}</span>
                                        </a>
                                    @endif
                                    @if ($contact->phone)
                                        <a href="tel:{{ $contact->phone }}"
                                            class="flex items-center gap-2 text-sm text-zinc-600 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400">
                                            <flux:icon name="phone" class="h-4 w-4" />
                                            <span>{{ $contact->phone }}</span>
                                        </a>
                                    @endif
                                    @if (!$contact->email && !$contact->phone)
                                        <span class="text-sm text-zinc-400">-</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Type & Status --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @if ($contact->type)
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                            {{ ucfirst($contact->type->value) }}
                                        </span>
                                    @endif
                                    @if ($contact->status)
                                        <span
                                            class="inline-flex items-center rounded-full
                                            {{ $contact->status->value === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                            {{ $contact->status->value === 'inactive' ? 'bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400' : '' }}
                                            {{ $contact->status->value === 'blocked' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                            px-2.5 py-0.5 text-xs font-medium">
                                            {{ ucfirst($contact->status->value) }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Last Updated --}}
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                <div class="flex items-center gap-2">
                                    <flux:icon name="clock" class="h-4 w-4 text-zinc-400" />
                                    <span>{{ $contact->updated_at->diffForHumans() }}</span>
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-sm text-right">
                                <div
                                    class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <flux:button icon="eye" variant="ghost" size="sm" wire:navigate
                                        href="{{ route('contact.show', $contact) }}"
                                        class="hover:!bg-emerald-100 hover:!text-emerald-700 dark:hover:!bg-emerald-900/30 dark:hover:!text-emerald-400" />

                                    <flux:modal.trigger name="delete-contact-{{ $contact->id }}">
                                        <flux:button icon="trash" variant="ghost" size="sm"
                                            class="hover:!bg-red-100 hover:!text-red-700 dark:hover:!bg-red-900/30 dark:hover:!text-red-400" />
                                    </flux:modal.trigger>

                                    <flux:modal name="delete-contact-{{ $contact->id }}" class="max-w-md">
                                        <div class="space-y-6">
                                            <div class="flex items-start text-left gap-4">
                                                <div class="rounded-full bg-red-50 p-3 dark:bg-red-950 shrink-0">
                                                    <flux:icon name="trash"
                                                        class="h-6 w-6 text-red-600 dark:text-red-400" />
                                                </div>
                                                <div class="space-y-2">
                                                    <flux:heading size="lg">Delete Contact</flux:heading>
                                                    <flux:text class="leading-relaxed">
                                                        Are you sure you want to delete
                                                        <strong>{{ $contact->name }}</strong>? This action cannot be
                                                        undone.
                                                    </flux:text>
                                                </div>
                                            </div>

                                            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4">
                                                <flux:modal.close>
                                                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel
                                                    </flux:button>
                                                </flux:modal.close>
                                                <flux:button type="submit" variant="primary"
                                                    wire:click="deleteContact({{ $contact->id }})"
                                                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 border-0">
                                                    Delete Contact
                                                </flux:button>
                                            </div>
                                        </div>
                                    </flux:modal>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                        <flux:icon name="users"
                                            class="w-8 h-8 text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                    <div>
                                        <p class="text-zinc-900 dark:text-white font-semibold">No contacts found</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                            Try adjusting your search or add a new contact
                                        </p>
                                    </div>
                                    <flux:modal.trigger name="add-contact-modal">
                                        <flux:button variant="primary" icon="plus" size="sm"
                                            class="mt-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-0">
                                            Add Your First Contact
                                        </flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table Footer with Count --}}
        @if ($this->contacts->count() > 0)
            <div class="px-6 py-4 border-t border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-800/50">
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Showing <span
                        class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $this->contacts->count() }}</span>
                    {{ Str::plural('contact', $this->contacts->count()) }}
                </p>
            </div>
        @endif
    </div>
</div>
