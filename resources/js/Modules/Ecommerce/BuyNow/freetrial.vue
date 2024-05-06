<template>
    <a href="javascript:void(0)" v-on:click="freetrial">
        <slot />
    </a>
</template>
<script>
export default {
    props: {
        variation: {
            type: Number,
            required: true
        },
        batches: {
            type: Array,
            required: true
        },
        hasvariation: {
            type: Boolean,
            default: false
        },
        duration: {
            type: Number,
            required: true
        }
    },
    data() {
        return {

        }
    },
    methods: {
        freetrial(){
            let batch = [];
            let batches = this.get_batches();
            if(!this.hasvariation){
                if(batches && batches.length){
                    batch.push(batches[0]);
                }
            }else{
                batch = batches;
            }
            let variation = {
                price: this.variation,
                batch: batch,
                trial: this.duration,
            };
            this.$store.dispatch('add_variation', variation);
            this.$inertia.visit(route('checkout.index'));
        },
        get_batches(){
            return this.batches.map((response) => {
                return response.id;
            });
        }
    },
    mounted() {

    }
}
</script>
