<div class="h-full w-full">

    <flux:button variant="ghost" wire:navigate href="{{ route('contacts.all') }}" icon="arrow-left" />

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div>
                    <flux:heading>{{ $contact->name }}</flux:heading>
                    <flux:text class="text-zinc-500 dark:text-zinc-400">{{ $contact->email }}</flux:text>
                </div>
            </div>
            @if ($edit)
                <div class="flex items-center gap-2">
                    <flux:button variant="outline" color="zinc" wire:click="$set('edit', false)">Cancel</flux:button>
                    <flux:modal.trigger name="delete-modal">
                        <flux:button variant="danger">Delete</flux:button>
                    </flux:modal.trigger>

                </div>
            @else
                <div class="flex items-center gap-2">
                    <flux:button variant="primary" color="indigo" wire:click="$set('edit', true)">Edit</flux:button>

                    <flux:modal.trigger name="delete-modal">
                        <flux:button variant="danger">Delete</flux:button>
                    </flux:modal.trigger>
                </div>
            @endif
        </div>

        {{-- Details --}}
        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{-- Left column --}}
            <div class="space-y-8 lg:col-span-2">
                <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                        <flux:heading>Contact Details</flux:heading>
                    </div>
                    <div class="space-y-6 p-6">
                        @if ($edit)
                            <form class="space-y-6">
                                <flux:input class="mt-4" icon="phone" label="Phone number" x-mask="9999-9999999"
                                    maxlength="12" wire:model.blur="phone" />

                                <flux:input class="mt-4" icon="whatsapp" label="WhatsApp Number"
                                    wire:model.blur="whatsapp_no" maxlength="12" x-mask="9999-9999999" />
                                <flux:input class="mt-4" icon="map-pin" label="Address" wire:model.blur="address" />
                                <flux:input class="mt-4" icon="map-pin-house" label="Landmark"
                                    wire:model.blur="landmark" />

                            </form>
                        @else
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <flux:icon.phone class="mr-2 text-zinc-400" />
                                    <flux:heading>Phone number</flux:heading>
                                </div>
                                <div>
                                    <flux:text class="mt-1 ml-[30px] text-zinc-500 dark:text-zinc-400">
                                        {{ $contact->phone }}
                                    </flux:text>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <flux:icon.whatsapp class="mr-2 text-zinc-400" />
                                    <flux:heading>WhatsApp Number</flux:heading>
                                </div>
                                <div>
                                    <flux:text class="mt-1 ml-[30px] text-zinc-500 dark:text-zinc-400">
                                        {{ $contact->whatsapp_no }}</flux:text>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <flux:icon.map-pin class="mr-2 text-zinc-400" />
                                    <flux:heading>Address</flux:heading>
                                </div>
                                <div>
                                    <flux:text class="mt-1 ml-[30px] text-zinc-500 dark:text-zinc-400">
                                        {{ $contact->address }}</flux:text>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <flux:icon.map-pin-house class="mr-2 text-zinc-400" />
                                    <flux:heading>Landmark</flux:heading>
                                </div>
                                <div>
                                    <flux:text class="mt-1 ml-[30px] text-zinc-500 dark:text-zinc-400">
                                        {{ $contact->landmark }}</flux:text>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right column --}}
            <div class="space-y-8">
                {{-- Add Note --}}
                <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                        <flux:heading level="3">Add Note</flux:heading>
                    </div>
                    <div class="p-6">
                        <flux:textarea wire:model="note" placeholder="Add a note about this contact..." class="min-h-[8rem]" />
                        <div class="mt-4 flex justify-end">
                            <flux:button variant="primary" color="indigo" wire:click="addNote">Save Note</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity Feed (Bottom Full Width) --}}
        <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                <flux:heading level="3">Activity Feed</flux:heading>
            </div>
            <div class="p-6">
                @if ($this->activities->isEmpty())
                    <flux:text class="py-8 text-center">No activities recorded yet.</flux:text>
                @else
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach ($this->activities as $activity)
                                <li wire:key="activity-{{ $activity->id }}">
                                    <div class="relative pb-8">
                                        @if (!$loop->last)
                                            <span
                                                class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-zinc-200 dark:bg-zinc-700"
                                                aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white dark:ring-zinc-800 {{ str_contains($activity->description, 'Order') ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/30' : (str_contains($activity->description, 'Note') ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/30' : 'bg-zinc-100 text-zinc-600 dark:bg-zinc-700') }}">
                                                    @if (str_contains($activity->description, 'Order'))
                                                        <flux:icon.shopping-bag variant="mini" />
                                                    @elseif(str_contains($activity->description, 'Note'))
                                                        <flux:icon.chat-bubble-left-ellipsis variant="mini" />
                                                    @elseif(str_contains($activity->description, 'Updated'))
                                                        <flux:icon.pencil-square variant="mini" />
                                                    @else
                                                        <flux:icon.clock variant="mini" />
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <flux:text size="sm" class="font-medium text-zinc-900 dark:text-zinc-100">
                                                        {{ $activity->description }}
                                                    </flux:text>

                                                    @if ($activity->subject instanceof \App\Models\Order)
                                                        <flux:text size="xs" class="mt-1">
                                                            Order #{{ $activity->subject->order_number }} • Rs.
                                                            {{ number_format($activity->subject->total_amount) }}
                                                        </flux:text>
                                                    @endif

                                                    @php $props = is_string($activity->properties) ? json_decode($activity->properties, true) : $activity->properties; @endphp
                                                    @if (isset($props['content']))
                                                        <div
                                                            class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-900/50 p-3 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                                            {{ $props['content'] }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="whitespace-nowrap text-right text-xs text-zinc-500">
                                                    <time datetime="{{ $activity->created_at->toIso8601String() }}">
                                                        {{ $activity->created_at->diffForHumans() }}
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-modals.delete-modal :itemId="$contact->id" :itemName="$contact->name" :title="'Delete Contact'" />

</div>
