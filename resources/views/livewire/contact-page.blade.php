<div class="h-full w-full">

    <flux:button variant="ghost" href="javascript:history.back()" icon="arrow-left" />

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div>
                    <flux:heading>{{ $contact->name }}</flux:heading>
                    <flux:text class="text-zinc-500 dark:text-zinc-400">{{ $contact->email }}</flux:text>
                </div>
            </div>
            @unless ($edit)
                <div class="flex items-center gap-2">
                    <flux:button variant="primary" color="blue" wire:click="$set('edit', true)">Edit</flux:button>
                    <flux:button variant="danger">Delete</flux:button>
                </div>
            @endunless
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
                            <form wire:submit>
                                <flux:input class="mt-4" icon="phone" label="Phone number" wire:model.blur="phone" />
                                <flux:input class="mt-4" icon="whatsapp" label="WhatsApp Number" wire:model.blur="whatsapp_no" />
                                <flux:input class="mt-4" icon="map-pin" label="Address" wire:model.blur="address" />
                                <flux:input class="mt-4" icon="map-pin-house" label="Landmark" wire:model.blur="landmark" />
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
                <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="border-b border-zinc-200 p-4 dark:border-zinc-700">
                        <flux:heading level="3" label="Notes" />
                    </div>
                    <div class="p-6">
                        <flux:textarea placeholder="Add a note..." class="min-h-[10rem]" />
                        <div class="mt-4 flex justify-end">
                            <flux:button variant="primary">Save Note</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
