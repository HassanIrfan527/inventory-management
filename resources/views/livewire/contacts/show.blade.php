<div class="w-full">
    {{-- Top Navigation --}}
    <div class="mb-6 flex items-center justify-between">
        <flux:button variant="ghost" wire:navigate href="{{ route('contacts.all') }}" icon="arrow-left"
            class="!pl-0 md:!pl-3">
            Back to contacts
        </flux:button>

        <flux:modal.trigger name="delete-modal">
            <flux:button variant="danger" icon="trash"
                class="!text-red-600 dark:!text-red-400 hover:!bg-red-50 dark:hover:!bg-red-900/20 !bg-transparent border-0">
                Delete Contact
            </flux:button>
        </flux:modal.trigger>
    </div>

    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 lg:grid-cols-3">

        {{-- LEFT COLUMN: Contact Profile --}}
        <div class="lg:col-span-1 space-y-6">
            <div
                class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

                {{-- Profile Header --}}
                <div class="relative bg-zinc-50 px-6 py-8 text-center dark:bg-zinc-800/50">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-indigo-100 text-2xl font-bold text-indigo-600 ring-4 ring-white dark:bg-indigo-900/50 dark:text-indigo-300 dark:ring-zinc-800">
                        {{ mb_substr($contact->name, 0, 1) }}
                    </div>
                    <div class="mt-4">
                        <h1 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">{{ $contact->name }}</h1>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $contact->email }}</p>
                    </div>
                </div>

                {{-- Contact Details --}}
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Contact Information</h2>
                        @if (!$edit)
                            <flux:button size="sm" variant="subtle" icon="pencil" wire:click="$set('edit', true)"
                                class="!h-8 !w-8 !rounded-full !p-0" aria-label="Edit Contact" />
                        @endif
                    </div>

                    @if ($edit)
                        <form wire:submit="save" class="space-y-4">
                            <flux:input label="Phone" icon="phone" wire:model="phone"
                                placeholder="+1 234 567 890" />
                            <flux:input label="Address" icon="map-pin" wire:model="address"
                                placeholder="Residential address" />
                            <flux:input label="Landmark" icon="map-pin-house" wire:model="landmark"
                                placeholder="Nearby landmark" />

                            <div class="flex gap-2 pt-2">
                                <flux:button type="submit" variant="primary" color="indigo" class="flex-1">Save
                                </flux:button>
                                <flux:button type="button" variant="ghost" wire:click="cancel" class="flex-1">Cancel
                                </flux:button>
                            </div>
                        </form>
                    @else
                        <div class="space-y-4">
                            <div
                                class="flex items-start gap-3 rounded-lg p-2 transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <flux:icon.phone class="mt-0.5 h-5 w-5 text-zinc-400" />
                                <div>
                                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Phone</p>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $contact->phone ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-lg p-2 transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <flux:icon.map-pin class="mt-0.5 h-5 w-5 text-zinc-400" />
                                <div>
                                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Address</p>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $contact->address ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-lg p-2 transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <flux:icon.map-pin-house class="mt-0.5 h-5 w-5 text-zinc-400" />
                                <div>
                                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Landmark</p>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $contact->landmark ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Quick Stats or Other Info (Future Proofing) --}}
            <div class="grid grid-cols-2 gap-4">
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm text-center dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ $this->activities->where('description', 'like', '%Order%')->count() }}
                    </div>
                    <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Total Orders</div>
                </div>
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm text-center dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ round($contact->created_at->diffInDays(now()), 0) }}
                    </div>
                    <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Days Active</div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Timeline & Notes --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Note Composer --}}
            <div
                class="rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex gap-4">
                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                        <flux:icon.user class="h-5 w-5 text-zinc-400" />
                    </div>
                    <div class="flex-1">
                        <flux:textarea wire:model="note" placeholder="Write a note about {{ $contact->name }}..."
                            class="mb-3 border-0 bg-transparent p-0 focus:ring-0 text-base placeholder:text-zinc-400"
                            rows="2" />
                        <div
                            class="flex items-center justify-between border-t border-zinc-100 pt-3 dark:border-zinc-800">
                            <div class="flex gap-2">
                                {{-- Attachments or other actions could go here --}}
                            </div>
                            <flux:button variant="primary" size="sm" color="indigo" wire:click="addNote">Add Note
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activity Feed --}}
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Activity Timeline</h3>
                </div>

                <div class="p-6">
                    @if ($this->activities->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                <flux:icon.clock class="h-6 w-6 text-zinc-400" />
                            </div>
                            <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-zinc-100">No activity yet
                            </h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Start by adding a note or creating
                                an order.</p>
                        </div>
                    @else
                        <div class="relative pl-4 sm:pl-6">
                            {{-- Vertical Line --}}
                            <div
                                class="absolute bottom-0 left-0 top-0 w-px bg-zinc-200 dark:bg-zinc-800 ml-4 sm:ml-6 translate-x-3.5">
                            </div>

                            <div class="space-y-8">
                                @foreach ($this->activities as $activity)
                                    <div class="relative flex items-start gap-4"
                                        wire:key="activity-{{ $activity->id }}">

                                        {{-- Icon --}}
                                        <div
                                            class="relative z-10 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ring-4 ring-white dark:ring-zinc-900
                                            {{ str_contains($activity->description, 'Order')
                                                ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400'
                                                : (str_contains($activity->description, 'Note')
                                                    ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400'
                                                    : 'bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400') }}">

                                            @if (str_contains($activity->description, 'Order'))
                                                <flux:icon.shopping-bag variant="mini" />
                                            @elseif(str_contains($activity->description, 'Note'))
                                                <flux:icon.chat-bubble-left-ellipsis variant="mini" />
                                            @elseif(str_contains($activity->description, 'Updated'))
                                                <flux:icon.pencil-square variant="mini" />
                                            @else
                                                <flux:icon.clock variant="mini" />
                                            @endif
                                        </div>

                                        {{-- Content --}}
                                        <div
                                            class="flex-1 rounded-lg border border-zinc-100 bg-zinc-50/50 p-4 transition hover:bg-zinc-50 dark:border-zinc-800/50 dark:bg-zinc-800/20 dark:hover:bg-zinc-800/50">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    {{ $activity->description }}
                                                </p>
                                                <time class="text-xs text-zinc-500 dark:text-zinc-400"
                                                    datetime="{{ $activity->created_at->toIso8601String() }}">
                                                    {{ $activity->created_at->diffForHumans() }}
                                                </time>
                                            </div>

                                            @if ($activity->subject instanceof \App\Models\Order)
                                                <div
                                                    class="mt-2 flex items-center gap-2 text-xs text-zinc-600 dark:text-zinc-400">
                                                    <span
                                                        class="inline-flex items-center rounded-md bg-white px-2 py-1 font-medium text-zinc-700 ring-1 ring-inset ring-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700">
                                                        Order #{{ $activity->subject->order_number }}
                                                    </span>
                                                    <span>•</span>
                                                    <span>Rs.
                                                        {{ number_format($activity->subject->total_amount) }}</span>
                                                </div>
                                            @endif

                                            @php $props = is_string($activity->properties) ? json_decode($activity->properties, true) : $activity->properties; @endphp
                                            @if (isset($props['content']))
                                                <div class="mt-3 text-sm text-zinc-600 dark:text-zinc-300">
                                                    {{ $props['content'] }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-modals.delete-modal :itemId="$contact->id" :itemName="$contact->name" :title="'Delete Contact'" />
</div>
