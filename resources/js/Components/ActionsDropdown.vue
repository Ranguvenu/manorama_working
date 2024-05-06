<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '32',
    },
    contentClasses: {
        type: String,
        default: 'py-1 bg-white',
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
    return {
        32: 'w-32',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    } else if (props.align === 'right') {
        return 'origin-top-right right-0';
    } else {
        return 'origin-top';
    }
});

const open = ref(false);

import { EllipsisVerticalIcon } from "@heroicons/vue/24/solid";

</script>
<template>
    <div class="relative inline-block text-left">
        <div @click="open = !open" class="cursor-pointer inline-flex items-center justify-center text-primary hover:text-rose-600">
            <EllipsisVerticalIcon class="mx-auto h-6 w-6 text-gray-1000" aria-hidden="true"/>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 action_container"
                :class="[widthClass, alignmentClasses]"
                style="display: none"
                @click="open = false"
            >
                <div class="relative bg-white border-1">
                    <div v-if="props.align === 'left'" class="absolute top-0 left-3 -mt-1 w-2 h-2 bg-white transform rotate-45"></div>
                    <div v-else-if="props.align === 'right'" class="absolute top-0 right-3 -mt-1 dropdown-pointer w-2 h-2 bg-white transform rotate-45"></div>
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>
