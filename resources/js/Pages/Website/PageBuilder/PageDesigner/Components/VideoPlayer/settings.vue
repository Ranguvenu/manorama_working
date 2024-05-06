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
                    <InputLabel for="video" value="Video" />
                    <MediaButton id="video" class="mt-2" accepts="mp4" component="website" name="Select Video" :multiple="false" return_type="url" v-model="configuration.video"/>
                </div>
                <div class="col-span-12">
                    <InputLabel for="poster_image" value="Poster Image" />
                    <MediaButton id="poster_image" accepts="jpg,jpeg,png,svg" class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="configuration.poster_image"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';

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
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    video: '',
                    poster_image: ''
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
