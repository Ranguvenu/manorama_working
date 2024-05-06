<template>
    <Modal :show="show" max-width="xl" @close="$emit('close')">
        <template #header>
            <div class="text-xl font-semibold">Notification Summary</div>
        </template>
        <div class="px-2">
            <div class="text-lg text-gray-900 mb-2">Message</div> 
            <div class="font-regular text-gray-600 text-sm mb-2" v-html="history.message"></div> 
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default"  v-on:click="$emit('close')">Close</ButtonRegular>                
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';

export default{
    components:{
        Modal,
        ButtonRegular
    },
    props:{
        history: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            show: false
        }
    },
    methods:{
        
    },
    watch: {
        "history.id"(){
            if(this.history && this.history.id){
                this.show = true;
            }else{
                this.show = false;
            }   
        }
    },
    mounted(){

    }
}
</script>