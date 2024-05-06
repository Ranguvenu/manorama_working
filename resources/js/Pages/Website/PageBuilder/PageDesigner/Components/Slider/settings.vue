<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="col-span-full" style="width:100%;">
                <InputLabel for="title" value="Section Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
        </div>
        <div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Image {{ index+1 }}</div>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="image" value="Image" />
                        <MediaButton id="image" class="mt-2" accepts="png,jpg" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.image"/>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)" v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Image</ButtonOutline>
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
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            CkEditor
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    items: []
                }
            }
        },
        methods:{
            add_item(){
                let item = this.create_item();
                this.configuration.items.push(item);
                this.update_configuration();
            },
            remove_item(index){
                this.configuration.items.splice(index, 1);
                this.update_configuration();
            },  
            create_item(){
                return {
                    image: '/images/pagebuilder/slider/slider-image.png',
                }
            },
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
