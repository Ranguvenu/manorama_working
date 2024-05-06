<template>
    <div>
        <ButtonRegular color="secondary" size="sm" v-on:click="show_modal">Summary</ButtonRegular>
        <Modal :show="show" max-width="sm" @close="close_modal">
            <template #header>
                <div class="text-lg">Summary</div>
            </template>
            <div class="">
                <div class="bg-zinc-100 p-3">
                    <div class="text-gray-600 text-sm">Total Registrations: <span class="text-primary">{{ summary.total }}</span></div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600 text-sm">Total Active Users: <span class="text-primary">{{ summary.total }}</span></div>
                </div>
                <div class="bg-zinc-100 p-3">
                    <div class="text-zinc-400 text-sm">Last Registration On</div>
                    <div class="text-gray-600 text-sm">{{ summary.last_registration }}</div>
                </div>
            </div>  
        </Modal>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';
export default {
    components:{
        ButtonRegular,
        Modal
    },
    props:{
        type: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            show: false,
            summary: {}
        }
    },
    methods:{
        index(){
            let vm = this;
            let payload = {};
            axios.post(route('reports.summary.users', {category: vm.type.slug}), payload).then(response =>{
                vm.summary = response.data;
            }).catch(error => {

            });
        },
        show_modal(){
            this.index();
            this.show = true;
        },
        close_modal(){
            this.show = false;
        }
    },
    mounted(){

    }
}
</script>
