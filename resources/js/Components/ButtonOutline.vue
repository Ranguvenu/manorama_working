<template>
    <button
        :class="[sizeClass, colorClass]"
        class="inline-flex items-center px-4 py-2 bg-transparent rounded-md tracking-widest  transition duration-150 ease-in-out focus:outline-none focus:ring-0 focus:ring-offset-2 transition ease-in-out duration-150"
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
    color:{
        type: String,
        default: 'primary'
    }
});

const sizeClass = computed(() => {
    return {
        sm: 'border-2 h-8 px-4 m-2 text-sm font-semibold',
        md: 'border-2 h-10 px-5 m-2 text-md font-semibold',
        lg: 'border-2 h-12 px-6 m-2 text-lg font-semibold',
        xs: 'border h-6 px-2 mx-2 text-xs font-regular'
    }[props.size];
});

const colorClass = computed(() => {
    return {
        primary: 'border-primary text-primary',
        secondary: 'border-secondary text-secondary',
        gray: 'border-zinc-300 text-gray-600',
    }[props.color];
});
</script>
