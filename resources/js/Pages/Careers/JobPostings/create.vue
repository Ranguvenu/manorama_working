<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-job-postings')" v-on:click="open_modal">Add Job Posting</Button>
        <SideModal :show="show" max-width="6xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Job Posting</div>
            </template>
            <div class="p-3">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="mt-3 sm:col-span-12">
                        <InputLabel for="title">Title <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                            autocomplete="title" />
                        <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                    </div>
                    <div class="mt-3 sm:col-span-4">
                        <InputLabel for="category">Category <span class="text-red-400">*</span></InputLabel>
                        <MultiSelect class="mt-2" v-model="form.category_id" returns="id" :options="data.categories"
                            label="name" :multiple="false" />
                        <InputError class="mt-2" v-if="errors && errors.category_id" :message="errors.category_id[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-4">
                        <InputLabel for="subject">Subject <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="form.subject" required autofocus
                            autocomplete="subject" />
                        <InputError class="mt-2" v-if="errors && errors.subject" :message="errors.subject[0]" />
                    </div>
                    <div class="mt-3 sm:col-span-4">
                        <InputLabel for="publish_from">Publish From <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="publish_from" type="date" class="mt-1 block w-full" v-model="form.publish_from" required
                            autofocus autocomplete="publish_from" />
                        <InputError class="mt-2" v-if="errors && errors.publish_from" :message="errors.publish_from[0]" />
                    </div>
                    <div class="mt-3 col-span-12">
                        <InputLabel for="tags">Tags</InputLabel>
                        <TextInput id="tags" type="text" class="mt-1 block w-full" v-model="form.tags" required
                            autofocus autocomplete="tags"/>
                        <small class="text-gray-600">Add multiple values separated by commas(,).</small>
                        <InputError class="mt-2" v-if="errors && errors.tags" :message="errors.tags[0]" />
                    </div>
                    <div class="mt-3 sm:col-span-12">
                        <InputLabel class="mb-2" for="description">Description </InputLabel>
                        <CkEditor id="description" type="text" class="w-full" v-model="form.description" required autofocus
                            autocomplete="form.description" />
                        <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />
                    </div>
                    <div>
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.open" />
                            <span class="ml-2 text-sm text-gray-600">Open</span>
                        </label>
                        <InputError class="mt-2" v-if="errors && errors.open" :message="errors.open[0]" />
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-lg text-gray-800 font-semibold mb-3">Assignments</div>
                    <div v-for="(assignment, index) in form.assignments">
                        <div class="border border-gray-200 mt-3">
                            <div class="bg-gray-200 p-2">Assignment {{index+1}}</div>
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 mt-3 p-2">
                                <div class="sm:col-span-12">
                                    <InputLabel class="mb-2" for="description">Assignment Title <span class="text-red-400">*</span></InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.title" required autofocus
                                    autocomplete="subject" />
                                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('assignments', 'title', index)] && errors" :message="errors[$get_error_key('assignments', 'title', index)][0]" />
                                </div>
                                <div class="sm:col-span-12">
                                    <InputLabel class="mb-2" for="description">Assignment Description <span class="text-red-400">*</span></InputLabel>
                                    <CkEditor id="description" type="text" class="w-full" v-model="assignment.description" required autofocus
                                        autocomplete="form.description" />
                                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('assignments', 'description', index)] && errors" :message="errors[$get_error_key('assignments', 'description', index)][0]" />
                                </div>
                                <div class="sm:col-span-4">
                                    <InputLabel class="mb-2" for="description">Upload Button Label</InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.meta.upload_button_label" required autofocus
                                    autocomplete="subject" />
                                </div>
                                <div class="sm:col-span-4">
                                    <InputLabel class="mb-2" for="description">Link Button Label</InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.meta.link_button_label" required autofocus
                                    autocomplete="subject" />
                                </div>
                                <div class="sm:col-span-4">
                                    <InputLabel class="mb-2" for="description">Accepted File Types</InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.meta.accepts" required autofocus
                                    autocomplete="subject" />
                                    <small class="text-gray-600">Add multiple extensions separated with commas(,) eg: .png, .jpg, .jpeg</small>
                                </div>
                                <div class="sm:col-span-6">
                                    <InputLabel class="mb-2" for="description">Upload Button Help Text</InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.meta.upload_button_help" required autofocus
                                    autocomplete="subject" />
                                </div>
                                <div class="sm:col-span-6">
                                    <InputLabel class="mb-2" for="description">Link Button Help Text</InputLabel>
                                    <TextInput id="subject" type="text" class="mt-1 block w-full" v-model="assignment.meta.link_button_help" required autofocus
                                    autocomplete="subject" />
                                </div>
                            </div>
                            <div class="flow-root my-3">
                                <div class="float-right">
                                    <ButtonOutline size="sm" color="primary" v-if="form.assignments.length > 1" v-on:click="remove_assignment(index)">Remove Assignment</ButtonOutline>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flow-root mt-3">
                        <div class="float-right">
                            <ButtonOutline size="sm" color="primary" v-on:click="add_assignment">Add Assignment</ButtonOutline>
                        </div>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary" v-if="current" v-on:click="update(current)">Update Job Posting</Button>
                <Button size="sm" color="primary" v-if="!current" v-on:click="store">Create Job Posting</Button>
            </template>
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from "@/Components/Button.vue";
import CkEditor from '@/Components/CkEditor.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
export default {
    components: {
        SideModal,
        CkEditor,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        Button,
        ButtonOutline,
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
                categories: []
            }
        }
    },
    methods: {
        initialize() {
            return {
                title: '',
                categories: [],
                tags: '',
                subject: '',
                description: '',
                publish_from: '',
                open: 0,
                assignments: []
            }
        },
        add_assignment(){
            let assignment = this.new_assignment();
            this.form.assignments.push(assignment);
        },
        remove_assignment(index) {
            this.form.assignments.splice(index, 1);
        },
        new_assignment(){
            return {
                title: '',
                description: '',
                meta: {
                    accepts: '.png,.jpeg',
                    upload_button_label: 'Upload Document',
                    upload_button_help: 'Document should be in .mp4',
                    link_button_label: 'Document Link',
                    link_button_help: 'Note: Paste a URL here.'
                }
            };
        },
        edit(job) {
            let vm = this;
            axios.get(route('careers.jobs.edit', {job: job})).then(response => {
                vm.form = response.data.data;
                vm.show = true;
            }).catch(error => {

            });
        },
        create() {
            let vm = this;
            axios.get(route('careers.jobs.create')).then(response => {
                vm.data = response.data;
            }).catch(error => {

            });
        },
        store() {
            let vm = this;
            axios.post(route('careers.jobs.store'), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        update(job) {
            let vm = this;
            axios.put(route('careers.jobs.update', {job: job}), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
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
        }
    },

    watch: {
        current() {
            if (this.current) {
                this.create();
                this.edit(this.current);
            }
        }
    },
    mounted() {
        this.add_assignment();
    }
}
</script>
