<template>
    <div>
        <ButtonRegular color="secondary" size="sm" v-on:click="show_modal">Summary</ButtonRegular>
        <Modal :show="show" max-width="sm" @close="close_modal">
            <template #header>
                <div class="text-lg">Summary</div>
            </template>
            <div class="">
                <div class="bg-zinc-100 p-3">
                    <div class="text-gray-600 text-sm">Total Active coupons this month: <span class="text-primary">{{ summary.totalactive }}</span></div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600 text-sm">Total Active Coupons: <span class="text-primary">{{ summary.total }}</span></div>
                </div>
                <div class="bg-zinc-100 p-3">
                    <div class="text-zinc-400 text-sm">Last Active On</div>
                    <div class="text-gray-600 text-sm">{{ summary.lastactive }}</div>
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
            axios.post(route('reports.summary.coupons'), payload).then(response =>{
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