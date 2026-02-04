<div class="w-full">

    @php
        $breadcrumbItem = [
            [
                'name' => 'Contacts',
                'href' => route('contacts.all'),
                'icon' => 'users',
            ],
            [
                'name' => $contact->name,
                'href' => route('contact.show', $contact),
                'icon' => 'user',
            ],
        ];
    @endphp
    <!-- Breadcrumbs -->
    <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>
    {{-- Top Navigation --}}
    <div class="mb-6 mt-4 flex items-center justify-between">
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

    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- LEFT COLUMN: Contact Profile & Quick Info --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Profile Card --}}
                <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    {{-- Avatar & Name Section --}}
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 px-6 py-8 text-center dark:from-emerald-950/20 dark:to-teal-950/20">
                        <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-3xl font-bold text-white ring-4 ring-white dark:ring-zinc-900">
                            {{ mb_substr($contact->name, 0, 1) }}
                        </div>
                        <div class="mt-4">
                            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $contact->name }}</h1>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                @if ($contact->job_title)
                                    {{ $contact->job_title }}
                                    @if ($contact->company_name)
                                        <span class="text-zinc-400">at</span> {{ $contact->company_name }}
                                    @endif
                                @elseif ($contact->company_name)
                                    {{ $contact->company_name }}
                                @else
                                    {{ $contact->email ?: 'No email' }}
                                @endif
                            </p>
                        </div>

                        {{-- Status Badges --}}
                        <div class="mt-4 flex flex-wrap items-center justify-center gap-2">
                            @if ($contact->type)
                                <span class="inline-flex items-center rounded-full bg-teal-100 px-3 py-1 text-xs font-medium text-teal-700 dark:bg-teal-900/30 dark:text-teal-400">
                                    {{ ucfirst($contact->type->value) }}
                                </span>
                            @endif
                            @if ($contact->status)
                                <span class="inline-flex items-center rounded-full
                                    {{ $contact->status->value === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $contact->status->value === 'inactive' ? 'bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400' : '' }}
                                    {{ $contact->status->value === 'blocked' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                    px-3 py-1 text-xs font-medium">
                                    {{ ucfirst($contact->status->value) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="border-t border-zinc-200 p-4 dark:border-zinc-800">
                        {{-- <div class="grid grid-cols-2 gap-3">
                            @if ($contact->phone)
                                <a href="tel:{{ $contact->phone }}" class="flex items-center justify-center gap-2 rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                                    <flux:icon name="phone" class="h-4 w-4" />
                                    Call
                                </a>
                            @endif
                            @if ($contact->email)
                                <a href="mailto:{{ $contact->email }}" class="flex items-center justify-center gap-2 rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                                    <flux:icon name="envelope" class="h-4 w-4" />
                                    Email
                                </a>
                            @endif
                        </div> --}}
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-xl border border-zinc-200 bg-white p-4 text-center dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                            {{ $this->activities->where('description', 'like', '%Order%')->count() }}
                        </div>
                        <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Total Orders</div>
                    </div>
                    <div class="rounded-xl border border-zinc-200 bg-white p-4 text-center dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                            {{ round($contact->created_at->diffInDays(now()), 0) }}
                        </div>
                        <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Days Active</div>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Details & Timeline --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ESSENTIAL INFORMATION --}}
                <x-contacts.collapsible-section
                    wire-model="sectionEssential"
                    :is-open="$sectionEssential"
                    title="Essential Information"
                    subtitle="Click any field to edit"
                    icon="user"
                >
                    <div class="space-y-1">
                        <x-contacts.field-row
                            label="First Name"
                            :value="$form->first_name"
                            wire-model="form.first_name"
                            icon="user"
                            placeholder="Enter first name"
                        />
                        <x-contacts.field-row
                            label="Last Name"
                            :value="$form->last_name"
                            wire-model="form.last_name"
                            icon="user"
                            placeholder="Enter last name"
                        />
                        <x-contacts.field-row
                            label="Email Address"
                            :value="$form->email"
                            wire-model="form.email"
                            input-type="email"
                            icon="envelope"
                            placeholder="email@example.com"
                        />
                        <x-contacts.field-row
                            label="Phone Number"
                            :value="$form->phone"
                            wire-model="form.phone"
                            icon="phone"
                            placeholder="+1234567890"
                        />
                        <x-contacts.field-row
                            label="Contact Type"
                            :value="ucfirst($form->type)"
                            wire-model="form.type"
                            input-type="select"
                            :options="$this->typeOptions"
                            icon="tag"
                        />
                        <x-contacts.field-row
                            label="Status"
                            :value="ucfirst($form->status)"
                            wire-model="form.status"
                            input-type="select"
                            :options="$this->statusOptions"
                            icon="clipboard-document-check"
                        />
                    </div>
                </x-contacts.collapsible-section>

                {{-- BUSINESS INFORMATION --}}
                <x-contacts.collapsible-section
                    wire-model="sectionBusiness"
                    :is-open="$sectionBusiness"
                    title="Business Information"
                    subtitle="Professional details"
                    icon="building-office"
                >
                    <div class="space-y-1">
                        <x-contacts.field-row
                            label="Company Name"
                            :value="$form->company_name"
                            wire-model="form.company_name"
                            icon="building-office"
                            placeholder="Acme Corporation"
                        />
                        <x-contacts.field-row
                            label="Job Title"
                            :value="$form->job_title"
                            wire-model="form.job_title"
                            icon="briefcase"
                            placeholder="Software Engineer"
                        />
                    </div>
                </x-contacts.collapsible-section>

                {{-- CONTACT PREFERENCES --}}
                <x-contacts.collapsible-section
                    wire-model="sectionContact"
                    :is-open="$sectionContact"
                    title="Contact Preferences"
                    subtitle="Communication settings"
                    icon="chat-bubble-left-right"
                >
                    <div class="space-y-1">
                        <x-contacts.field-row
                            label="Preferred Contact Method"
                            :value="$form->preferred_contact_method"
                            wire-model="form.preferred_contact_method"
                            input-type="select"
                            :options="$this->preferredContactMethodOptions"
                            icon="chat-bubble-left-right"
                        />
                    </div>
                </x-contacts.collapsible-section>

                {{-- LOCATION DETAILS --}}
                <x-contacts.collapsible-section
                    wire-model="sectionLocation"
                    :is-open="$sectionLocation"
                    title="Location Details"
                    subtitle="Address information"
                    icon="map-pin"
                >
                    <div class="space-y-1">
                        <x-contacts.field-row
                            label="Street Address"
                            :value="$form->address"
                            wire-model="form.address"
                            icon="map-pin"
                            placeholder="123 Main Street"
                        />
                        <x-contacts.field-row
                            label="Landmark"
                            :value="$form->landmark"
                            wire-model="form.landmark"
                            icon="map-pin-house"
                            placeholder="Near Central Park"
                        />
                        <div class="grid gap-1 md:grid-cols-2">
                            <x-contacts.field-row
                                label="City"
                                :value="$form->city"
                                wire-model="form.city"
                                icon="building-office-2"
                                placeholder="New York"
                            />
                            <x-contacts.field-row
                                label="State / Province"
                                :value="$form->state"
                                wire-model="form.state"
                                icon="map"
                                placeholder="NY"
                            />
                        </div>
                        <div class="grid gap-1 md:grid-cols-2">
                            <x-contacts.field-row
                                label="Country"
                                :value="$form->country"
                                wire-model="form.country"
                                icon="globe-alt"
                                placeholder="United States"
                            />
                            <x-contacts.field-row
                                label="ZIP / Postal Code"
                                :value="$form->zip_code"
                                wire-model="form.zip_code"
                                icon="hashtag"
                                placeholder="10001"
                            />
                        </div>
                    </div>
                </x-contacts.collapsible-section>

                {{-- CRM & MARKETING --}}
                <x-contacts.collapsible-section
                    wire-model="sectionCrm"
                    :is-open="$sectionCrm"
                    title="CRM & Marketing"
                    subtitle="Customer insights"
                    icon="chart-bar"
                >
                    <div class="space-y-1">
                        <x-contacts.field-row
                            label="Source"
                            :value="$form->source"
                            wire-model="form.source"
                            input-type="select"
                            :options="$this->sourceOptions"
                            icon="arrow-down-on-square"
                        />
                        <x-contacts.field-row
                            label="Date of Birth"
                            :value="$form->date_of_birth"
                            wire-model="form.date_of_birth"
                            input-type="date"
                            icon="cake"
                        />
                        <x-contacts.field-row
                            label="Engagement Score (0-100)"
                            :value="$form->engagement_score"
                            wire-model="form.engagement_score"
                            input-type="number"
                            icon="chart-bar"
                            placeholder="0"
                        />
                        <x-contacts.field-row
                            label="Notes"
                            :value="$form->notes"
                            wire-model="form.notes"
                            input-type="textarea"
                            icon="document-text"
                            placeholder="Additional notes..."
                        />
                    </div>
                </x-contacts.collapsible-section>

                {{-- ACTIVITY TIMELINE --}}
                <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Activity Timeline</h3>
                    </div>

                    {{-- Note Composer --}}
                    <div class="border-b border-zinc-200 bg-zinc-50/50 p-4 dark:border-zinc-800 dark:bg-zinc-800/30">
                        <div class="flex gap-4">
                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-semibold">
                                {{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <flux:textarea wire:model="note" placeholder="Add a note about {{ $contact->first_name }}..."
                                    class="mb-3 text-base placeholder:text-zinc-400"
                                    rows="2" />
                                <flux:button variant="primary" size="sm" wire:click="addNote">Add Note</flux:button>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($this->activities->isEmpty())
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon name="clock" class="h-6 w-6 text-zinc-400" />
                                </div>
                                <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-zinc-100">No activity yet</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Start by adding a note or creating an order.</p>
                            </div>
                        @else
                            <div class="relative space-y-6">
                                {{-- Vertical Line --}}
                                <div class="absolute bottom-0 left-4 top-0 w-px bg-zinc-200 dark:bg-zinc-800"></div>

                                @foreach ($this->activities as $activity)
                                    <div class="relative flex items-start gap-4" wire:key="activity-{{ $activity->id }}">
                                        {{-- Icon --}}
                                        <div class="relative z-10 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ring-4 ring-white dark:ring-zinc-900
                                            {{ str_contains($activity->description, 'Order')
                                                ? 'bg-teal-100 text-teal-600 dark:bg-teal-900/40 dark:text-teal-400'
                                                : (str_contains($activity->description, 'Note')
                                                    ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400'
                                                    : 'bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400') }}">

                                            @if (str_contains($activity->description, 'Order'))
                                                <flux:icon name="shopping-bag" variant="mini" />
                                            @elseif(str_contains($activity->description, 'Note'))
                                                <flux:icon name="chat-bubble-left-ellipsis" variant="mini" />
                                            @elseif(str_contains($activity->description, 'Updated'))
                                                <flux:icon name="pencil-square" variant="mini" />
                                            @else
                                                <flux:icon name="clock" variant="mini" />
                                            @endif
                                        </div>

                                        {{-- Content --}}
                                        <div class="flex-1 rounded-lg border border-zinc-100 bg-zinc-50/50 p-4 transition hover:bg-zinc-50 dark:border-zinc-800/50 dark:bg-zinc-800/20 dark:hover:bg-zinc-800/50">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    {{ $activity->description }}
                                                </p>
                                                <time class="text-xs text-zinc-500 dark:text-zinc-400"
                                                    datetime="{{ $activity->created_at->toIso8601String() }}">
                                                    {{ $activity->created_at->diffForHumans() }}
                                                </time>
                                            </div>

                                            @php $props = is_string($activity->properties) ? json_decode($activity->properties, true) : ($activity->properties ?? []); @endphp

                                            @if (isset($props['old_value']) && isset($props['new_value']))
                                                {{-- Show field change details --}}
                                                <div class="mt-3 flex items-center gap-3 rounded-lg bg-white p-3 dark:bg-zinc-900/50">
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-1">Previous Value</p>
                                                        <p class="text-sm text-zinc-700 dark:text-zinc-300 font-mono bg-zinc-100 dark:bg-zinc-800 px-2 py-1 rounded">
                                                            {{ $props['old_value'] }}
                                                        </p>
                                                    </div>
                                                    <flux:icon name="arrow-right" class="h-4 w-4 text-emerald-500 flex-shrink-0" />
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-1">New Value</p>
                                                        <p class="text-sm text-emerald-700 dark:text-emerald-400 font-mono bg-emerald-50 dark:bg-emerald-950/30 px-2 py-1 rounded font-semibold">
                                                            {{ $props['new_value'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($activity->subject instanceof \App\Models\Order)
                                                <div class="mt-2 flex items-center gap-2 text-xs text-zinc-600 dark:text-zinc-400">
                                                    <span class="inline-flex items-center rounded-md bg-white px-2 py-1 font-medium text-zinc-700 ring-1 ring-inset ring-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700">
                                                        Order #{{ $activity->subject->order_number }}
                                                    </span>
                                                    <span>•</span>
                                                    <span>Rs. {{ number_format($activity->subject->total_amount) }}</span>
                                                </div>
                                            @endif

                                            @if (isset($props['content']))
                                                <div class="mt-3 text-sm text-zinc-600 dark:text-zinc-300">
                                                    {{ $props['content'] }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-modals.delete-modal :itemId="$contact->id" :itemName="$contact->name" :title="'Delete Contact'" />
</div>
