<template>
    <div>
        <div class="border border-gray-300">
            <div class="m-3 col-span-full">
                <div class="col-span-6">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="no_of_columns" value="No. of Columns" />
                    <TextInput id="no_of_columns" type="number" class="mt-1 block w-full" v-model="configuration.no_of_columns"
                        placeholder="No. of Columns" autofocus autocomplete="no_of_columns" v-on:keyup="update_configuration" />
                </div>
                <div class="flex mt-2 grid grid-cols-4 gap-x-6 gap-y-8 sm:grid-cols-4 px-3">

                    <div>
                        <InputLabel class="mb-3" for="background_color" value="Background Color" />
                        <color-picker id="background_color" class="h-30 w-full" v-model:pureColor="configuration.background_color" lang="En" useType="pure"/>
                    </div>
                    <div >
                        <InputLabel class="mb-3" for="text_color" value="Text Color" />
                        <color-picker id="text_color" class="h-30 w-full mt-5" v-model:pureColor="configuration.text_color" lang="En" useType="pure"/>
                    </div>
                    <div >
                        <InputLabel class="mb-3" for="border_color" value="Border Color" />
                        <color-picker id="border_color" class="h-30 w-full" v-model:pureColor="configuration.border_color" lang="En" useType="pure"/>
                    </div>
                    <div>
                        <InputLabel  for="border_styles" value="Border Styles" />
                        <select class="w-full mt-2 border-gray-300 rounded" v-model="configuration.border_styles">
                            <option value="solid">Lined</option>
                            <option value="dashed">Dashed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Items</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Item {{ index + 1 }}</div>
                <div class=" grid grid-cols-1 gap-x-6 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="icon" value="Icon" />
                        <MediaButton id="icon" class="mt-2" accepts="png,jpg,jpeg,webp" component="website"
                            name="Select Icon" :multiple="false" return_type="url" v-model="item.icon" />
                    </div>
                    <div class="sm:col-span-12">
                        <label class="mb-2 block font-medium text-sm text-gray-700" for="description">Description</label>
                        <TextArea id="description" class="w-full" v-model="item.description" @input="update_configuration"></TextArea>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                        v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Item</ButtonOutline>
            </div>
        </div>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MediaButton from '@/Components/MediaButton.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import Checkbox from '@/Components/Checkbox.vue';
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
        Checkbox,
        TextArea
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                no_of_columns: '',
                background_color: 'fff',
                text_color: 'fff',
                border_color: '#fff',
                border_styles: 'solid',
            }
        }
    },
    methods: {
        add_item() {
            let item = this.create_item();
            this.configuration.items.push(item);
            this.update_configuration();
        },
        remove_item(index) {
            this.configuration.items.splice(index, 1);
            this.update_configuration();
        },
        create_item() {
            return {
                icon: '',
                description: ''
            }
        },
        update_configuration() {
            this.errors = {};
            this.$emit('update-configuration', this.configuration);
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
