<template>
    <div>
        <div class=" border border-gray-300 p-3">
            <div class="flex">
                <div class="col-span-full" style="width:50%;">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="ms-6" style="width:50%;">
                    <InputLabel for="title_alignment" value="Title Alignment" />
                    <select id="title_alignment" class="w-full mt-1 border-gray-300 rounded" v-model="configuration.title_alignment">
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                    </select>
                </div>
            </div>
            <div class="my-3 sm:col-span-4">
                <InputLabel class="mb-2" for="layout" value="Layout" />
                <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.layout" v-on:keyup="update_configuration">
                    <option value="grid-layout">Grid Layout</option>
                    <option value="carousel-layout">Carousel Layout</option>
                </select>
            </div>
            <div class="grid grid-cols-12 gap-x-3">
                <div class="col-span-4">
                    <InputLabel for="label" value="Label" />
                    <TextInput id="label" type="text" class="mt-1 block w-full" v-model="configuration.view_all.label" placeholder="Label" autofocus autocomplete="label" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-8">
                    <InputLabel for="url" value="Url" />
                    <TextInput id="url" type="text" class="mt-1 block w-full" v-model="configuration.view_all.url" placeholder="Url" autofocus autocomplete="url" v-on:keyup="update_configuration"/>
                </div>
            </div>
        </div>
        <div>
            <div  class="border border-gray-300 my-2">
                <div class="text-lg font-semibold pt-5 pb-2 text-gray-800 ms-3">Instructors</div>
                <div v-if="configuration && configuration.layout && (configuration.layout === 'carousel-layout')" class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 ms-5 pb-2">
                    <div class="col-span-2 flex">
                        <InputLabel for="navigation" value="Navigation"/>
                        <div id="navigation" class="ms-3">
                            <Checkbox name="navigation" v-model:checked="configuration.navigation" />
                        </div>
                    </div>
                    <div class="col-span-2 flex">
                        <InputLabel for="pagination" value="Pagination"/>
                        <div id="pagination" class="ms-3">
                            <Checkbox name="pagination" v-model:checked="configuration.pagination" />
                        </div>
                    </div>
                </div>
                <div v-for="(item, index) in configuration.items" :key="index">
                    <div class="text-gray-800 font-semibold bg-gray-200 p-2">Instructor {{ index+1 }}</div>

                    <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                        <div class="sm:col-span-12">
                            <InputLabel for="name" value="Name"/>
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="item.name" placeholder="name" autofocus autocomplete="name" v-on:keyup="update_configuration"/>
                        </div>
                        <div class="sm:col-span-12">
                            <label class="block font-medium mb-1 text-sm text-gray-700" for="description">Description</label>
                            <TextArea class="w-full" v-model="item.description" @input="update_configuration"></TextArea>
                        </div>
                        <div class="sm:col-span-12">
                            <InputLabel for="experience" value="Experience" />
                            <TextInput id="experience" type="text" class="mt-1 block w-full" v-model="item.experience" placeholder="Experience" autofocus autocomplete="Experience" v-on:keyup="update_configuration"/>
                        </div>
                        <div class="sm:col-span-12">
                            <InputLabel for="organization" value="Organization" />
                            <TextInput id="organization" type="text" class="mt-1 block w-full" v-model="item.organization" placeholder="Organization" autofocus autocomplete="Organization" v-on:keyup="update_configuration"/>
                        </div>
                        <div class="sm:col-span-12">
                            <InputLabel for="image" value="Image" />
                            <MediaButton id="image" class="mt-2" accepts="png,jpg" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.instructor_image"/>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-end gap-x-6">
                        <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)" v-if="configuration.items.length > 1">Remove</ButtonOutline>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Instructor</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import Checkbox from '@/Components/Checkbox.vue';

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
            TextArea,
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Instructors',
                    title_alignment: 'left',
                    layout: 'grid-layout',
                    view_all:{
                        label: 'View All',
                        url:   '#'
                    },
                    items: [],
                    navigation : 1,
                    pagination : 1,
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
                    instructor_image: '/images/pagebuilder/instructor/instructor.png',
                    description: 'Chemistry master teacher',
                    name : 'Rachita Sachdeva',
                    experience : '5+ Years Exp',
                    organization: 'IIS University',
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
