<template>
    <div>
        <div class="bg-gray-300 p-2 text-gray-800">SEO Configuration</div>
        <div class="grid grid-cols-1 grid-cols-12 gap-y-5 mb-4 p-3">
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="SEO Title" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.title"
                    placeholder="SEO Title"
                    required
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="SEO Description" />
                <TextArea
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.description"
                    placeholder="SEO Description"
                    required
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="cards" value="Open Graph and Twitter Cards Tags" />
                <MediaButton accepts="png,jpeg,jpg,svg,webp" component="seo" name="Upload Image"
                        :multiple="false" return_type="url" v-model="seo.card" />
                    <small class="text-gray-600">Note: Image should be in .png, .jpeg, .jpg, .svg or .webp format.</small> 
                <InputError class="mt-2" :message="errors" />
            </div>
            <!-- <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="Should search engines follow links on this page" />
                <select class=" block w-full mt-2 bg-white rounded-md border border-neutral-200">
                    <option class="text-zinc-800 text-base" value="yes">Yes</option>
                    <option class="text-zinc-800 text-base" value="no">No</option>
                </select>
                <InputError class="mt-2" :message="errors" />
            </div> -->
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="Keywords" />
                <vue3-tags-input :add-tag-on-keys="[13]" :tags="seo.keywords"
                   placeholder="Enter your keywords"
                   @on-tags-changed="tags_changed"/>
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="Meta robots advanced" />
                <MultiSelect class="mt-2" v-model="seo.robots" returns="value" :options="data.robots"
                            label="name" :multiple="true" />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="canonical_url" value="Canonical URL" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.canonical_url"
                    placeholder="Canonical URL"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="Schema" />
                <TextArea
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.schema"
                    placeholder="Schema"
                    required
                    autofocus
                    autocomplete="schema"
                />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="title" value="Meta Data" />
                <TextArea
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.meta_data"
                    placeholder="Meta Data"
                    required
                    autofocus
                    autocomplete="schema"
                />
                <InputError class="mt-2" :message="errors" />
            </div>
            <div class="col-span-12">
                <InputLabel class="mb-2" for="twitter_handle" value="Twitter Handle" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    v-model="seo.twitter_handle"
                    placeholder="Twitter Handle"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="errors" />
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
    import MediaButton from '@/Components/MediaButton.vue';
    import MultiSelect from '@/Components/MultiSelect.vue';
    import Vue3TagsInput from 'vue3-tags-input';

    export default{
        components:{
            InputError,
            InputLabel,
            TextInput,
            TextArea,
            CkEditor,
            PrimaryButton,
            ButtonRegular,
            ButtonOutline,
            MediaButton,
            MultiSelect,
            Vue3TagsInput
        },
        props:{
            seo: {
                type: Object,
                required: true
            },
            errors:{
                type: Object,
                required: false
            }
        },
        data(){
            return{
                data: {
                    robots: [
                        {
                            'name' : 'No Image Index',
                            'value': 'noimageindex, nofollow'
                        },
                        {
                            'name': 'No Archive',
                            'value': 'noarchive'
                        },
                        {
                            'name': 'No Snippet',
                            'value': 'nosnippet'
                        }
                    ]
                }
            }
        },
        methods:{
            tags_changed(tags){
                this.seo.keywords = tags;
            }
        },
        mounted(){

        }
    }
</script>
