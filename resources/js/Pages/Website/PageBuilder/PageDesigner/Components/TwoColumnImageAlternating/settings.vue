<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="mt-2 grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 ">
                <div class="col-span-12">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="caption" value="Caption" />
                    <TextArea id="caption" class="border-gray-300 mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                </div>

                <div class="col-span-full">
                    <InputLabel for="title_alignment" value="Title Alignment" />
                    <select id="title_alignment" class="w-full mt-2 border-gray-300 rounded" v-model="configuration.title_alignment">
                        <option value="start">Left</option>
                        <option value="center">Center</option>
                    </select>
                </div>
                <div class="col-span-full">
                    <InputLabel for="background_color" value="Background Color" />
                    <color-picker id="background_color" class="h-30 w-full" v-model:pureColor="configuration.background_color" lang="En" useType="pure"/>
                </div>
            </div>
        </div>
        <div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Item {{ index+1 }}</div>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <label class="block font-medium mb-1 text-sm text-gray-700" for="description">Description</label>
                        <CkEditor id="description" v-model="item.description" @input="update_configuration"/>
                    </div>
                    <div class="col-span-12">
                        <InputLabel for="image" value="Image" />
                        <MediaButton id="image" class="mt-2" accepts="png,jpg" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.image"/>
                    </div>
                    <div class="col-span-full">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 mt-5">
                            <div class="sm:col-span-4">
                                <InputLabel for="label" value="Label" />
                                <TextInput id="label" type="text" class="mt-1 block w-full" v-model="item.viewmore.label" placeholder="Label" autofocus autocomplete="label"/>
                            </div>
                            <div class="sm:col-span-8">
                                <InputLabel for="url" value="Url" />
                                <TextInput id="url" type="text" class="mt-1 block w-full" v-model="item.viewmore.url" placeholder="Url" autofocus autocomplete="url" />
                            </div>
                        </div>
                        </div>
                    </div>

                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)" v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Item</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import CkEditor from '@/Components/CkEditor.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import TextArea from '@/Components/TextArea.vue';

    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            CkEditor,
            TextArea
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    background_color: '#fff',
                    title_alognment: 'center',
                    items: []
                }
            }
        },
        methods:{
            add_item(){
                let item = this.create_item();
                this.configuration.items.push(item);
                this.update_configuration();
            },
            remove_item(index){
                this.configuration.items.splice(index, 1);
                this.update_configuration();
            },  
            create_item(){
                return {
                    image: '/images/pagebuilder/twoimagealternative/liveclass-img.png',
                    description: '<h2>Live class and Concept Videos</h2Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives',
                    viewmore: []
                }
            },
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            }
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
