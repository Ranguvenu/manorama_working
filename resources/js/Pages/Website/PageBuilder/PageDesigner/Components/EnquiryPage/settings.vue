<template>
    <div class="grid gap-y-5 border p-3">
        <div class="col-span-full">
            <InputLabel for="title" value="Section Title" />
            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
        </div>
        <div class="col-span-full">
            <InputLabel for="caption" value="Caption" />
            <TextArea id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
        </div>
        <div class="col-span-full">
            <InputLabel for="button_title" value="Button Title" />
            <TextInput id="button_title" type="text" class="mt-1 block w-full" v-model="configuration.button_title" placeholder="Button Title" autofocus autocomplete="button_title" v-on:keyup="update_configuration"/>
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
                    title: '',
                    caption: '',
                    button_title: ''

                }
            }
        },
        methods:{

            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            }
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
