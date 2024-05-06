<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-sms_template')" v-on:click="open_modal">Add Template</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Template</div>
            </template>
            <div class="mx-2">
                <div v-if="isinitialized">
                    <div class="mt-3">
                        <InputLabel for="notification_type_id">Notification Type <span class="text-red-400">*</span>
                        </InputLabel>
                        <MultiSelect class="mt-2" v-model="form.notification_type_id" returns="id"
                            :options="data.notificationtypes" label="title" :multiple="false" />
                        <InputError class="mt-2" v-if="errors && errors.notification_type_id"
                            :message="errors.notification_type_id[0]" />
                    </div>
                    <div class="mt-3" v-if="form.notification_type_id">
                        <InputLabel for="variables">Template variables</InputLabel>
                        <div class="mt-2">
                            <ul class="flex flex-wrap">
                                <li class="py-1 px-2 text-sm border border-gray-200 bg-gray-100 text-gray-800 me-1 cursor-pointer mb-1" v-for="(variable, index) in variables" v-on:click="add_variable(variable)">
                                    {{ variable }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <InputLabel for="title">Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                        autocomplete="title" />
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="content">Content <span class="text-red-400">*</span></InputLabel>
                    <CkEditor id="content" type="text" class="mt-1 block w-full" v-model="form.content" required autofocus
                        autocomplete="content" />
                    <InputError class="mt-2" v-if="errors && errors.content" :message="errors.content[0]" />
                </div>
                <div class="mt-3  sm:col-span-6">
                    <label class="flex items-center">
                        <Checkbox name="status" v-model:checked="form.status" />
                        <span class="ml-2 text-sm text-gray-600">Is active</span>
                    </label>
                    <InputError class="mt-2" v-if="errors && errors.status" :message="errors.status[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary" v-if="current" v-on:click="update(current)">Update Template</Button>
                <Button size="sm" color="primary" v-if="!current" v-on:click="store">Create Template</Button>
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
import CkEditor from '@/Components/CkEditor.vue';
import Checkbox from '@/Components/Checkbox.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
export default {
    components: {
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        Button,
        CkEditor,
        Checkbox,
        MultiSelect
    },
    props: {
        current: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            show: false,
            form: this.initialize(),
            errors: [],
            data: {
                notificationtypes: []
            },
            variables: {},
            isinitialized: false,
        }
    },
    methods: {
        initialize() {
            return {
                notification_type_id: '',
                title: '',
                content: '',
                status: 0,
            }
        },
        create() {
            let vm = this;
            axios.get('/notifications/template/sms/create').then(response => {
                vm.data = response.data;
                vm.isinitialized = true;
            }).catch(error => {

            });
        },
        edit(template) {
            let vm = this;
            axios.get('/notifications/template/sms/' + template + '/edit').then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        store() {
            let vm = this;
            axios.post('/notifications/template/sms/store', vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        update(template) {
            let vm = this;
            axios.put('/notifications/template/sms/' + template + '/update', vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        open_modal() {
            this.create();
            this.show = true;
        },
        add_variable(variable){
            this.form.content = this.form.content+" "+variable;
        },
        close_modal() {
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
        },
    },
    watch: {
        current() {
            if (this.current) {
                this.create();
                this.edit(this.current);
            }
        },
        "form.notification_type_id"() {
            if (this.form.notification_type_id) {
                let index = this.data.notificationtypes.findIndex(x => x.id == this.form.notification_type_id);
                if (index > -1) {
                    this.variables = this.data.notificationtypes[index].variables;
                }
            }
        }
    },
    mounted() {

    }
}
</script>
