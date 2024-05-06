<template>
    <h2 class="w-full font-medium">
        <button @click="open = !open" :aria-expanded="open"
            class="flex items-center justify-between w-full py-3 text-zinc-800 text-base text-left">
            <span class="flex items-center mr-2">
                {{ title }}
            </span>
            <svg :class="{ 'rotate-180': open, 'rotate-90': !open }"
                data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M9 5 5 1 1 5" />
            </svg>
        </button>
    </h2>
    <div v-if="open">
        <div class="border-t border-neutral-200 py-4">
            <p class="text-zinc-800 px-2 ck-content" v-html="description"></p>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        title: {
            type: String,
            required: true
        },
        description: {
            type:String,
            required: true
        }
    },
    data(){
        return{
            open: false
        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>
