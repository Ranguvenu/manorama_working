<template>
    <Modal max-width="7xl" :show="show" @close="$emit('hide')">
        <template #header>
            <div>{{ title }} - Summary</div>
        </template>
        <div class="px-3 max-h-96 overflow-y-auto">
            <div class="py-5">
                <div class="flex">
                    <div class="bg-blue-100 text-blue-800 px-3 py-2 rounded me-2">Total Uploads : {{ data.counts.total }}</div>
                    <div class="bg-green-100 text-green-800 px-3 py-2 rounded me-2">Successful Uploads : {{ data.counts.completed }}</div>
                    <div class="bg-red-100 text-red-800 px-3 py-2 rounded me-2">Failed Uploads : {{ data.counts.errors }}</div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="text-sm">
                        <th v-for="(header,index) in headers">{{ header }}</th>
                        <th>Errors</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for ="summary in data.data" :key="summary.id" class="text-sm">
                        <td v-for="(header, index) in headers" :class="{'bg-red-100 border-b border-t-red-200 border-b-red-200': summary.has_errors}">
                            <div>{{ summary.values[index] }}</div>
                        </td>            
                        <td :class="{'bg-red-100 border-b border-b-red-200 border-t-red-200': summary.has_errors}">
                            <div v-if="summary.has_errors">
                                <div v-for="(error, index) in summary.errors" class="text-xs text-red-600">{{ error[0] }}</div>
                            </div>        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('hide')">Close</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';
export default{
    props:{
        title:{
            type: String,
            required: true
        },
        show: {
            type: Boolean,
            default: false
        },
        data: {
            type: Array,
            required: false,
            default: []
        },
        headers:{
            type: Object,
            required: false,
            default: {}
        }
    },
    emits: ['hide'],
    components:{
        Modal,
        ButtonRegular
    },
    data(){
        return{

        }
    },
    method:{

    },
    mounted(){

    }
}
</script>