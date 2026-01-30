<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-2">
        <div class="inline-flex items-center gap-2 rounded-full bg-neutral-100 px-3 py-1 text-xs font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 w-fit">
            <flux:icon.users class="w-3.5 h-3.5" />
            <span>CRM · Contacts</span>
        </div>
        <flux:heading size="xl" level="1">Contacts</flux:heading>
        <flux:text size="sm" class="text-neutral-600 dark:text-neutral-400">
            Manage and view all your contacts in one place.
        </flux:text>
    </div>

    <!-- Search & Filters Section -->
    <div class="flex flex-col gap-4 rounded-lg border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-neutral-900"
        x-data="{ showFilters: false }">

        <!-- Search Bar -->
        <div class="flex gap-3">
            <div class="flex-1 relative">
                <flux:input wire:model.live.debounce.300ms="search" placeholder="Search contacts by name or email..." icon="magnifying-glass" />
            </div>

            <!-- Filter Toggle Button -->
            <flux:button @click="showFilters = !showFilters" icon="adjustments-horizontal" variant="ghost" />

            <!-- Add New Contact Button -->
            <flux:modal.trigger name="add-contact-modal">
                <flux:button variant="primary" color="indigo" icon="plus">Add Contact</flux:button>
            </flux:modal.trigger>
        </div>

        <!-- Filter Options (Hidden by default) -->
        <div x-show="showFilters" x-transition
            class="flex gap-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
            <flux:select wire:model.live="sortBy" class="max-w-xs">
                <option value="name">Name (A-Z)</option>
                <option value="created_at">Newest First</option>
                <option value="updated_at">Recently Updated</option>
            </flux:select>

            <flux:button variant="ghost" wire:click="$set('search', ''); $set('sortBy', 'name');">
                Reset Filters
            </flux:button>
        </div>
    </div>

    <!-- Contacts Table -->
    <div
        class="rounded-lg border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-800/50">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">Name
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">Phone
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">
                            Created</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">
                            Updated</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-neutral-900 dark:text-white">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                    @forelse($this->contacts as $contact)
                        <tr class="hover:bg-neutral-50 transition-colors dark:hover:bg-neutral-800/50">
                            <td class="px-6 py-4 text-sm text-neutral-900 dark:text-white font-medium">
                                <a href="{{ route('contact.show', $contact) }}" wire:navigate>
                                    {{ $contact->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                @if ($contact->phone)
                                    <a href="tel:{{ $contact->phone }}"
                                        class="text-blue-600 hover:underline dark:text-blue-400">
                                        {{ $contact->phone }}
                                    </a>
                                @else
                                    <span class="text-neutral-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $contact->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $contact->updated_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:button icon="pencil-square" variant="ghost" size="sm" wire:navigate href="{{ route('contact.show', $contact) }}?edit=true" />

                                    <flux:modal.trigger name="delete-contact-{{ $contact->id }}">
                                        <flux:button icon="trash" variant="ghost" color="danger" size="sm" />
                                    </flux:modal.trigger>

                                    <flux:modal name="delete-contact-{{ $contact->id }}" class="max-w-md">
                                        <div class="space-y-6">
                                            <div class="flex items-start text-left gap-4">
                                                <div class="rounded-full bg-red-50 p-3 dark:bg-red-950 shrink-0">
                                                    <flux:icon icon="trash-2" class="h-6 w-6 text-red-600 dark:text-red-400" />
                                                </div>
                                                <div class="space-y-2">
                                                    <flux:heading size="lg">Delete Contact</flux:heading>
                                                    <flux:text class="leading-relaxed">
                                                        Are you sure you want to delete <strong>{{ $contact->name }}</strong>? This action cannot be undone.
                                                    </flux:text>
                                                </div>
                                            </div>

                                            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4">
                                                <flux:modal.close>
                                                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                                                </flux:modal.close>
                                                <flux:button type="submit" variant="primary" color="danger" wire:click="deleteContact({{ $contact->id }})" class="w-full sm:w-auto">
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
                                    <flux:icon.users class="w-12 h-12 text-neutral-300 dark:text-neutral-600" />
                                    <div>
                                        <p class="text-neutral-600 dark:text-neutral-400 font-medium">No contacts
                                            found</p>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-500">Try adjusting
                                            your search or add a new contact</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer with Count -->
        <div
            class="px-6 py-4 border-t border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-800/50">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                Showing <span class="font-semibold text-neutral-900 dark:text-white">{{ $this->contacts->count() }}</span>
                contacts
            </p>
        </div>
    </div>

</div>
