<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Section Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="flex col-span-full mt-3">
                <InputLabel for="pagination" value="Pagination" />
                <div class="ms-2" id="pagination">
                    <Checkbox class="mb-1" name="pagination" v-model:checked="configuration.pagination" />
                </div>
            </div>
            <div class="flex col-span-full mt-3">
                <InputLabel for="navigation" value="Navigation" />
                <div class="ms-2" id="navigation">
                    <Checkbox class="mb-1" name="navigation" v-model:checked="configuration.navigation" />
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Client Logos</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Logo {{ index + 1 }}</div>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="logo" value="Logo" />
                        <MediaButton id="logo" class="mt-2" accepts="png,jpg,jpeg,webp" component="website"
                            name="Select Logo" :multiple="false" return_type="url" v-model="item.logo" />
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                        v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Logo</ButtonOutline>
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
        Checkbox
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                navigation: 1,
                pagination: 1,
                items: []
            },
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
                logo: '/images/pagebuilder/clientcarousels/carousel-image.png',
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
