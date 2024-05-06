<template>
    <button
        :class="sizeClass"
        class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm shadow-black/30 dark:shadow-black/50 transition duration-150 ease-in-out hover:bg-rose-600 hover:shadow-black/50 focus:bg-rose-600 focus:shadow-black/50 focus:outline-none focus:ring-0 active:bg-rose-700 active:shadow-black/50 dark:hover:shadow-black/50 dark:focus:shadow-black/50 dark:active:shadow-black/50 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: {
        type: String,
        default: 'md',
    },
});

const sizeClass = computed(() => {
    return {
        sm: 'h-8 px-4 m-2',
        md: 'h-10 px-5 m-2',
        lg: 'h-12 px-6 m-2 text-lg',
    }[props.size];
});
</script>
