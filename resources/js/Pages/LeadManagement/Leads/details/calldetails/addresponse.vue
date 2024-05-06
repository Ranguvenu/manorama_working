<template>
    <div>
        <ButtonRegular class="float-right" size="sm" color="secondary" v-on:click="show = true">Add Response</ButtonRegular>
        <Modal :show="show" max-width="2xl" @close="show = false">
            <template #header>
                <div class="text-lg">Add Response</div>
            </template>
            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-12 my-3">
                <div class="col-span-12">
                    <InputLabel for="response">Enter User Response <span class="text-red-600">*</span></InputLabel>
                    <TextArea
                        id="response"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.response"
                        required
                        autofocus
                        autocomplete="response"
                    />
                    <InputError class="mt-2" v-if="errors && errors.response" :message="errors.response[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="status">Disposition Status <span class="text-red-600">*</span></InputLabel>
                    <TextInput
                        id="status"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.status"
                        required
                        autofocus
                        autocomplete="status"
                    />
                    <InputError class="mt-2" v-if="errors && errors.status" :message="errors.status[0]" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="callback">Requested to Callback Again <span class="text-red-600">*</span></InputLabel>
                        <Checkbox name="callback" v-model:checked="form.callback" />
                    <InputError class="mt-2" v-if="errors && errors.callback" :message="errors.callback[0]" />
                </div>
                <div class="col-span-6" v-if="form.callback">
                    <InputLabel for="callback_on">Preferred Callback Date <span class="text-red-600">*</span></InputLabel>
                    <TextInput id="callback_on" type="datetime-local" class="mt-1 block w-full" v-model="form.callback_on"
                        required autofocus autocomplete="date" />
                    <InputError class="mt-2" v-if="errors && errors.callback_on" :message="errors.callback_on[0]" />
                </div>
            </div>
            <template #footer>
                <ButtonRegular size="sm" color="default" v-on:click="close_modal">Close</ButtonRegular>
                <ButtonRegular size="sm" color="primary" v-on:click="store">Add Response</ButtonRegular>
            </template>
        </Modal>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
export default{
    components:{
        InputError,
        InputLabel,
        TextInput,
        Checkbox,
        TextArea,
        Modal,
        ButtonRegular
    },
    props:{
        lead: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            show: false,
            form: this.initialize(),
            errors: []
        }
    },
    methods: {
        initialize(){
            return{
                response: '',
                status: '',
                callback: '',
                callback_on: '',
            }
        },
        store(){
            let vm = this;
            axios.post(route('leads.responses.store', {interests:vm.lead.id}), vm.form).then(response => {
                if(response.data.success){
                    vm.form = vm.initialize();
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message,{
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                 this.$toast.error('Failed to submit response',{
                        position: 'bottom-right'
                    });
            });
        },
        close_modal(){
            this.show = false;
        }
    },
    mounted(){

    }
}
</script>
