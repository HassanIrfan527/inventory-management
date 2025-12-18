<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        timeout: null,
        trigger(msg, t = 'success') {
            this.message = msg;
            this.type = t;
            this.show = true;
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    }"
    @toast.window="trigger($event.detail.message, $event.detail.type)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100]"
    style="display: none;"
    x-cloak
>
    <!-- Use Flux-like styling -->
    <div
        class="flex items-center gap-2 px-4 py-2 rounded-full shadow-lg border backdrop-blur-sm"
        :class="{
            'bg-white/90 dark:bg-zinc-800/90 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white': true
        }"
    >
        <template x-if="type === 'success'">
            <div class="text-green-500 bg-green-500/10 p-1 rounded-full">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </template>
        <template x-if="type === 'error'">
             <div class="text-red-500 bg-red-500/10 p-1 rounded-full">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </template>
        
        <span class="text-sm font-medium" x-text="message"></span>
    </div>
</div>
