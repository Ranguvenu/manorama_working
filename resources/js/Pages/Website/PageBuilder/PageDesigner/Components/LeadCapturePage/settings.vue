<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="mb-3">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
            <div class="mb-3">
                <InputLabel for="caption" value="Caption" />
                <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
            </div>
            <div class="mb-3">
                <InputLabel for="image" value="Image" />
                <MediaButton id="image" class="mt-2" accepts="png,jpg" component="website" name="Select Image" :multiple="false" return_type="url" v-model="configuration.image"/>
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
            MediaButton
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    image: ''
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
