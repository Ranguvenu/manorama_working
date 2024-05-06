<template>
    <div>
        <div class="grid gap-y-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-full">
                <InputLabel for="caption" value="Caption" />
                <TextArea id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption"
                    placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration" />
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Categories</div>
            <div class="border border-gray-300 my-2" v-for="(category, categoryindex) in configuration.categories" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Category {{ categoryindex + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="card_title" value="Title" />
                        <TextInput id="card_title" type="text" class="mt-1 block w-full" v-model="category.title"
                            placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                    </div>
                    <div class="grid grid-cols-1 bg-gray-100 gap-y-5 mt-3 sm:grid-cols-12">
                        <div class=" col-span-10 ms-3 mt-3 text-gray-800">Courses</div>
                        <div class="col-span-2 items-center ms-12">
                            <ButtonOutline color="primary" size="sm" v-on:click="add_item(categoryindex)">Add Course
                            </ButtonOutline>
                        </div>
                    </div>
                    <div v-for="(item, index) in category.items">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                            <div class="col-span-6">
                                <InputLabel for="label" value="Label" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.label"
                                    placeholder="Label" autofocus/>
                            </div>
                            <div class="col-span-5">
                                <InputLabel for="url" value="URL" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.url"
                                    placeholder="URL" autofocus/>
                            </div>
                            <div class="col-span-1">
                                <ButtonOutline class="mt-7 w-fit" size="sm" v-on:click="remove_item(categoryindex, index)">
                                    <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                                </ButtonOutline>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_category(categoryindex)"
                        v-if="configuration.categories.length > 1">Remove Category</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_category">Add Category</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MediaButton from '@/Components/MediaButton.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import { MinusIcon } from "@heroicons/vue/24/solid";
import TextArea from '@/Components/TextArea.vue';


export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline,
        MinusIcon,
        TextArea
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                caption: '',
                categories: [
                    {
                        title: '',
                        items: [
                            {
                                label: '',
                                url: ''
                            }
                        ] 
                    },
                ],
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        create_category(){
            return {
                title: '',
                more: {
                    link: '',
                    label: ''
                },
                items: [
                    {
                        label: '',
                        url: ''
                    }
                ]
            }
        },
        add_category(){
            let category = this.create_category();
            this.configuration.categories.push(category);
            this.update_configuration();
        },
        remove_category(index){  
            this.configuration.categories.splice(index, 1);
            this.update_configuration();
        },
        create_item(){
            return {
                label: '',
                url: ''
            }
        },
        add_item(category){ 
            let item = this.create_item();
            this.configuration.categories[category]['items'].push(item);
            this.update_configuration();
        },
        remove_item(category, index){
            this.configuration.categories[category]['items'].splice(index, 1);
            this.update_configuration();
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
