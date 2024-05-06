<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-12">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="sm:col-span-12 mt-3">
                    <InputLabel for="image" value="Image"/>
                    <MediaButton class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="configuration.image"/>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Accordions</div>
            <div class="border border-gray-300 my-2" v-for="(accordion, index) in configuration.accordions" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Card {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="heading" value="Heading"/>
                        <TextInput type="text" class="mt-1 block w-full" v-model="accordion.heading" placeholder="Card Title" autofocus autocomplete="heading" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="content" value="Content" />
                        <TextArea type="text" class="mt-1 block w-full" v-model="accordion.content" placeholder="Content" autofocus autocomplete="content" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="mt-3 flex accordions-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_accordion(index)"
                        v-if="configuration.accordions.length> 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex accordions-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_accordion">Add accordion</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
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
            TextArea
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Services we provide',
                    image: '/images/pagebuilder/twocolaccordionimage/country-usersgrp.png',
                    accordions: []
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_accordion() {
                let accordion = this.create_accordion();
                this.configuration.accordions.push(accordion);
                this.update_configuration();
            },
            remove_accordion(index) {
                this.configuration.accordions.splice(index, 1);
                this.update_configuration();
            },
            create_accordion() {
                return {
                    heading: 'Test Prep',
                    content: 'Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.'
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
