<template>
    <div>
        <div class="grid gap-y-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-full">
                <InputLabel for="searchlabel" value="Title Alignment" />
                <select class="w-full mt-2 border-gray-300 rounded" v-model="configuration.title_alignment">
                    <option value="start">Left</option>
                    <option value="center">Center</option>
                    <option value="end">Right</option>
                </select>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Items</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div v-for="(item, index) in configuration.items">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                            <div class="col-span-6">
                                <InputLabel for="description" value="Description" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.description"
                                    placeholder="Label" autofocus/>
                            </div>
                            <div class="col-span-5">
                                <InputLabel for="url" value="URL" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.url"
                                    placeholder="URL" autofocus/>
                            </div>
                            <div class="col-span-1">
                                <ButtonOutline class="mt-7 w-fit" size="sm" v-on:click="remove_item(index)">
                                    <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                                </ButtonOutline>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Item</ButtonOutline>
                    </div>
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
                title_alignment: '',
                items: [
                    {
                        label: '',
                        url: ''
                    }
                ]
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        create_item(){
            return {
                description: 'Civil Services Foundation Course',
                url: ''
            }
        },
        add_item(){ 
            let item = this.create_item();
            this.configuration.items.push(item);
            this.update_configuration();
        },
        remove_item(index){
            this.configuration.items.splice(index, 1);
            this.update_configuration();
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
