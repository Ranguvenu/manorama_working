<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="caption" value="Caption" />
                    <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-12">
                    <InputLabel for="image" value="Image"/>
                    <MediaButton class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="configuration.image"/>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="label" value="Label" />
                    <TextInput id="label" type="text" class="mt-1 block w-full" v-model="configuration.more.label" placeholder="Label" autofocus autocomplete="label" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="link" value="Link" />
                    <TextInput id="link" type="text" class="mt-1 block w-full" v-model="configuration.more.link" placeholder="Link" autofocus autocomplete="link" v-on:keyup="update_configuration"/>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Feature</div>
            <div class="border border-gray-300 my-2" v-for="(feature, index) in configuration.features" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Feature {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="feature.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="caption" value="Caption" />
                        <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="feature.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_feature(index)" v-if="configuration.features.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_feature">Add Feature</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
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
            ButtonOutline
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Competitive Exam',
                    caption: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
                    image: '/images/pagebuilder/ctalayouttwo/comp-exam.png',
                    features: [],
                    more: {
                        label: 'View More Courses',
                        link: '#',
                    },

                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
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
                    title: 'Online Civil Service Foundation Course 2023-2024',
                    caption: 'Your dream of becoming IAS officer begins here.',
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
