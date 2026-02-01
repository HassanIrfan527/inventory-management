<div class="w-full">
    {{-- Top Navigation --}}
    <div class="mb-6 flex items-center justify-between">
        @php
            $breadcrumbItem = [
                [
                    'name' => 'Contacts',
                    'href' => route('contacts.all'),
                    'icon' => 'users',
                ],
                [
                    'name' => 'Create Contact',
                    'href' => route('contact.create'),
                    'icon' => 'user-plus',
                ],
            ];
        @endphp
        <!-- Breadcrumbs -->
        <x-custom-breadcrumb :items="$breadcrumbItem"></x-custom-breadcrumb>

        <div class="flex gap-3">
            <flux:button variant="ghost" wire:click="cancel">
                Cancel
            </flux:button>
            <flux:button variant="primary" wire:click="save" icon="check"
                class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-0">
                Save Contact
            </flux:button>
        </div>
    </div>

    {{-- Page Header --}}
    <div
        class="mb-6 rounded-xl border border-zinc-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-6 dark:border-zinc-800 dark:from-emerald-950/20 dark:to-teal-950/20">
        <div class="flex items-center gap-4">
            <div
                class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-2xl font-bold text-white ring-4 ring-white dark:ring-zinc-900">
                <flux:icon name="user-plus" class="h-8 w-8" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Create New Contact</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Fill in the details below to add a new contact to
                    your system</p>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- ESSENTIAL INFORMATION --}}
        <x-contacts.collapsible-section wire-model="sectionEssential" :is-open="$sectionEssential" title="Essential Information"
            subtitle="Required contact details" icon="user-circle">
            <form class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2">
                    <flux:field>
                        <flux:label>
                            First Name <span class="text-red-500">*</span>
                        </flux:label>
                        <flux:input wire:model="form.first_name" placeholder="Enter first name" />
                        <flux:error name="form.first_name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Last Name</flux:label>
                        <flux:input wire:model="form.last_name" placeholder="Enter last name" />
                        <flux:error name="form.last_name" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Email Address</flux:label>
                    <flux:input type="email" wire:model="form.email" placeholder="email@example.com" />
                    <flux:error name="form.email" />
                </flux:field>

                <flux:field>
                    <flux:label>Phone Number</flux:label>
                    <flux:input wire:model="form.phone" placeholder="+1234567890" />
                    <flux:error name="form.phone" />
                </flux:field>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:field>
                        <flux:label>Contact Type</flux:label>
                        <flux:select wire:model="form.type" placeholder="Select type">
                            @foreach ($this->typeOptions as $value => $label)
                                <flux:select.option :value="$value">{{ $label }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="form.type" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Status</flux:label>
                        <flux:select wire:model="form.status" placeholder="Select status">
                            @foreach ($this->statusOptions as $value => $label)
                                <flux:select.option :value="$value">{{ $label }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="form.status" />
                    </flux:field>
                </div>
            </form>
        </x-contacts.collapsible-section>

        {{-- BUSINESS INFORMATION --}}
        <x-contacts.collapsible-section wire-model="sectionBusiness" :is-open="$sectionBusiness" title="Business Information"
            subtitle="Professional details" icon="building-office">
            <form class="space-y-4">
                <flux:field>
                    <flux:label>Company Name</flux:label>
                    <flux:input wire:model="company_name" placeholder="Acme Corporation" />
                    <flux:error name="company_name" />
                </flux:field>

                <flux:field>
                    <flux:label>Job Title</flux:label>
                    <flux:input wire:model="job_title" placeholder="Software Engineer" />
                    <flux:error name="job_title" />
                </flux:field>
            </form>
        </x-contacts.collapsible-section>

        {{-- CONTACT PREFERENCES --}}
        <x-contacts.collapsible-section wire-model="sectionContact" :is-open="$sectionContact" title="Contact Preferences"
            subtitle="Communication settings" icon="chat-bubble-left-right">
            <form class="space-y-4">
                <flux:field>
                    <flux:label>Preferred Contact Method</flux:label>
                    <flux:select wire:model="preferred_contact_method" placeholder="Select method">
                        @foreach ($this->preferredContactMethodOptions as $value => $label)
                            <flux:select.option :value="$value">{{ $label }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="preferred_contact_method" />
                </flux:field>
            </form>
        </x-contacts.collapsible-section>

        {{-- LOCATION DETAILS --}}
        <x-contacts.collapsible-section wire-model="sectionLocation" :is-open="$sectionLocation" title="Location Details"
            subtitle="Address information" icon="map-pin">
            <form class="space-y-4">
                <flux:field>
                    <flux:label>Street Address</flux:label>
                    <flux:input wire:model="address" placeholder="123 Main Street" />
                    <flux:error name="address" />
                </flux:field>

                <flux:field>
                    <flux:label>Landmark</flux:label>
                    <flux:input wire:model="landmark" placeholder="Near Central Park" />
                    <flux:error name="landmark" />
                </flux:field>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:field>
                        <flux:label>City</flux:label>
                        <flux:input wire:model="city" placeholder="New York" />
                        <flux:error name="city" />
                    </flux:field>

                    <flux:field>
                        <flux:label>State / Province</flux:label>
                        <flux:input wire:model="state" placeholder="NY" />
                        <flux:error name="state" />
                    </flux:field>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:field>
                        <flux:label>Country</flux:label>
                        <flux:input wire:model="country" placeholder="United States" />
                        <flux:error name="country" />
                    </flux:field>

                    <flux:field>
                        <flux:label>ZIP / Postal Code</flux:label>
                        <flux:input wire:model="zip_code" placeholder="10001" />
                        <flux:error name="zip_code" />
                    </flux:field>
                </div>
            </form>
        </x-contacts.collapsible-section>

        {{-- CRM & MARKETING --}}
        <x-contacts.collapsible-section wire-model="sectionCrm" :is-open="$sectionCrm" title="CRM & Marketing"
            subtitle="Customer insights" icon="chart-bar">
            <form class="space-y-4">
                <flux:field>
                    <flux:label>Source</flux:label>
                    <flux:select wire:model="source" placeholder="Select source">
                        @foreach ($this->sourceOptions as $value => $label)
                            <flux:select.option :value="$value">{{ $label }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="source" />
                </flux:field>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:field>
                        <flux:label>Date of Birth</flux:label>
                        <flux:input type="date" wire:model="date_of_birth" />
                        <flux:error name="date_of_birth" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Engagement Score (0-100)</flux:label>
                        <flux:input type="number" wire:model="engagement_score" placeholder="0" min="0"
                            max="100" />
                        <flux:error name="engagement_score" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Notes</flux:label>
                    <flux:textarea wire:model="notes" placeholder="Additional notes..." rows="4" />
                    <flux:error name="notes" />
                </flux:field>
            </form>
        </x-contacts.collapsible-section>

        {{-- Action Buttons (Sticky Footer) --}}
        <div
            class="sticky bottom-0 z-10 rounded-xl border border-zinc-200 bg-white p-4 shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex justify-end gap-3">
                <flux:button variant="ghost" wire:click="cancel">
                    Cancel
                </flux:button>
                <flux:button variant="primary" wire:click="save" icon="check"
                    class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-0">
                    Save Contact
                </flux:button>
            </div>
        </div>
    </div>
</div>
