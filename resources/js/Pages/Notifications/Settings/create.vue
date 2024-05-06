<template>
    <div>
        <SideModal :show="show" max-width="3xl" @close="close_modal">
            <template #header>
                <div class="text-lg">{{ form.title }} - <span class="uppercase">{{ form.method  }}</span></div>
            </template>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-y-7 mb-4 mx-2 mt-2">
                <!-- <div class="col-span-12">
                    <InputLabel for="settings">Settings <span class="text-red-400">*</span></InputLabel>
                    <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm w-full" v-model="settings">
                      <option disabled value="">Please select one</option>
                      <option value="existing">Select from existing template</option>
                      <option value="new">Create new</option>
                    </select>
                    <InputError class="mt-2" v-if="errors && errors.settings" :message="errors.settings[0]" />
                </div> -->
                <div class="col-span-12" >
                    <InputLabel for="template_id">Existing Templates <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.template_id" returns="id" :options="templates" label="title" :multiple="false" v-if="isinitialized"/>
                    <InputError class="mt-2" v-if="errors && errors.template_id" :message="errors.template_id[0]" />
                </div>
                <div class="col-span-12" v-if="form.recipient_type != 'customer'">
                    <InputLabel for="recipient">Recipients <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="recipient" type="text" class="mt-1 block w-full" v-model="form.recipient" required autofocus
                        autocomplete="recipient" />
                    <InputError class="mt-2" v-if="errors && errors.recipient" :message="errors.recipient[0]" />
                    <small class="text-gray-600 mt-1" v-if="form.method == 'email'">Add multiple emails separated by commas(,)</small>
                    <small class="text-gray-600 mt-1" v-if="form.method == 'sms'">Add multiple mobile numbers separated by commas(,)</small>
                </div>
                <div class="col-span-12">
                    <InputLabel for="from_address">From Address <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="from_address" type="text" class="mt-1 block w-full" v-model="form.from_address" required autofocus
                        autocomplete="from_address" />
                    <InputError class="mt-2" v-if="errors && errors.from_address" :message="errors.from_address[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="from_name">From Name <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="from_name" type="text" class="mt-1 block w-full" v-model="form.from_name" required autofocus
                        autocomplete="from_name" />
                    <InputError class="mt-2" v-if="errors && errors.from_name" :message="errors.from_name[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Save</Button>
            </template>  
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from "@/Components/Button.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

export default{
    components:{
        SideModal,        
        InputError,
        InputLabel,
        TextInput,
        MultiSelect,
        Button,
    },
    props:{
        current: {
            type: Object,
            required: true
        }
    },
    emits: ["refresh", "close"],
    data(){
        return{
            show: false,
            form: this.initialize(),
            data: {
            },
            templates: [],
            errors: [],
            settings: 'existing',
            isinitialized: false
        }
    },
    methods:{
        initialize(){
            return{
                template_id: '',
                recipient: '',
                from_address: '',
                from_name: '',
            }
        },
        edit(setting){
            let vm = this;
            axios.get(route('notifications.settings.edit', {setting: setting.id})).then(response => {
                vm.form = response.data.data;
                vm.templates = response.data.templates;
                vm.show = true;
                vm.isinitialized = true;
            }).catch(error => {

            });
        },
        create(method){
            let vm = this;
            axios.get(route('notifications.settings.create', {method: method})).then(response => {
                vm.data = response.data;
                vm.isinitialized = true;
            }).catch(error => {

            });
        },
        update(id){
            let vm = this;
            axios.put(route('notifications.settings.update', {setting: id}), vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
            });
        },
        open_modal(){
            this.create(this.setting.method);
            this.show = true;
        },
        close_modal(){
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
        }
    },
    watch: {
        "current.id"(){
            if(this.current){
                this.edit(this.current);
            }
        }
    },
    mounted(){
    }
}
</script>
