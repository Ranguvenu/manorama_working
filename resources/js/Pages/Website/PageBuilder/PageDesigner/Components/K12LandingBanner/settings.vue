<template>
    <div>
        <div class="border mt-2">
            <div class="flex justify-between items-center border-b-2 mx-2">
                <div class="text-gray-800 font-semibold">Bread Crumps</div>
                <div>
                    <ButtonOutline size="sm" v-on:click="add_breadcrump">Add Breadcrump</ButtonOutline>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12 mx-2 mb-2"
                v-for="(breadcrump, index) in configuration.breadcrumps">
                <div class="col-span-4">
                    <InputLabel for="breadcrum_title" value="Title" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.title" placeholder="Title"
                        autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="breadcrum_link" value="Link" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.link" placeholder="Link" autofocus
                        autocomplete="link" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="active" value="Is Link Active" />
                    <div class="my-3">
                        <Checkbox name="status" v-model:checked="breadcrump.active" />
                    </div>
                </div>
                <div class="col-span-1">
                    <ButtonOutline class="mt-5" size="sm" v-on:click="remove_breadcrump(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                    </ButtonOutline>
                </div>
            </div>
        </div>
        <div class="grid gap-3 gap-y-3 border border-gray-300 mt-5 p-3">
            <div class="col-span-6">
                <InputLabel for="category" value="Category" />
                <TextInput id="category" type="text" class="mt-1 block w-full" v-model="configuration.category"
                    placeholder="Category" autofocus autocomplete="category" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-6">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                    placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-6">
                <InputLabel for="caption" value="Caption" />
                <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption"
                    placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-6">
                <InputLabel for="youtube" value="You Tube Link" />
                <TextInput id="youtube" type="text" class="mt-1 block w-full" v-model="configuration.youtube"
                    placeholder="You Tube" autofocus autocomplete="youtube" v-on:keyup="update_configuration" />
            </div>
            <div class="col-span-6">
                <InputLabel for="thumbnail" value="Thumbnail Image" />
                <MediaButton id="thumbnail" class="mt-2" component="website" name="Select Image" :multiple="false"
                    return_type="url" v-model="configuration.thumbnail" />
            </div>
        </div>
        <div class="border border-gray-300 p-3 mt-3">
            <ActionButtons v-on:change="update_configuration" v-model="configuration.buttons"/>
        </div>
        <div class="border border-gray-300 mt-5">
            <div class="text-lg font-semibold py-2 text-gray-800 ms-3">Features</div>
            <div class="m-2 border" v-for="(feature, index) in configuration.features" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Feature {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div>
                        <InputLabel for="icon" value="Icon" />
                        <MediaButton id="icon" class="mt-2" component="website" name="Select Icon" :multiple="false"
                            return_type="url" v-model="feature.icon" />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="feature.title"
                            placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_feature(index)"
                        v-if="configuration.features.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_feature()">Add feature</ButtonOutline>
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
import Checkbox from '@/Components/Checkbox.vue';
import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';
import { MinusIcon } from "@heroicons/vue/24/solid";

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
        MinusIcon,
        Checkbox,
        ActionButtons
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                breadcrumps: [],
                category: 'CBSE',
                buttons: [],
                title: 'Class 8',
                caption: 'Lorem Ipsum is simply dummy text of the printing and typesetting',
                youtube: 'https://youtube.com',
                thumbnail: '/images/pagebuilder/k12landingbanners/classimg.png',
                features: [],

            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        // add_button() {
        //     let button = this.create_button();
        //     console.log(button);
        //     this.configuration.buttons.push(button);
        //     this.update_configuration();
        // },
        // remove_button(index) {
        //     this.configuration.buttons.splice(index, 1);
        //     this.update_configuration();
        // },
        // create_button() {
        //     return {
        //         type: 'link',
        //         label: 'Enquire Now',
        //         link: '#',
        //         design: 'regular'
        //     }
        // },
        add_feature() {
            let feature = this.create_feature();
            this.configuration.features.push(feature);
            this.update_configuration();
        },
        remove_feature(index) {
            this.configuration.features.splice(index, 1);
            this.update_configuration();
        },
        create_feature() {
            return {
                icon: '/images/pagebuilder/k12landingbanner/webinarclass.png',
                title: 'Live master class'
            }
        },
        add_breadcrump() {
            let item = this.create_breadcrump();
            this.configuration.breadcrumps.push(item);
            this.update_configuration();
        },
        remove_breadcrump(index) {
            this.configuration.breadcrumps.splice(index, 1);
            this.update_configuration();
        },
        create_breadcrump() {
            return {
                title: 'Breadcrump',
                link: '#',
                active: 1
            };
        },

    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
