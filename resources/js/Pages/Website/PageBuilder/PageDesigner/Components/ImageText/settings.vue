<template>
    <div>
        <div>
            <div class="border border-gray-300 my-2">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 mx-3 gap-5 mt-3">
                    <div>
                        <InputLabel class="mb-2" for="media_alignment" value="Media Alignment" />
                        <select id="media_alignment" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.media_alignment" v-on:keyup="update_configuration">
                            <option value="left-layout">Left</option>
                            <option value="right-layout">Right</option>
                        </select>
                    </div>
                    <div>
                        <InputLabel class="mb-2" for="media_type" value="Media Type" />
                        <select id="media_type" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.media_type" v-on:keyup="update_configuration">
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                </div>
                <div class="m-3">
                    <InputLabel for="image" value="Image" />
                    <MediaButton id="image" class="mt-2" accepts="jpg,jpeg,png,svg" component="website" name="Select Image" :multiple="false" return_type="url" v-model="configuration.image"/>
                </div>
                <div class="grid grid-cols-2 mx-3 gap-5" v-if="configuration.media_type == 'video'" >
                    <div>
                        <InputLabel for="video" value="Video" />
                        <MediaButton id="video" class="mt-2" accepts="mp4" component="website" name="Select Video" :multiple="false" return_type="url" v-model="configuration.video"/>
                    </div>
                    <div>
                        <InputLabel class="mb-2" for="player_mode" value="Player Mode" />
                        <select id="player_mode" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.player_mode" v-on:keyup="update_configuration">
                            <option value="in-line">Inline</option>
                            <option value="light-box">Lightbox</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-12 m-3">
                    <label class="block font-medium text-sm text-gray-700 mb-3" for="description">Description</label>
                    <CkEditor v-model="configuration.description" @input="update_configuration"/>
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
    import ButtonOutline from '@/Components/ButtonOutline.vue';

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
            ButtonOutline
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    media_alignment: '',
                    media_type: '',
                    player_mode: '',
                    image: '',
                    description: '',
                    video: ''
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
