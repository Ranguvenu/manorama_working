<template>
    <a v-if="package && allowreview" href="javascript:void(0)" class="text-rose-500 text-lg font-semibold" v-on:click="show = true">{{ label }}</a>
    <Modal :show="show" max-width="xl" @close="close">
        <div class="mx-3 mb-6 review-container">
            <div class="flex justify-between items-center border-b border-zinc-100 py-5">
                <div class="text-center flex-1">
                    <div class="text-xl font-semibold">Write a review</div>
                </div>
                <div class="h-8 w-8 rounded-full cursor-pointer flex items-center justify-center bg-zinc-100 text-gray-400 ml-auto" v-on:click="close">
                    <svg class="h-4 w-4" stroke="currentColor" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div> 
            </div>
            <component :current="current" :is="state" :data="form" :errors="errors" @cancel="close" @submit="store" @update="update"></component>
        </div>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import PackageRatingForm from './form.vue';
export default{
    props:{
        label: {
            type: String,
            default: 'Write a review'
        },
        package: {
            type: Number,
            required: true
        },
        allowreview: {
            type: Boolean,
            required: true
        },
        edit_review: {
            type: Boolean,
            required: true
        },
        current: {
            type:Number,
            required: true
        }
    },
    components:{
        Modal,
        "prform": PackageRatingForm,
    },
    emits: ["refresh", "close"],
    data(){
        return{
            show: false,
            errors: [],
            form: this.initialize(),
            state: 'prform'
        }
    },
    methods:{
        initialize(){
            return {
                rating: 0,
                review: '',
            }
        },
        store(){
            let vm = this;
            if(!vm.package){
                return;
            }
            axios.post(route('package.rating.store', {package: vm.package}), vm.form).then(response => {
                if(response.data && response.data.success){
                    vm.close();
                    vm.$emit('refresh');
                    // vm.state = 'success';
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',
                    });
                }else{
                    vm.errors = response.data;
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        edit(rating) {
            let vm = this;
            if(!vm.package){
                return;
            }
            axios.get(route('package.rating.edit', { rating: rating })).then(response => {
                vm.form = response.data.data;
                vm.show = vm.edit_review;
            }).catch(error => {
                
            });
        },
        update(rating) {
            let vm = this;
            if(!vm.package){
                return;
            }
            axios.put(route('package.rating.update', { rating: rating }), vm.form).then(response => {
                if (response.data.success) {
                    vm.close();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        close(){
            this.errors = [];
            this.form = this.initialize();
            this.state = 'prform';
            this.show = false;
            this.$emit('close');
        }
    },
    mounted(){

    },
    watch:{
        edit_review() {
            if(this.edit_review){
                this.edit(this.current);
            }
        },
    }
}
</script>
<style>
    .review-container .vue3-star-ratings svg{
        margin-right: 12px !important;
    }
</style>
