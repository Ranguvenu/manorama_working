<template>
    <div>
        <div class="border border-gray-300">
            <div class="grid grid-cols-12 gap-x-6 gap-y-8 sm:grid-cols-12 p-3">
                <div class="col-span-6">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="icon" value="Font Color" />
                    <color-picker class="h-30 w-full" v-model:pureColor="configuration.color" lang="En" useType="pure"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="icon" value="Background Type" />
                    <select class="w-full mt-2 border-gray-300 rounded" v-model="configuration.type">
                        <option value="image">Image</option>
                        <option value="color">Background</option>
                    </select>
                </div>
                <div class="col-span-6" v-if="configuration.type == 'image'">
                    <InputLabel for="title" value="Background Image" />
                    <MediaButton class="mt-1" component="website" name="Select Image" :multiple="false" return_type="url"
                        v-model="configuration.image" />
                </div>
                <div class="col-span-6" v-if="configuration.type == 'color'">
                    <InputLabel for="icon" value="Background Color" />
                    <color-picker class="h-30 w-full" v-model:pureColor="configuration.background" lang="En" useType="pure"/>
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
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                image: '',
                color: 'fff',
                type: 'image',
                background: '#fff',
            }
        }
    },
    methods: {
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
