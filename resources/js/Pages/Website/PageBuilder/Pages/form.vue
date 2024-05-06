<template>
    <div>
        <div class="grid grid-cols-12 gap-3 mb-4">
            <div class="col-span-8">
                <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-3 mb-4 border p-3">
                    <div class="col-span-12">
                        <InputLabel for="title" value="Page Title" />
                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            placeholder="Page Title"
                            required
                            autofocus
                            autocomplete="title"
                        />
                        <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]"/>
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="title" value="Page Type"/>
                        <select class="w-full mt-1 border border-gray-300" v-model="form.page_type">
                            <option value="page">Page</option>
                            <option value="package">Package</option>
                        </select>
                    </div>
                    <div class="col-span-6" v-if="form.page_type == 'package'">
                        <InputLabel for="title" value="Package"/>
                        <PackagesAutocomplete v-model="form.package_id" returns="id" :data="options.packages" label="title" :multiple="false"/>
                        <InputError class="mt-2" v-if="errors && errors.package_id" :message="errors.package_id[0]"/>
                    </div>
                    <div class="col-span-12">
                        <InputLabel for="description" value="Description" />
                        <CkEditor v-model="form.description"/>
                        <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 border">
                    <div class="col-span-12">
                        <SEOConfiguration :seo="form.seo_configuration"/>
                    </div>
                </div>
            </div>
            <div class="col-span-4">
                <div class="border border-zinc-200 p-3">
                    <div class="border-b border-zinc-200 pb-2">
                        <div class="text-regular text-gray-600">Actions</div>
                    </div>
                    <div class="my-2">
                        <div class="flow-root py-2">
                            <a class="border px-4 rounded py-1 text-sm border-primary text-primary me-2" :href="route('website.pages.components.show', [resource.data.id])" v-if="resource && resource.data" target="__blank">Preview</a>
                            <a class="border px-4 rounded py-1 text-sm border-secondary text-secondary" :href="route('website.pages.components.index', [resource.data.id])" v-if="resource && resource.data" target="__blank">Design</a>
                        </div>
                        <div class="my-4">
                            <div class="text-sm text-gray-600 my-2 flex items-center" v-if="resource && resource.data">Status: 
                                <select class="w-full py-[2px] px-[4px] m-0 mt-1 border border-gray-300 ms-2" v-model="form.status">
                                    <option :value="index" v-for="(status, index) in options.statuses">{{ status }}</option>
                                </select>
                            </div>
                            <InputError class="mt-2" v-if="errors && errors.status" :message="errors.status[0]"/>
                            <div class="text-sm text-gray-600 my-2" v-if="resource && resource.data">Published On: {{ resource.data.date }}</div>
                        </div>
                    </div>
                    <div class="text-right border-t border-zinc-200">
                        <ButtonRegular size="sm" color="primary" v-if="!edit" v-on:click="store(0)">Save Draft</ButtonRegular>
                        <ButtonRegular size="sm" color="secondary" v-if="!edit" v-on:click="store(1)">Publish</ButtonRegular>
                        <ButtonRegular size="sm" color="secondary"  v-if="edit" v-on:click="update(1)">Update</ButtonRegular>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import CkEditor from '@/Components/CkEditor.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ButtonRegular from '@/Components/Button.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import SEOConfiguration from '@/Pages/Website/SEO/index.vue';
import PackagesAutocomplete from '@/Components/AutoComplete/Packages.vue';

export default{
    props: {
        page: {
            type: Object,
            required: true
        },
        edit: {
            type: Number,
            required: true
        },
        resource: {
            type: Object,
            required: false
        },
        options:{
            type: Object,
            required: true
        }
    },
    components:{
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        CkEditor,
        PrimaryButton,
        ButtonRegular,
        ButtonOutline,
        SEOConfiguration,
        PackagesAutocomplete
    },
    data(){
        return{
            errors: '',
            form: this.initialize()
        }
    },
    methods:{
        store(status){
            let vm = this;
            vm.form.status = status;
            vm.errors = [];
            axios.post(route('website.pages.store'), vm.form).then(response => {
                if(response.data.success){
                    this.$inertia.visit(route('website.pages.edit', {page: response.data.data}));
                }
                this.$toast.success(response.data.message, {
                    position: 'bottom-right'
                });
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Page', {                        
                        position: 'bottom-right'
                    });


            })
        },
        update(){
            let vm = this;
            axios.post(route('website.pages.update', {page: vm.edit}), vm.form).then(response => {
                this.$toast.success(response.data.message, {
                    position: 'bottom-right'
                });
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Update Page', {                        
                        position: 'bottom-right'
                    });

            });
        },
        initialize(){
            let form = {
                title: "",
                description: "",
                slug: "",
                status: 0,
                page_type: 'page',
                package_id: 0,
                seo_configuration: {
                    'title' : '',
                    'description': '',
                    'robots': [],
                    'keywords': [],
                    'card': '',
                    'canonical_url': '',
                    'schema':'',
                    'twitter_handle':'',
                    'follow_links': '',
                    'meta_data': ''
                }
            }

            if(this.edit){
                form = this.$merge_objects(form, this.page);
            }

            return form;
        }
    },
    mounted(){

    }

}
</script>
