<template>
    <div>
        <div class="p-3 border mt-2">
            <div class="flex justify-between items-center mb-3">
                <div class="text-gray-800">Breadcrumps</div>
                <div>
                    <ButtonOutline size="sm" v-on:click="add_breadcrump">Add Breadcrump</ButtonOutline>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-for="(breadcrump, index) in configuration.breadcrumps">
                <div class="col-span-4">
                    <InputLabel for="icon" value="Title"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.title"
                        placeholder="Heading" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="icon" value="Link"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.link"
                        placeholder="Link" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="icon" value="Is Link Active"/>
                    <div class="my-3">
                        <Checkbox name="status" v-model:checked="breadcrump.active" />
                    </div>
                </div>
                <div class="col-span-1">
                    <ButtonOutline class="mt-5" size="sm" v-on:click="remove_breadcrump(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true"/>
                    </ButtonOutline>
                </div>
            </div>
        </div>
        <div class="p-3 border mt-3">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12">
                <div class="col-span-12">
                    <InputLabel for="title" value="Heading" />
                    <TextInput id="heading" type="text" class="mt-1 block w-full" v-model="configuration.main_heading"
                        placeholder="Heading" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="title" value="Caption" />
                    <TextArea id="title" type="text" class="mt-1 block w-full border-gray-300 rounded" v-model="configuration.main_caption"
                        placeholder="Caption" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="icon" value="Left Image" />
                    <MediaButton class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="configuration.image.url"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="icon" value="Image Alignment" />
                    <select class="w-full mt-2 border-gray-300 rounded" v-model="configuration.image.alignment">
                        <option value="top">Top</option>
                        <option value="center">Center</option>
                        <option value="bottom">Botton</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="p-3 border mt-2">
            <ActionButtons v-on:change="update_configuration" v-model="configuration.buttons"/>
        </div>
    </div>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Checkbox from '@/Components/Checkbox.vue';
import MediaButton from '@/Components/MediaButton.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import TextArea from '@/Components/TextArea.vue';
import { MinusIcon } from "@heroicons/vue/24/solid";
import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';

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
        Checkbox,
        ButtonOutline,
        MinusIcon,
        TextArea,
        ActionButtons
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                main_heading: '',
                main_caption: '',
                image: {
                    url: '',
                    alignment: ''
                },
                buttons: [],
                breadcrumps: [],
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        add_breadcrump(){
            let item = this.create_breadcrump();
            this.configuration.breadcrumps.push(item);
            this.update_configuration();
        },
        remove_breadcrump(index){
            this.configuration.breadcrumps.splice(index, 1);
            this.update_configuration();
        },
        create_breadcrump(){
            return {
                title: 'Breadcrump',
                link: '#',
                active: 1
            };
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
