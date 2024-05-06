<template>
    <div class="grid justify-items-center">
        <div class="flex items-center text-center gap-x-2 justify-items-center">
            <svg class="w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" v-if="loading">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    fill="currentColor"></path>
            </svg>
            <slot></slot>
        </div>
</div>
</template>
<script>
    export default{
        props: {
            loading: {
                type: Boolean,
                default: false
            }
        }
    }
</script>