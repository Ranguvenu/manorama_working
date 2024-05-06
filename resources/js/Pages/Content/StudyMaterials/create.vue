<template>
    <div>
        <Button
            size="sm"
            v-if="$has_capability('create-studymaterial')"
            v-on:click="open_modal"
            >Add Study Material</Button
        >
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg">
                    <span v-if="current">Edit</span
                    ><span v-else>Add</span> Study Material
                </div>
            </template>
            <div class="px-3">
                <div>
                    <InputLabel for="title">Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                        autofocus
                        autocomplete="title"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.title"
                        :message="errors.title[0]"
                    />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="description"
                        >Description
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <CkEditor
                        id="description"
                        type="text"
                        class="w-full"
                        v-model="form.description"
                        required
                        autofocus
                        autocomplete="description"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.description"
                        :message="errors.description[0]"
                    />
                </div>

                <div class="mt-3">
                    <InputLabel class="mb-2" for="goals">Goals <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect
                        class="mt-2"
                        v-model="form.goal_id"
                        returns="id"
                        :options="data.goals"
                        label="title"
                        :multiple="false"
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.goal_id"
                        :message="errors.goal_id[0]"
                    />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="boards">Boards <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect
                        class="mt-2"
                        v-model="form.board_id"
                        returns="id"
                        :options="data.boards"
                        label="title"
                        :multiple="false"
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.board_id"
                        :message="errors.board_id[0]"
                    />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="classes">Classes <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect
                        class="mt-2"
                        v-model="form.class_id"
                        returns="id"
                        :options="data.classes"
                        label="title"
                        :multiple="false"
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.class_id"
                        :message="errors.class_id[0]"
                    />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="subject">Subject <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect
                        class="mt-2"
                        v-model="form.subject_id"
                        returns="id"
                        :options="data.subjects"
                        label="title"
                        :multiple="false"
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.class_id"
                        :message="errors.class_id[0]"
                    />
                </div>
                <!-- <div class="mt-3">
                    <label class="block font-medium text-sm text-gray-800" for="subject"><span>Chapters</span></label>
                    <MultiSelect class="mt-2" v-model="form.subject_id" returns="id" :options="data.subjects" label="name"
                        :multiple="false" />  
                    <InputError class="mt-1" v-if="errors && errors.class_id" :message="errors.class_id[0]" />
                </div> -->
                <div class="mt-3">
                    <InputLabel for="image">Image Thumbnail <span class="text-red-400">*</span></InputLabel>
                    <MediaButton
                        class="mt-1"
                        accepts="png,jpeg,jpg,svg,webp"
                        component="articles"
                        name="Upload Thumbnail"
                        :multiple="false"
                        return_type="id"
                        v-model="form.thumbnail_id"
                    />
                    <small class="text-gray-600"
                        >Note: Image Thumbnail should be in .png, .jpeg, .jpg,
                        .svg or .webp format.</small
                    >
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.thumbnail_id"
                        :message="errors.thumbnail_id[0]"
                    />
                </div>

                <div class="mt-3">
                    <InputLabel for="author_id"
                        >Author
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <MultiSelect
                        class="mt-2"
                        v-model="form.author_id"
                        returns="id"
                        :options="data.authors"
                        label="name"
                        :multiple="false"
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.author_id"
                        :message="errors.author_id[0]"
                    />
                </div>

                <div class="mt-3 sm:col-span-4">
                    <InputLabel for="published_on"
                        >Published On
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="published_on"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.published_on"
                        required
                        autofocus
                        autocomplete="date"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.published_on"
                        :message="errors.published_on[0]"
                    />
                </div>
                <div class="mt-3 sm:col-span-4">
                    <InputLabel for="status"
                        >Status <span class="text-red-400">*</span></InputLabel
                    >
                    <select
                        style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                        id="status"
                        class="mt-1 block w-full border-0.5"
                        v-model="form.status"
                    >
                        <option value="">Select</option>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.status"
                        :message="errors.status[0]"
                    />
                </div>
                <div class="mb-4 mt-4 border">
                    <div class="col-span-12">
                        <SEOConfiguration :seo="form.seo_configuration" />
                    </div>
                </div>
            </div>

            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal"
                    >Close</Button
                >
                <Button
                    size="sm"
                    color="primary"
                    v-if="current"
                    v-on:click="update(current)"
                    >Update Study Material</Button
                >
                <Button
                    size="sm"
                    color="primary"
                    v-if="!current"
                    v-on:click="store"
                    >Create Study Material</Button
                >
            </template>
        </SideModal>
    </div>
</template>
<script>
import SideModal from "@/Components/SideModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Button from "@/Components/Button.vue";
import CkEditor from "@/Components/CkEditor.vue";
import ButtonOutline from "@/Components/ButtonOutline.vue";
import MediaButton from "@/Components/MediaButton.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import MultipleCheckbox from "@/Components/MultipleCheckbox.vue";
import SEOConfiguration from "@/Pages/Website/SEO/index.vue";

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
        MediaButton,
        MultiSelect,
        MultipleCheckbox,
        SEOConfiguration,
    },
    props: {
        current: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            show: false,
            form: this.initialize(),
            errors: [],
            data: {
                goals: [],
                boards: [],
                classes: [],
                subjects: [],
                authors: [],
            },
        };
    },
    methods: {
        initialize() {
            return {
                title: '',
                description: '',
                goal_id: '',
                board_id: '',
                class_id: '',
                subject_id: '',
                thumbnail_id: '',
                author_id: '',
                published_on: '',
                status: '',
                seo_configuration: {
                    title: '',
                    description: '',
                    robots: [],
                    keywords: [],
                    card: '',
                    canonical_url: '',
                    schema:'',
                    twitter_handle:'',
                    follow_links: '',
                    meta_data: ''
                },
            };
        },
        edit(studymaterial) {
            let vm = this;
            axios
                .get(
                    route("content.studymaterial.edit", {
                        studymaterial: studymaterial,
                    })
                )
                .then((response) => {
                    console.log(response.data.data);

                    vm.form = response.data.data;
                    vm.show = true;
                })
                .catch((error) => {});
        },
        create() {
            let vm = this;
            axios
                .get(route("content.studymaterial.create", { edit: "no" }))
                .then((response) => {
                    console.log(response.data);
                    vm.data = response.data;
                    console.log("data", vm.data);
                })
                .catch((error) => {});
        },
        store() {
            let vm = this;
            axios
                .post(route("content.studymaterial.store"), vm.form)
                .then((response) => {
                    if (response.data.success) {
                        vm.close_modal();
                        vm.$emit("refresh");
                        this.$toast.success(response.data.message, {
                            position: "bottom-right",
                        });
                    }
                })
                .catch((error) => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Create Study Material', {
                        position: 'bottom-right'
                    });
                });
        },
        get_children(type, id) {
            let vm = this;
            axios
                .get(route("masterdata.hierarchy.children", { hierarchy: id }))
                .then((response) => {
                    vm.data[type] = response.data;
                })
                .catch((error) => {});
        },
        update(studymaterial) {
            let vm = this;
            axios
                .put(
                    route("content.studymaterial.update", {
                        studymaterial: studymaterial,
                    }),
                    vm.form
                )
                .then((response) => {
                    if (response.data.success) {
                        vm.close_modal();
                        vm.$emit("refresh");
                        this.$toast.success(response.data.message, {
                            position: "bottom-right",
                        });
                    }
                })
                .catch((error) => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Update Study Material', {
                        position: 'bottom-right'
                    });
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
            this.$emit("close");
        },
    },

    watch: {
        current() {
            if (this.current) {
                this.create();
                this.edit(this.current);
            }
        },
        "form.goal_id": function () {
            if (this.form.goal_id) {
                this.get_children("boards", this.form.goal_id);
            }
        },
        "form.board_id": function () {
            if (this.form.board_id) {
                this.get_children("classes", this.form.board_id);
            }
        },
        "form.class_id": function () {
            if (this.form.class_id) {
                this.get_children("subjects", this.form.class_id);
            }
        },
    },
    mounted() {},
};
</script>
