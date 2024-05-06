<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-article')" v-on:click="open_modal">{{ type.meta.new }}</Button>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> {{ type.meta.singular }}</div>
            </template>
            <div class="px-3">
                <div>
                    <InputLabel for="name">Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                        autocomplete="title" />
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="description">Description <span class="text-red-400">*</span></InputLabel>
                    <CkEditor id="description" type="text" class="w-full" v-model="form.description" required autofocus
                        autocomplete="description" />
                    <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="image">Image</InputLabel>
                    <MediaButton class="mt-1" accepts="png,jpeg,jpg,svg,webp" component="articles" name="Upload Image"
                        :multiple="false" return_type="id" v-model="form.image_id" />
                    <small class="text-gray-600">Note: Image should be in .png, .jpeg, .jpg, .svg or .webp format.</small>  
                    <InputError class="mt-1" v-if="errors && errors.image_id" :message="errors.image_id[0]" />
                </div>
                <div class="mt-3">
                    <label class="block font-medium text-sm text-gray-800" for="categories"><span>Category</span></label>
                    <MultipleCheckbox :options="data.categories" v-model="form.category" />
                    <InputError class="mt-1" v-if="errors && errors.category" :message="errors.category[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="image">Video</InputLabel>
                    <MediaButton class="mt-1" accepts="mp4" component="articles" name="Upload Video" :multiple="false"
                        return_type="id" v-model="form.video_id" />
                    <small class="text-gray-600">Note: Video should be in .mp4 format.</small>
                    <InputError class="mt-1" v-if="errors && errors.video_id" :message="errors.video_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="image">Image Thumbnail</InputLabel>
                    <MediaButton class="mt-1" accepts="png,jpeg,jpg,svg,webp" component="articles" name="Upload Thumbnail"
                        :multiple="false" return_type="id" v-model="form.thumbnail_id" />
                    <small class="text-gray-600">Note: Image Thumbnail should be in .png, .jpeg, .jpg, .svg or .webp format.</small>
                    <InputError class="mt-1" v-if="errors && errors.thumbnail_id" :message="errors.thumbnail_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="short_description">Short Description <span class="text-red-400">*</span>
                    </InputLabel>
                    <CkEditor id="short_description" type="text" class="w-full" v-model="form.short_description" required
                        autofocus autocomplete="short_description" />
                    <InputError class="mt-2" v-if="errors && errors.short_description"
                        :message="errors.short_description[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="author" value="Author" />
                    <MultiSelect class="mt-2" v-model="form.author_id" returns="id" :options="data.authors" label="name"
                        :multiple="false" />
                </div>
                <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="mt-3 sm:col-span-4">
                        <InputLabel for="order">Order <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="order" type="text" class="mt-1 block w-full" v-model="form.order" required
                            autofocus autocomplete="order" 
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                        <InputError class="mt-2" v-if="errors && errors.order" :message="errors.order[0]" />
                    </div>
                    <div class="mt-3 sm:col-span-4">
                        <InputLabel for="published_on">Published On <span class="text-red-400">*</span></InputLabel>
                        <TextInput id="published_on" type="date" class="mt-1 block w-full" v-model="form.published_on"
                            required autofocus autocomplete="date" />
                        <InputError class="mt-2" v-if="errors && errors.published_on" :message="errors.published_on[0]" />
                    </div>
                    <div class="mt-3 sm:col-span-4">
                        <label class="flex items-center mt-6 py-2">
                            <span class="ml-2 mr-2 text-sm text-gray-600">Is Published</span>
                            <Checkbox name="is_published" v-model:checked="form.is_published" />
                        </label>
                        <InputError class="mt-2" v-if="errors && errors.is_published" :message="errors.is_published[0]" />
                    </div>
                </div>
                <div class="mt-3">
                    <InputLabel for="labels">Labels <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="labels" type="text" class="mt-1 block w-full" v-model="form.labels" required autofocus
                        autocomplete="labels" />
                    <InputError class="mt-2" v-if="errors && errors.labels" :message="errors.labels[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="tags">Tags <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="tags" type="text" class="mt-1 block w-full" v-model="form.tags" required autofocus
                        autocomplete="tags" />
                    <InputError class="mt-2" v-if="errors && errors.tags" :message="errors.tags[0]" />
                </div>
                <div class="mb-4 mt-4 border">
                    <div class="col-span-12">
                        <SEOConfiguration :seo="form.seo_configuration"/>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
                <Button :class="{'cursor-not-allowed pointer-events-none': isloading}" size="sm" color="primary" v-if="current" v-on:click="update(current)"><LoaderButton :loading="isloading">Update {{ type.meta.singular }}</LoaderButton></Button>
                <Button :class="{'cursor-not-allowed pointer-events-none': isloading}" size="sm" color="primary" v-if="!current" v-on:click="store"><LoaderButton :loading="isloading">Create {{ type.meta.singular }}</LoaderButton></Button>
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
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MediaButton from "@/Components/MediaButton.vue";
import MultiSelect from '@/Components/MultiSelect.vue';
import MultipleCheckbox from '@/Components/MultipleCheckbox.vue';
import SEOConfiguration from '@/Pages/Website/SEO/index.vue';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';

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
        LoaderButton
    },
    props: {
        current: {
            type: Number,
            required: true
        },
        type: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            show: false,
            form: this.initialize(),
            errors: [],
            data: {
                categories: [],
                authors: []
            },
            checkedValues: [],
            isloading: false,
        }
    },
    methods: {
        initialize() {
            return {
                title: '',
                description: '',
                image_id: 0,
                category: [],
                video_id: 0,
                thumbnail_id: 0,
                short_description: '',
                author_id: 0,
                is_published: 0,
                order: 0,
                published_on: '',
                labels: '',
                tags: '',
                seo_configuration: {
                    'title' : '',
                    'description': '',
                    'robots': [],
                    'keywords': [],
                    'card': '',
                    'canonical_url': '',
                    'schema':'',
                    'twitter_handle': '',
                    'follow_links': '',
                    'meta_data': ''
                },
            }
        },
        edit(article) {
            let vm = this;
            axios.get(route('blog.article.edit', {article: article, category: vm.type.slug})).then(response => {
                vm.form = response.data.data;
                vm.show = true;
            }).catch(error => {

            });
        },
        create() {
            let vm = this;
            axios.get(route('blog.article.create', {category: vm.type.slug})).then(response => {
                vm.data = response.data;
            }).catch(error => {

            });
        },
        store() {
            let vm = this;
            vm.isloading = true;
            axios.post(route('blog.article.store', {page: page, category: vm.type.slug}), vm.form).then(response => {
                if (response.data.success) {
                    vm.isloading = false;
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                vm.isloading = false;
                if (this.$toast.error.length !== 0) {
                    this.$toast.clear();
                }
                this.$toast.error('Failed to Create '+vm.type.name, {                        
                    position: 'bottom-right'
                });
            });
        },
        update(article) {
            let vm = this;
            vm.isloading = true;
            axios.put(route('blog.article.update', { article: article, category: vm.type.slug }), vm.form).then(response => {
                if (response.data.success) {
                    vm.isloading = false;
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                vm.isloading = false;
                this.$toast.error('Failed to Create '+vm.type.name, {                        
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

    }
}
</script>
