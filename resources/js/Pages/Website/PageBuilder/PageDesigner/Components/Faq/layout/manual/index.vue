<template>
    <div v-for="(item, index) in data.items" :key="index">
        <div class="text-zinc-800 text-xl font-medium leading-tight my-4">{{ item.category }}</div>
        <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
            <h2 class="w-full font-medium">
                <button @click="toggleAccordion(index)" :aria-expanded="isOpen[index]"
                    :aria-controls="'accordion-collapse-body-' + index"
                    class="flex items-center justify-between w-full py-3 text-zinc-800 text-base text-left">
                    <span class="flex items-center mr-2">
                        {{ item.question }}
                    </span>
                    <svg :class="{ 'rotate-180': isOpen[index], 'rotate-90': !isOpen[index] }"
                        data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div v-if="isOpen[index]" :id="'accordion-collapse-body-' + index">
                <div class="border-t border-neutral-200 py-4">
                    <p class="text-zinc-800 px-2 ck-content" v-html="item.answer"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        const isOpen = Array(this.data.items.length).fill(false);
        return {
            isOpen
        };
    },
    methods: {
        toggleAccordion(index) {
            this.isOpen[index] = !this.isOpen[index];
        }
    }
};
</script>

