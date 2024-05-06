<template>
    <div>
        <div class="border border-gray-300 my-2">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                <div class="sm:col-span-12">
                    <InputLabel for="image" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="sm:col-span-12">
                    <InputLabel for="image" value="Image" />
                    <MediaButton class="mt-2" component="website" name="Select Image" :multiple="false"
                        return_type="url" v-model="configuration.image" />
                </div>
                <div class="sm:col-span-12">
                    <label class="block mb-2 font-medium text-sm text-gray-700" for="description">Description</label>
                    <CkEditor v-model="configuration.description" @input="update_configuration" />
                </div>
                <div class="sm:col-span-12">
                    <ActionButtons class="pt-3" v-on:change="update_configuration" v-model="configuration.buttons"/>
                </div>
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
import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';

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
        ButtonOutline,
        ActionButtons

    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                image: '',
                description: '',
                buttons: [],
            }
        }
    },
    methods: {
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
