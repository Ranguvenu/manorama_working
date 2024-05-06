<template>
    <div v-if="packages && packages.can_enroll" class="w-full">
        <a href="javascript:void(0)" v-if="!hasvariation" class="w-full block bg-rose-500 rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center px-5" v-on:click="enroll(get_batches())">Enrol Now</a>
        <a href="javascript:void(0)" v-if="hasvariation" class="w-full block bg-rose-500 rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center px-5" v-on:click="select_batch">Enrol Now</a>
        <BatchSelection :show="show" :batches="batches" @enroll="enroll" @close="close"/>
    </div>
    <div v-if="packages && !packages.can_enroll" class="w-full">
        <a class="px-5 w-full block bg-primary rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center">
            <RequestCallbackButton :product="packages.package_id"/>
        </a>
    </div>
</template>
<script>
import BatchSelection from './Batches/index.vue';
import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';
export default{
    props:{
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
        packages:{
            type: Object,
            required: true
        }
    },
    components:{
        BatchSelection,
        RequestCallbackButton
    },
    data(){
        return{
            show: false
        }
    },
    methods:{
        enroll(batch = {}){
            let variation = {
                price: this.variation,
                batch: batch,
                trial: 0
            };
            this.$store.dispatch('add_variation', variation);
            this.$inertia.visit(route('checkout.index'));
        },
        select_batch() {
            this.show = true;
        },
        close(){
            this.show = false;
        },
        get_batches(){
            return this.batches.map((response) => {
                return response.id;
            });
        }
    },
    mounted(){

    }
}
</script>
