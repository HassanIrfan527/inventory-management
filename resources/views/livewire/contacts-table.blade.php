<div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Page Header -->
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Contacts</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Manage and view all your contacts in one place</p>
        </div>

        <!-- Search & Filters Section -->
        <div class="flex flex-col gap-4 rounded-lg border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-neutral-900"
            x-data="{ showFilters: false }">

            <!-- Search Bar -->
            <div class="flex gap-3">
                <div class="flex-1 relative">
                    <input type="text" placeholder="Search contacts by name or email..." wire:model.live="search"
                        class="w-full px-4 py-2.5 pl-10 rounded-lg border border-neutral-300 bg-white text-neutral-900 placeholder-neutral-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white dark:placeholder-neutral-400 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-neutral-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Filter Toggle Button -->
                <button @click="showFilters = !showFilters"
                    class="px-4 py-2.5 rounded-lg border border-neutral-300 bg-white text-neutral-700 font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
                    <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>

                <!-- Add New Contact Button -->
                <a href="#"
                    class="px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors dark:bg-blue-500 dark:hover:bg-blue-600 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Contact
                </a>
            </div>

            <!-- Filter Options (Hidden by default) -->
            <div x-show="showFilters" x-transition
                class="flex gap-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                <select wire:model.live="sortBy"
                    class="px-3 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-700 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300">
                    <option value="">Sort by...</option>
                    <option value="name">Name (A-Z)</option>
                    <option value="created_at">Newest First</option>
                    <option value="updated_at">Recently Updated</option>
                </select>

                <button wire:click="$refresh"
                    class="px-3 py-2 rounded-lg border border-neutral-300 bg-white text-neutral-700 text-sm font-medium hover:bg-neutral-50 transition-colors dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
                    Reset Filters
                </button>
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
                                WhatsApp</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">
                                Created</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-white">
                                Updated</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-neutral-900 dark:text-white">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                        @forelse($contacts as $contact)
                            <tr class="hover:bg-neutral-50 transition-colors dark:hover:bg-neutral-800/50">
                                <td class="px-6 py-4 text-sm text-neutral-900 dark:text-white font-medium">
                                    {{ $contact->name }}</td>
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
                                    @if ($contact->whatsapp_no)
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact->whatsapp_no) }}"
                                            target="_blank"
                                            class="text-green-600 hover:underline dark:text-green-400 flex items-center gap-1">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                                                    clip-rule="evenodd" />
                                                <path fill="currentColor"
                                                    d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                                            </svg>

                                            {{ $contact->whatsapp_no }}
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
                                <td class="px-6 py-4 text-sm text-center">
                                    <div class="flex justify-center gap-2">
                                        <button
                                            class="p-2 text-neutral-600 hover:bg-neutral-100 rounded-lg transition-colors dark:text-neutral-400 dark:hover:bg-neutral-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button
                                            class="p-2 text-neutral-600 hover:bg-neutral-100 rounded-lg transition-colors dark:text-neutral-400 dark:hover:bg-neutral-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <svg class="w-12 h-12 text-neutral-300 dark:text-neutral-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
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
                    Showing <span
                        class="font-semibold text-neutral-900 dark:text-white">{{ $contacts->count() }}</span> contacts
                </p>
            </div>
        </div>
    </div>
