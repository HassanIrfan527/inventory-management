<x-layouts.app :title="__('Invoices')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header Stats -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-2">
                    <div class="h-4 w-24 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-8 w-32 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                </div>
            </div>
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-2">
                    <div class="h-4 w-24 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-8 w-32 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                </div>
            </div>
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="space-y-2">
                    <div class="h-4 w-24 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-8 w-32 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                </div>
            </div>
        </div>
        <!-- Contacts Table -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
            <div class="p-4 space-y-4">
                <!-- Table Header -->
                <div class="grid grid-cols-4 gap-4 pb-4 border-b border-neutral-200 dark:border-neutral-700">
                    <div class="h-4 w-32 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-4 w-24 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-4 w-28 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                    <div class="h-4 w-20 rounded bg-neutral-200 dark:bg-neutral-700"></div>
                </div>
                <!-- Table Rows -->
                <div class="space-y-3">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="h-4 w-40 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-32 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-36 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-16 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="h-4 w-40 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-32 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-36 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-16 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="h-4 w-40 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-32 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-36 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                        <div class="h-4 w-16 rounded bg-neutral-100 dark:bg-neutral-800"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
