<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Company Information')" :subheading="__('Update your company information')">
        <form wire:submit="updateCompanyInformation" class="my-6 w-full space-y-6">

            {{-- Company Logo --}}
            <div class="group relative mt-6 w-full max-w-xs">
                <div
                    class="relative aspect-square overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-900">
                    @if ($temporaryUploadedFile)
                        <img src="{{ $temporaryUploadedFile->temporaryUrl() }}" alt="{{ __('Company Logo') }}"
                            class="h-full w-full object-cover">
                    @elseif ($companyLogo)
                        <img src="{{ Storage::url($companyLogo) }}" alt="{{ __('Company Logo') }}"
                            class="h-full w-full object-cover">
                    @endif
                    <div class="flex h-full items-center justify-center">
                        <flux:icon name="image" class="h-12 w-12 text-gray-400 dark:text-gray-500" />
                    </div>

                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
                        <div class="text-center">
                            <flux:icon name="cloud-arrow-up" class="mx-auto h-8 w-8 text-white" />
                            <p class="mt-2 text-sm font-medium text-white">{{ __('Upload Image') }}</p>
                        </div>
                    </div>

                    <input type="file" wire:model="temporaryUploadedFile" accept="image/*"
                        class="absolute inset-0 cursor-pointer opacity-0">
                </div>

                @error('temporaryUploadedFile')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <flux:input wire:model="companyName" :label="__('Company Name')" type="text" required autofocus
                autocomplete="name" />

            <div class="mt-6 space-y-6">
                <flux:input wire:model="companyEmail" :label="__('Company Email')" type="email" required
                    autocomplete="email" />
                <flux:input wire:model="companyPhone" :label="__('Company Phone')" wire:mask="9999-9999999"
                    autocomplete="tel" />
                <flux:input wire:model="companyWebsite" :label="__('Company Website')" type="url"
                    autocomplete="url" />

            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>
            </div>
        </form>

    </x-settings.layout>
</section>
