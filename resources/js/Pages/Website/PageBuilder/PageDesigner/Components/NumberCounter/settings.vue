<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Section Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                <div class="sm:col-span-3">
                    <InputLabel for="icon" value="Background Color" />
                    <color-picker class="h-10 w-20" v-model:pureColor="configuration.background_color" lang="En" useType="pure"/>
                </div>
                <div class="sm:col-span-3">
                    <InputLabel for="icon" value="Border Color" />
                    <color-picker class="h-30 w-full" v-model:pureColor="configuration.border_color" lang="En" useType="pure"/>
                </div>
                <div class="sm:col-span-3">
                    <InputLabel for="icon" value="Primary Color" />
                    <color-picker class="h-30 w-full" v-model:pureColor="configuration.primary_color" lang="En" useType="pure"/>
                </div>
                <div class="sm:col-span-3">
                    <InputLabel for="icon" value="Secondary Color" />
                    <color-picker class="h-30 w-full" v-model:pureColor="configuration.secondary_color" lang="En" useType="pure"/>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Items</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Item {{ index + 1 }}</div>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 px-3">
                    <div class="sm:col-span-4">
                        <InputLabel for="icon" value="Count" />
                        <TextInput id="count-{{index}}" type="text" class="mt-1 block w-full" v-model="item.count"
                            placeholder="Number" autofocus autocomplete="count" v-on:keyup="update_configuration" />
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="product_id">Display Operator</InputLabel>
                        <select class="mt-1 block w-full border-0.5 border-gray-300 rounded-lg text-gray-600" v-model="item.display_operator" required>
                            <option value="0">Select</option>
                            <option value="1">Before Count</option>
                            <option value="2">After Count</option>
                        </select>
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="icon" value="Operator" />
                        <TextInput id="operator-{{index}}" type="text" class="mt-1 block w-full" v-model="item.operator"
                            placeholder="Operator" autofocus autocomplete="operator" v-on:keyup="update_configuration" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="description" value="Description"/>
                        <TextInput id="title-{{index}}" type="text" class="mt-1 block w-full" v-model="item.description"
                            placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="icon" value="Icon" />
                        <MediaButton class="mt-2" component="website" name="Select Icon" :multiple="false" return_type="url"
                            v-model="item.icon" />
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                        v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item" v-if="configuration.item_count < 5">Add Item</ButtonOutline>
            </div>
            <div v-if="configuration.item_count == 5" class="bg-gray-500 p-4 text-white text-center">
                <p>Items Are Limited To Five!</p>
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

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        CkEditor,
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: 'Number Counter',
                background_color: '#fdedef',
                border_color: '#f9c3cd',
                primary_color: '#212121',
                secondary_color: '#eb1d4e',
                items: [],
                item_count: 1

            },
        }
    },
    methods: {
        add_item() {
            this.configuration.item_count += 1
            let item = this.create_item();
            this.configuration.items.push(item);
            this.update_configuration();
        },
        remove_item(index) {
            this.configuration.item_count -= 1
            this.configuration.items.splice(index, 1);
            this.update_configuration();
        },
        create_item() {
            return {
                count: '155',
                icon: '/images/pagebuilder/numbercounter/student-logo.png',
                operator: '+',
                display_operator: '2',
                description: 'Top Universities'
            }
        },
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
