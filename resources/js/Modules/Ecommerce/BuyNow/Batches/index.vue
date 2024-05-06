<template>
    <Modal :show="show" max-width="2xl" @close="close">
        <div class="mx-4 mb-7">
            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <div class="text-black text-lg font-semibold">Select Batch</div>
                <div class="h-8 w-8 rounded-full cursor-pointer flex items-center justify-center bg-zinc-100 text-gray-400" v-on:click="close">
                    <svg class="h-4 w-4 " stroke="currentColor" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>
            <div class="my-5">
                <div class="bg-stone-50 rounded-md px-5 my-6 p-2 relative py-4" v-for="(batch, index) in batches">
                    <div class="bg-green-600 w-fit px-2 py-[1px] rounded-[5px] text-sm my-1 text-zinc-100 absolute top-[-14px] left-[18px]" v-if="!index">
                        current batch
                    </div>
                    <div class="flex flex-wrap items-center justify-between w-full">
                        <div class="flex flex-wrap items-center w-full md:w-3/4">
                            <div class="media_sm:w-full flex-auto media_sm:mb-3 w-1/3">
                                <div class="font-medium text-black text-base">{{ batch.name }}</div>
                            </div>
                            <div class="sm:flex-auto media_sm:mb-3 w-1/3">
                                <div class="text-sm text-gray-600">Start Date</div>
                                <div class="text-sm text-black">{{ formatDate(batch.batch_start_date) }}</div>
                            </div>
                            <div class="sm:flex-auto media_sm:mb-3 w-1/3">
                                <div class="text-sm text-gray-600">End Date</div>
                                <div class="text-sm text-black">{{ formatDate(batch.batch_end_date) }}</div>
                            </div>
                        </div>
                        <div class="media_sm:w-full flex-none md:w-1/4">
                            <a href="javascript:void(0)" class="w-fit px-[40px] block bg-rose-500 rounded-lg py-2 text-zinc-100 text-base text-center" v-on:click="$emit('enroll', [batch.id])">Enroll</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
export default{
    props:{
        batches:{
            type: Array,
            required: true
        },
        show: {
            type: Boolean,
            required: true
        }
    },
    components:{
        Modal
    },
    data()
    {
        return{
            
        }
    },
    methods:{
        formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
        },
        close(){
            this.$emit('close');
        }
    },
    mounted(){

    }
}
</script>
