<template>
    <div>
        <div class="text-lg font-semibold text-gray-800">{{ title }}</div>
        <div class="pt-3"
            v-for="(button, index) in buttons" :key="index">
            <div class="flex border px-3 py-2">
                <div class="pr-6 mb-2">
                    <InputLabel for="button_type" value="Button Type" />
                    <select id="button_type" class="w-full mt-1 border-gray-300 rounded" v-model="button.type"
                        v-on:change="update_configuration">
                        <option value="link">Link</option>
                        <option value="icon">Icon</option>
                        <option value="scrollto">Scroll To</option>
                        <option value="cta">Call to Action</option>
                    </select>
                </div>
                <div class="pr-6 mb-2" v-if="button.type !== 'icon'">
                    <InputLabel for="primary_label" value="Label" />
                    <TextInput id="primary_label" type="text" class="mt-1 block w-full" v-model="button.label"
                        placeholder="Label" autofocus autocomplete="label" v-on:keyup="update_configuration" />
                </div>
                <div class="pr-6 mb-2" v-if="button.type == 'link' || button.type == 'scrollto' || button.type == 'icon'">
                    <InputLabel for="primary_link" value="Link" />
                    <TextInput id="primary_link" type="text" class="mt-1 block w-full" v-model="button.link" placeholder="Link"
                        autofocus autocomplete="link" v-on:keyup="update_configuration" />
                </div>
                <div class="pr-6 mb-2" v-if="button.type == 'icon'">
                    <InputLabel for="button_icon" value="Icon" />
                    <MediaButton id="button_icon" class="mt-2" component="website" name="Upload Icon" :multiple="false"
                        return_type="url" v-model="button.icon"/>
                </div>
                <div class="pr-6 mb-2" v-if="button.type == 'cta'">
                    <InputLabel for="call_to_action" value="Call to Action" />
                    <select class="w-full mt-1 border-gray-300 rounded" v-model="button.link">
                        <option value="callback">Request Callback</option>
                    </select>
                </div>
                <div class="pr-6 mb-2" v-if="button.type == 'cta' && button.link == 'callback'">
                    <InputLabel value="Select Package" />
                    <select class="w-full mt-1 border-gray-300 rounded" v-model="button.package">
                        <option :value="index" v-for="(product, index) in packages">{{ product }}</option>
                    </select>
                </div>
                <div class="pr-6 mb-2" v-if="button.type != 'icon'">
                    <InputLabel for="button_format" value="Button Format" />
                    <select class="w-full mt-1 border-gray-300 rounded" v-model="button.design"
                        v-on:change="update_configuration">
                        <option value="regular">Button Regular</option>
                        <option value="outline">Button Outline</option>
                    </select>
                </div>
                <div class="mb-2">
                    <ButtonOutline class="mt-7 w-fit" size="sm" v-on:click="remove_button(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                    </ButtonOutline>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-x-6 mt-2">
            <ButtonOutline color="primary" size="sm" v-on:click="add_button()" :class="items-center">Add button</ButtonOutline>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import { MinusIcon } from "@heroicons/vue/24/solid";

    export default{
        components:{
            TextInput,
            InputLabel,
            ButtonOutline,
            MinusIcon,
            MediaButton
        },
        props: {
            modelValue: {
                type: Array,
                required: true
            },
            title: {
                type: String,
                default: 'CTA Buttons'
            }
        },
        data(){
            return {
                buttons: [],
                packages: []
            }
        },
        methods: {
            add_button() {
                let button = this.create_button();
                console.log(button);
                this.buttons.push(button);
                this.update_configuration();
            },
            remove_button(index) {
                this.buttons.splice(index, 1);
                this.update_configuration();
            },
            create_button() {
                return {
                    type: 'link',
                    label: 'Enquire Now',
                    link: '#',
                    design: 'regular',
                    icon: '/images/pagebuilder/testimonialslayouttwo/pace-logo.png'
                }
            },
            update_configuration(){
                this.$emit('update:modelValue', this.buttons);
            },
            get_packages(){
                let vm = this;
                let payload = {
                    published: 1
                };
                axios.post(route('ecommerce.packages.list'), payload).then(response => {
                    vm.packages = response.data;
                }).catch(error => {

                });
            }
        },
        watch: {
            "modelValue": function(){
                this.buttons = this.modelValue;
            }
        },
        mounted(){
            if(this.modelValue){
                this.buttons = this.modelValue;
            }
            this.get_packages();
        }
    }
</script>
