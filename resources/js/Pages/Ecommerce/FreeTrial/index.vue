<template>
    <template v-if="summary && !summary.has_trial">
        <a href="javascript:void(0)" v-on:click="get_free_trial" 
        class="py-2.5 w-full block bg-rose-500 rounded-md text-center text-white text-[19px] font-semibold">GET YOUR
        TRIAL</a>
    </template>
    <template v-else>
        <div class="bg-rose-100 text-primary p-2 border border-rose-200 rounded text-center">You have already accessed free trial for this package</div>
    </template>
</template>
<script>
export default {
    props: {
        summary: {
            type: Object,
            required: true
        }
    },
    data() {
        return {

        }
    },
    methods: {
        get_free_trial() {
            this.$emit('get-free-trial', this.summary);
        }
    },
    mounted() {

    }
}
</script>
