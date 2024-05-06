<template>
    <div>
        <div class="p-3 border border-gray-300">
            <div class="col-span-full">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-full">
                <InputLabel class="mt-2" for="number_of_columns" value="Number Of Coulumns" />
                <TextInput id="perpage" type="number" class="mt-1 block w-full" v-model="configuration.number_of_columns"
                    placeholder="Number of columns" autofocus autocomplete="number_of_columns" v-on:keyup="update_configuration" />
            </div>
            <div class="grid grid-cols-3 mt-3">
                <div>
                    <InputLabel for="bg_gradient_color" value="Background Gradient Color" />
                    <color-picker id="bg_gradient_color" class="h-30 w-full" v-model:gradientColor="configuration.bg_gradient_color" lang="En" useType="gradient"/>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Cards</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Card {{ index + 1 }}</div>
                <div class="col-span-full m-3">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="m-3">
                    <InputLabel for="image" value="Image"/>
                    <MediaButton id="image" class="mt-2" accepts="png,jpg,jpeg,webp" component="website"
                        name="Select image" :multiple="false" return_type="url" v-model="item.image" />
                </div>
                <div>
                    <ActionButtons class="pt-3 mt-5" v-on:change="update_configuration" v-model="item.buttons"/>
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
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import MediaButton from '@/Components/MediaButton.vue';
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
            ButtonOutline,
            MediaButton,
            ActionButtons
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Are You Getting Ready for a competative Exam?',
                    number_of_columns: 2,
                    bg_gradient_color: 'linear-gradient(0deg, rgba(253, 206, 206, 0.45) 14%, rgba(234, 203, 236, 0.79) 69%)',
                    items: [],
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
                    title: 'Are You Getting Ready for a competative Exam?',
                    image: '/images/pagebuilder/cardswithcta/exam.png',
                    button: [],
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
