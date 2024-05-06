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

        <div class="border border-gray-300 p-3 mt-5">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="primary_title" value="Primary Title" />
                    <TextInput id="primary_title" type="text" class="mt-1 block w-full" v-model="configuration.headings.primary.text" placeholder="Primary Title" autofocus autocomplete="primary_title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="secondary_title" value="Secondary Title" />
                    <TextInput id="secondary_title" type="text" class="mt-1 block w-full" v-model="configuration.headings.secondary.text" placeholder="Secondary Title" autofocus autocomplete="secondary_title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="font_color_primary" value="Font Color Primary"/>
                    <color-picker id="font_color_primary" class="h-30 w-full" v-model:pureColor="configuration.headings.primary.color" lang="En" useType="pure"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="font_color_secondary" value="Font Color Secondary"/>
                    <color-picker id="font_color_secondary" class="h-30 w-full" v-model:pureColor="configuration.headings.secondary.color" lang="En" useType="pure"/>
                </div>
                <div class="col-span-12">
                    <InputLabel for="caption" value="Caption" />
                    <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                </div>
            </div>
            <ActionButtons class="pt-3 mt-5" v-on:change="update_configuration" v-model="configuration.buttons"/>
            <!-- <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 mt-5" v-for="(button, index) in configuration.buttons" :key="index">
                <div class="col-span-3">
                    <InputLabel for="secondary_button" value="Secondary Button Type"/>
                    <select id="secondary_button" class="w-full mt-1 border-gray-300 rounded" v-model="button.type" v-on:change="update_configuration">
                        <option value="link">Link</option>
                        <option value="icon">Icon</option>
                        <option value="cta">Call to Action</option>
                    </select>
                </div>
                <div class="col-span-3">
                    <InputLabel for="primary_label" value="Label"/>
                    <TextInput id="primary_label" type="text" class="mt-1 block w-full" v-model="button.label"
                        placeholder="Label" autofocus autocomplete="label" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-3" v-if="button.type == 'link'">
                    <InputLabel for="primary_link" value="Link" />
                    <TextInput id="primary_link" type="text" class="mt-1 block w-full" v-model="button.link"
                        placeholder="Link" autofocus autocomplete="link" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-3" v-if="button.type == 'icon'">
                    <InputLabel for="image_url" value="Image"/>
                    <MediaButton id="image_url" class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="button.link"/>
                </div>
                <div class="col-span-3" v-if="button.type == 'cta'">
                    <InputLabel for="call_to_action" value="Call to Action"/>
                    <select id="call_to_action" class="w-full mt-1 border-gray-300 rounded"  v-model="button.link">
                        <option value="callback">Request Callback</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <InputLabel for="button_format" value="Button Format"/>
                    <select id="button_format" class="w-full mt-1 border-gray-300 rounded" v-model="button.design" v-on:change="update_configuration">
                        <option value="regular">Button Regular</option>
                        <option value="outline">Button Outline</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <ButtonOutline class="mt-7 w-fit" size="sm" v-on:click="remove_button(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                    </ButtonOutline>
                </div>
            </div> -->
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_button()">Add button</ButtonOutline>
            </div>
        </div>

        <div class="border border-gray-300 mt-5">
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800 ms-3">Slider Images</div>
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 ms-5">
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
        <div class="border border-gray-300 mt-5">
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800 ms-2">Number Counter</div>
            <div class=" my-2" v-for="(item, index) in configuration.stats.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Counter {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12">
                        <div class="sm:col-span-4">
                            <InputLabel for="product_id">Display Operator</InputLabel>
                            <select class="mt-1 block w-full border-0.5 border-gray-300 rounded-lg text-gray-600" v-model="item.display_operator" required>
                                <option value="0">Select</option>
                                <option value="before">Before Count</option>
                                <option value="after">After Count</option>
                            </select>
                        </div>
                        <div class="sm:col-span-4">
                            <InputLabel for="icon" value="Operator" />
                            <TextInput id="operator-{{index}}" type="text" class="mt-1 block w-full" v-model="item.operator"
                                placeholder="Operator" autofocus autocomplete="operator" v-on:keyup="update_configuration" />
                        </div>
                        <div class="col-span-4">
                            <InputLabel for="icon" value="Count" />
                            <TextInput id="count-{{index}}" type="text" class="mt-1 block w-full" v-model="item.count" placeholder="Number" autofocus autocomplete="count" v-on:keyup="update_configuration"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-3 pt-3">
                        <div class="col-span-6">
                            <InputLabel for="description" value="Description"/>
                            <TextInput id="title-{{index}}" type="text" class="mt-1 block w-full" v-model="item.description" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                        </div>
                        <div class="col-span-6">
                            <InputLabel for="icon" value="Icon" />
                            <MediaButton class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.icon"/>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)" v-if="configuration.stats.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item()">Add Counter</ButtonOutline>
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
    import { MinusIcon } from "@heroicons/vue/24/solid";
    import Checkbox from '@/Components/Checkbox.vue';
    import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';

    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
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
        data(){
            return{
                configuration:{
                    headings: {
                        primary: {
                            text: '',
                            color: '',
                        },
                        secondary: {
                            text: '',
                            color: ''
                        }
                    },
                    caption : '',
                    buttons : [],
                    slider: {
                        images : [],
                        navigation: true,
                        pagination: true
                    },
                    stats : {
                        items : []
                    }
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
                    image: '/images/pagebuilder/k12listingbanner/student.png'
                }
            },
            add_button() {
                let button = this.create_button();
                this.configuration.buttons.push(button);
                this.update_configuration();
            },
            remove_button(index) {
                this.configuration.buttons.splice(index, 1);
                this.update_configuration();
            },
            create_button() {
                return {
                    type: 'cta',
                    label: 'Enquire Now',
                    link : '#',
                    design: 'regular'
                }
            },
            add_item() {
                let item = this.create_item();
                this.configuration.stats.items.push(item);
                this.update_configuration();
            },
            remove_item(index) {
                this.configuration.stats.items.splice(index, 1);
                this.update_configuration();
            },
            create_item() {
                return {
                    icon: '/images/pagebuilder/k12listingbanner/courses.png',
                    count: '150',
                    display_operator: 'before',
                    operator: '+',
                    description: 'Batches Till Date'
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
