<template>
    <div>
        <div class="p-3 border mt-2 mb-3">
            <div class="flex justify-between items-center mb-3">
                <div class="text-gray-800">Breadcrumps</div>
                <div>
                    <ButtonOutline size="sm" v-on:click="add_breadcrump">Add Breadcrump</ButtonOutline>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-for="(breadcrump, index) in configuration.breadcrumps">
                <div class="col-span-4">
                    <InputLabel for="breadcrum_title" value="Title"/>
                    <TextInput id="breadcrum_title" type="text" class="mt-1 block w-full" v-model="breadcrump.title"
                        placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="breadcrum_link" value="Link"/>
                    <TextInput id="breadcrum_link" type="text" class="mt-1 block w-full" v-model="breadcrump.link"
                        placeholder="Link" autofocus autocomplete="link" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="active" value="Is Link Active"/>
                    <div id="active" class="my-3">
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

        <div class="border border-gray-300 p-3 mb-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="primary_title" value="Primary Title" />
                    <TextInput id="primary_title" type="text" class="mt-1 block w-full" v-model="configuration.primary_title" placeholder="Primary Title" autofocus autocomplete="primary_title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="secondary_title" value="Secondary Title" />
                    <TextInput id="secondary_title" type="text" class="mt-1 block w-full" v-model="configuration.secondary_title" placeholder="Secondary Title" autofocus autocomplete="secondary_title" v-on:keyup="update_configuration"/>
                </div>
            
                <div class="col-span-6">
                    <InputLabel for="font_color_primary" value="Font Color Primary" />
                    <color-picker id="font_color_primary" class="h-30 w-full" v-model:pureColor="configuration.font_color_primary" lang="En" useType="pure"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="font_color_secondary" value="Font Color Secondary" />
                    <color-picker id="font_color_secondary" class="h-30 w-full" v-model:pureColor="configuration.font_color_secondary" lang="En" useType="pure"/>
                </div>
                <div class="col-span-12">
                    <InputLabel for="caption" value="Caption" />
                    <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                </div>
            
                <div class="col-span-12">
                    <InputLabel for="package" value="Package" />
                </div>
                <div class="col-span-12">
                    <PackageAutocomplete v-model="configuration.package" :multiple="true" :filters="{'published': 1}" :data="options.package" returns="id" label="title" />
                </div>
            </div>
            <ActionButtons class="pt-3 mt-5" v-on:change="update_configuration" v-model="configuration.buttons"/>
        </div>
        <div class="border border-gray-300 p-3 mb-3">
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Slider Images</div>
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-2 flex">
                    <InputLabel for="navigation" value="Navigation"/>
                    <div id="navigation" class="ms-3">
                        <Checkbox name="status" v-model:checked="configuration.slider.navigation" />
                    </div>
                </div>
                <div class="col-span-2 flex">
                    <InputLabel for="pagination" value="Pagination"/>
                    <div id="pagination" class="ms-3">
                        <Checkbox name="status" v-model:checked="configuration.slider.pagination" />
                    </div>
                </div>
            </div>
            <div class=" my-2" v-for="(image, index) in configuration.slider.images" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">image {{ index + 1 }}</div>
                    <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                        <div>
                            <InputLabel for="image" value="Image" />
                            <MediaButton id="image" class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="image.image"/>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-end gap-x-6">
                        <ButtonOutline color="primary" size="sm" v-on:click="remove_image(index)"
                            v-if="configuration.slider.images.length > 1">Remove</ButtonOutline>
                    </div>
                </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_image()">Add Image</ButtonOutline>
            </div>
        </div>
        <div class="border border-gray-300 p-3 mb-3">
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Logos</div>
            <div class=" my-2" v-for="(logo, index) in configuration.logos" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Logo {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div>
                        <InputLabel for="logo" value="Logo" />
                        <MediaButton id="logo" class="mt-2" accepts="png,jpeg,svg,webp,jpg" component="website" name="Select Logo" :multiple="false" return_type="url" v-model="logo.logo"/>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_logo(index)">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_logo()">Add Logo</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';
    import PackageAutocomplete from '@/Components/AutoComplete/Packages.vue';
    import { MinusIcon } from "@heroicons/vue/24/solid";
    import Checkbox from '@/Components/Checkbox.vue';
    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            ActionButtons,
            PackageAutocomplete,
            MinusIcon,
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    breadcrumps: [
                        {
                            title: 'Breadcrump',
                            link: '#',
                            active: 1
                        }
                    ],
                    primary_title: 'Manorama Horizon empowers you to',
                    secondary_title: 'Upgrade your skills',
                    font_color_primary: 'rgb(33, 33, 33)',
                    font_color_secondary: 'rgb(235, 29, 78)',
                    caption: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the',
                    package: 0,
                    buttons: [],
                    logos: [
                        {
                            logo: '/images/pagebuilder/mclandingbanner/bimtech.png'
                        }
                    ],
                    button: [],
                    slider: {
                        images : [],
                        navigation: 0,
                        pagination: 1
                    },
                },
                options: {
                    package: []
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_image() {
                let image = this.create_image();
                this.configuration.slider.images.push(image);
                this.update_configuration();
            },
            remove_image(index) {
                this.configuration.slider.images.splice(index, 1);
                this.update_configuration();
            },
            create_image() {
                return {
                    image: '/images/pagebuilder/mclandingbanner/ai-banner.png'
                }
            },
            add_logo() {
                let logo = this.create_logo();
                this.configuration.logos.push(logo);
                this.update_configuration();
            },
            remove_logo(index) {
                this.configuration.logos.splice(index, 1);
                this.update_configuration();
            },
            create_logo() {
                return {
                    logo: '/images/pagebuilder/mclandingbanner/bimtech.png'
                }
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
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
