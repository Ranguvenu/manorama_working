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
            </div>
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-4">
                    <InputLabel for="image_1" value="Image One"/>
                    <MediaButton id="image_1" class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="configuration.images.image_1"/>
                </div>
                <div class="col-span-4">
                    <InputLabel for="image_2" value="Image Two"/>
                    <MediaButton id="image_2" class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="configuration.images.image_2"/>
                </div>
                <div class="col-span-4">
                    <InputLabel for="image_3" value="Image Three"/>
                    <MediaButton id="image_3" class="mt-2" component="website" name="Upload Image" :multiple="false" return_type="url" v-model="configuration.images.image_3"/>
                </div>
            </div>
        </div>

        <div class="border border-gray-300 p-3 mt-3">
            <ActionButtons v-on:change="update_configuration" v-model="configuration.buttons"/>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import ActionButtons from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue';

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
            ActionButtons

        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    buttons: [],
                    images: {
                        image_1: 'View More Courses',
                        image_2: '',
                        image_3: '',
                    },

                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
