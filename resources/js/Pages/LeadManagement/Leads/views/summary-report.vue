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
                    <div class="text-gray-600 text-sm">Active Leads: <span class="text-primary">{{ summary.active }}</span></div>
                </div>
                <div class="bg-zinc-100 p-3">
                    <div class="text-gray-600 text-sm">In Progress Leads: <span class="text-primary">{{ summary.inprogress }}</span></div>
                </div>
                <div class="p-3">
                    <div class="text-gray-600 text-sm">Disqualified Leads: <span class="text-primary">{{ summary.disqualified }}</span></div>
                </div>
                <div class="bg-zinc-100 p-3">
                    <div class="text-zinc-400 text-sm">
                        <span v-if="category.slug == 'callback'">Last Callback request On</span>
                        <span v-else>Last Received Lead On</span>
                    </div>
                    <div class="text-gray-600 text-sm">{{ summary.lastlead }}</div>
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
        category: {
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
            axios.post(route('reports.summary.leads', {category: vm.category.slug}), payload).then(response =>{
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
