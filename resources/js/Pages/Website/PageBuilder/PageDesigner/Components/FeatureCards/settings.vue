<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Section Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 ">
                <div class="sm:col-span-5">
                    <InputLabel for="layout" value="Layout" />
                    <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.layout" v-on:keyup="update_configuration">
                        <option value="layout-one">Layout One</option>
                        <option value="layout-two">Layout Two</option>
                    </select>
                </div>
                <div class="sm:col-span-5">
                    <InputLabel for="layout" value="Columns" />
                    <TextInput id="number" type="number" class="mt-1 block w-full" v-model="configuration.columns" v-on:keyup="update_configuration" placeholder="No of Columns in a row" autofocus autocomplete="heading"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2" for="background">Background Color</label>
                    <color-picker id="bg_gradient_color" class="h-30 w-full" v-model:pureColor="configuration.background" lang="En" useType="pure"/>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Features</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Item {{ index+1 }}</div>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="icon" value="Heading" />
                        <TextInput id="heading-{{index}}" type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Feature Heading" autofocus autocomplete="heading" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12" v-if="can_show_icon">
                        <InputLabel for="icon" value="Icon" />
                        <MediaButton class="mt-2" component="website" name="Select Icon" :multiple="false" return_type="url" v-model="item.icon"/>
                    </div>
                    <div class="sm:col-span-12">
                        <label class="block font-medium text-sm text-gray-700" for="description">Description</label>
                        <CkEditor v-model="item.description" @input="update_configuration"/>
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

    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            CkEditor,
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    background: '#fff',
                    layout: '',
                    columns: 3,
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
                    icon: '',
                    title: '',
                    description: ''
                }
            },
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            }
        },
        computed:{
            can_show_icon(){
                let icon_layouts = ['layout-one'];
                return icon_layouts.includes(this.configuration.layout) ? true : false;
            }
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
