<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="primary_title" value="Primary Title" />
                    <TextInput id="primary_title" type="text" class="mt-1 block w-full" v-model="configuration.primary_title" placeholder="Primary Title" autofocus autocomplete="primary_title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="secondary_title" value="Secondary Title" />
                    <TextInput id="secondary_title" type="text" class="mt-1 block w-full" v-model="configuration.secondary_title" placeholder="Secondary Title" autofocus autocomplete="secondary_title" v-on:keyup="update_configuration"/>
                </div>
            
                <div class="col-span-6">
                    <InputLabel for="font_color_primary" value="Font Color Primary" />
                    <color-picker id="font_color_primary" class="h-30 w-full" v-model:pureColor="configuration.font_color_primary" lang="En" useType="pure"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="font_color_secondary" value="Font Color Secondary" />
                    <color-picker id="font_color_secondary" class="h-30 w-full" v-model:pureColor="configuration.font_color_secondary" lang="En" useType="pure"/>
                </div>
                <div class="col-span-12">
                    <InputLabel for="caption" value="Caption" />
                    <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
                </div>
            </div>
            <ActionButtons class="pt-3 mt-5" v-on:change="update_configuration" v-model="configuration.buttons"/>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Cards</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Card {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="icon" value="Image" />
                        <MediaButton class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.image"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="cardtitle" value="Card Title" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="item.cardtitle" placeholder="Card Title" autofocus autocomplete="cardtitle" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="description" value="Description" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="item.description" placeholder="Card Description" autofocus autocomplete="description" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 mt-5">
                            <div class="col-span-4">
                                <InputLabel for="cardbutton" value="Button Name" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.button.label" placeholder="Card Button Name" v-on:keyup="update_configuration"/>
                            </div>
                            <div class="col-span-8">
                                <InputLabel for="cardbutton" value="Button Link" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="item.button.link" placeholder="Card Button Link" v-on:keyup="update_configuration"/>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                        v-if="configuration.items.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Item</ButtonOutline>
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
            ActionButtons
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    primary_title: '',
                    secondary_title: '',
                    font_color_secondary: '',
                    font_color_primary: '',
                    caption: '',
                    button: [],
                    items: []
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_item() {
                let item = this.create_item();
                this.configuration.items.push(item);
                this.update_configuration();
            },
            remove_item(index) {
                this.configuration.items.splice(index, 1);
                this.update_configuration();
            },
            create_item() {
                return {
                    cardtitle: 'Getting Ready for the Kerala Administrative Services Exam?',
                    description: 'Enroll now in the integrated course for the KAS Exam',
                    image: '/images/pagebuilder/homebanner/home-banner.png',
                    button: {
                        label :  "Enrol Now",
                        link : "#"

                    }
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
