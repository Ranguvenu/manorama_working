<template>
    <div>
        <div class="border border-gray-300 p-3 grid gap-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Section Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="grid grid-cols-2 gap-x-3">
                <div>
                    <InputLabel for="days" value="Days" />
                    <TextInput id="days" type="text" class="mt-1 block w-full" v-model="configuration.days"
                        placeholder="Days" autofocus autocomplete="days" v-on:keyup="update_configuration" />
                </div>
                <div>
                    <InputLabel for="hours" value="Hours" />
                    <TextInput id="hours" type="text" class="mt-1 block w-full" v-model="configuration.hours"
                        placeholder="Hours" autofocus autocomplete="hours" v-on:keyup="update_configuration" />
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Topics</div>
            <template v-for="(item, index) in configuration.items" :key="index">
                <div class="border mb-3">
                    <div class="text-gray-800 font-semibold bg-gray-100 p-2">Topic {{ index + 1 }}</div>
                    <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6 px-3">
                        <div class="sm:col-span-12 mt-2">
                            <InputLabel for="title" value="Topic" />
                            <TextInput type="text" class="mt-2 block w-full" v-model="item.title"
                                placeholder="Topic" autofocus
                                v-on:keyup="update_configuration" />
                        </div>
                        <div class="sm:col-span-12">
                            <label class="block font-medium mb-2 text-sm text-gray-700"
                                for="description">Description</label>
                            <CkEditor id="description" v-model="item.description" @input="update_configuration" />
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-end gap-x-6">
                        <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                            v-if="configuration.items.length > 1">Remove</ButtonOutline>
                    </div>
                </div>
            </template>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Topic</ButtonOutline>
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
                title: '',
                days: '',
                hours: '',
                items: [
                    {
                        title: '',
                        description: ''
                    }
                ],
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
                title: '',
                description: '',
            }
        },
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
