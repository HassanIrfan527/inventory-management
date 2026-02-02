@props([
    'label' => null,
    'value' => null,
    'icon' => null,
    'wireModel' => null,
    'placeholder' => null,
    'inputType' => 'text',
    'emptyText' => 'N/A',
    'options' => null,
])

<div
    {{ $attributes->merge(['class' => 'group relative flex items-start gap-3 rounded-lg p-3 transition hover:bg-zinc-50 dark:hover:bg-zinc-800/30']) }}>
    @if ($icon)
        <flux:icon :name="$icon" class="mt-0.5 h-5 w-5 flex-shrink-0 text-zinc-400" />
    @endif

    <div class="flex-1 min-w-0">
        <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1">{{ $label }}
        </p>

        @if ($wireModel)
            {{-- Inline Editable Field --}}
            <div class="relative inline-editable-field">
                @if ($inputType === 'select' && $options)
                    <select wire:model.blur="{{ $wireModel }}"
                        class="w-full border-0 border-b-2 border-transparent bg-transparent px-0 py-1 text-sm font-medium text-zinc-900 transition focus:border-emerald-500 focus:outline-none focus:ring-0 hover:border-zinc-300 dark:text-zinc-100 dark:hover:border-zinc-600 dark:focus:border-emerald-400">
                        <option value="">Select {{ $label }}</option>
                        @foreach ($options as $key => $option)
                            <option value="{{ is_array($option) ? $option['value'] : $key }}">
                                {{ is_array($option) ? $option['label'] : $option }}
                            </option>
                        @endforeach
                    </select>
                @elseif ($inputType === 'textarea')
                    <textarea wire:model.blur="{{ $wireModel }}" placeholder="{{ $placeholder ?? $label }}" rows="3"
                        class="w-full border-0 border-b-2 border-transparent bg-transparent px-0 py-1 text-sm font-medium text-zinc-900 transition focus:border-emerald-500 focus:outline-none focus:ring-0 hover:border-zinc-300 dark:text-zinc-100 dark:hover:border-zinc-600 dark:focus:border-emerald-400"></textarea>
                @elseif ($inputType === 'date')
                    <input type="date" wire:model.blur="{{ $wireModel }}"
                        class="w-full border-0 border-b-2 border-transparent bg-transparent px-0 py-1 text-sm font-medium text-zinc-900 transition focus:border-emerald-500 focus:outline-none focus:ring-0 hover:border-zinc-300 dark:text-zinc-100 dark:hover:border-zinc-600 dark:focus:border-emerald-400" />
                @else
                    <input type="{{ $inputType }}" wire:model.blur="{{ $wireModel }}"
                        placeholder="{{ $placeholder ?? $label }}"
                        class="w-full border-0 border-b-2 border-transparent bg-transparent px-0 py-1 text-sm font-medium text-zinc-900 transition focus:border-emerald-500 focus:outline-none focus:ring-0 hover:border-zinc-300 dark:text-zinc-100 dark:hover:border-zinc-600 dark:focus:border-emerald-400 {{ $value ? '' : 'text-zinc-400 dark:text-zinc-500' }}" />
                @endif
            </div>
        @else
            {{-- Display Only --}}
            @if ($slot && !$slot->isEmpty())
                <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                    {{ $slot }}
                </div>
            @else
                <p
                    class="text-sm font-medium {{ $value ? 'text-zinc-900 dark:text-zinc-100' : 'text-zinc-400 dark:text-zinc-500' }}">
                    {{ $value ?: $emptyText }}
                </p>
            @endif
        @endif
    </div>

    @if ($wireModel)
        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
            <flux:icon name="pencil" class="h-4 w-4 text-zinc-400" />
        </div>
    @endif
</div>
