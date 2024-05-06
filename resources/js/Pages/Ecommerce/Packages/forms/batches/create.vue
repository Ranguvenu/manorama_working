<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-batch')" color="secondary" v-on:click="open_modal">Add Batch</Button>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Batch</div>
            </template>
            <div class="mx-2">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="sm:col-span-6">
                        <InputLabel for="name">Name <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="text" class="mt-1 w-full" v-model="form.name" :disabled="current" autofocus />
                        <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="code">Code <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="code" type="text" class="mt-1 w-full" v-model="form.code" autofocus
                            autocomplete="code" :disabled="current" />
                        <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="enrollment_start_date">Enrollment Start Date <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="date" class="mt-1 w-full" v-model="form.enrollment_start_date" autofocus />
                        <InputError class="mt-2" v-if="errors && errors.enrollment_start_date"
                            :message="errors.enrollment_start_date[0]" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="enrollment_end_date">Enrollment End Date <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="date" class="mt-1 w-full" v-model="form.enrollment_end_date" autofocus />
                        <InputError class="mt-2" v-if="errors && errors.enrollment_end_date"
                            :message="errors.enrollment_end_date[0]" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="batch_start_date">Batch Start Date <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="date" class="mt-1 w-full" v-model="form.batch_start_date" autofocus />
                        <InputError class="mt-2" v-if="errors && errors.batch_start_date"
                            :message="errors.batch_start_date[0]" />
                    </div>

                    <div class="sm:col-span-6">
                        <InputLabel for="batch_end_date">Batch End Date <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="date" class="mt-1 w-full" v-model="form.batch_end_date" autofocus />
                        <InputError class="mt-2" v-if="errors && errors.batch_end_date"
                            :message="errors.batch_end_date[0]" />
                    </div>
                    <div class="col-span-12">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12" v-if="isinitialized">
                            <div class="sm:col-span-6" v-if="packagedata.package_type == '0'">
                                <InputLabel for="course">Subject <span class="text-red-400">*</span></InputLabel>
                                <MultiSelect class="mt-2" v-model="form.hierarchy_id" returns="id" :options="options.courses"
                                    label="title" :multiple="false" :disabled="current"/>
                                <InputError class="mt-2" v-if="errors && errors.hierarchy_id" :message="errors.hierarchy_id[0]" />
                            </div>
                            <div class="sm:col-span-6">
                                <InputLabel for="provider">Provider <span class="text-red-400">*</span></InputLabel>
                                <MultiSelect class="mt-2" v-model="form.batch_provider_id" returns="id" :options="options.providers"
                                    label="name" :multiple="false" />
                                <InputError class="mt-2" v-if="errors && errors.batch_provider_id"
                                    :message="errors.batch_provider_id[0]" />
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="duration">Duration (hours/per day)<span class="text-red-400">*</span></InputLabel>
                        <TextInput id="duration" type="text" class="mt-1 w-full" v-model="form.duration" autofocus 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        />
                        <InputError class="mt-2" v-if="errors && errors.duration" :message="errors.duration[0]" />
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="student_limit">Student Limit <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="student_limit" type="text" class="mt-1 w-full" v-model="form.student_limit" autofocus autocomplete="student_limit" 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        />
                        <InputError class="mt-2" v-if="errors && errors.student_limit" :message="errors.student_limit[0]" />
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="isactive">Is Active <span class="text-red-400">*</span></InputLabel>
                        <Checkbox name="is_active" v-model:checked="form.is_active" />
                        <InputError class="mt-2" v-if="errors && errors.is_active" :message="errors.is_active[0]" />
                    </div>
                </div>
            </div>
            <template #footer>  
                <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary" v-if="current" v-on:click="update" :class="{'cursor-not-allowed pointer-events-none': isloading}"><LoaderButton :loading="isloading">Update Batch</LoaderButton></Button>
                <Button size="sm" color="primary" v-if="!current" v-on:click="store" :class="{'cursor-not-allowed pointer-events-none': isloading}"><LoaderButton :loading="isloading">Create Batch</LoaderButton></Button>
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
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import TextArea from '@/Components/TextArea.vue';
import Checkbox from '@/Components/Checkbox.vue';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';

export default {
    components: {
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        Button,
        ButtonOutline,
        MultiSelect,
        TextArea,
        Checkbox,
        LoaderButton
    },
    props: {
        packagedata: {
            type: Object,
            required: true,
        },
        data: {
            type: Object,
            required: false
        },
        current: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            show: false,
            form: this.initialize(),
            options: {
                courses: [],
                providers: [],
            },
            errors: [],
            isinitialized: false,
            isloading: false,
        }
    },
    methods: {
        initialize() {
            return {
                name: '',
                code: '',
                batch_start_date: '',
                batch_end_date: '',
                enrollment_start_date: '',
                enrollment_end_date: '',
                duration: '',
                student_limit: '',
                hierarchy_id: 0,
                is_active: false,
                batch_provider_id: '',
            }
        },
        edit(batch) {
            let vm = this;
            axios.get(route('ecommerce.batch.edit', { batch: batch })).then(response => {
                vm.form = response.data;
                vm.show = true;
            }).catch(error => {

            });
        },
        store() {
            let vm = this;
            vm.isloading = true;
            axios.post(route('ecommerce.batch.store', { package: vm.packagedata.id }), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal()
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }else{
                    this.$toast.error(response.data.message, {
                        position: 'bottom-right'
                    });
                }
                vm.isloading = false;
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create batch', {
                    position: 'bottom-right'
                });
                vm.isloading = false;
            });
        },
        update() {
            let vm = this;
            vm.form.package_id = this.packageid;
            vm.isloading = true;
            axios.put(route('ecommerce.batch.update', { batch: vm.current }), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    vm.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                    vm.isloading = false;
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Batch', {
                    position: 'bottom-right'
                });
                vm.isloading = false;
            });
        },
        open_modal() {
            this.create();
            this.show = true;
        },
        close_modal() {
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
        },
        create() {
            let vm = this;
            axios.get(route('ecommerce.batch.create', { package: vm.packagedata.id })).then(response => {
                vm.options = response.data;
                vm.isinitialized = true;
            }).catch(error => {

            });
        },
    },
    watch: {
        current() {
            if (this.current) {
                this.create();
                this.edit(this.current);
            }
        },
    },
    mounted() {

    }
}
</script>
