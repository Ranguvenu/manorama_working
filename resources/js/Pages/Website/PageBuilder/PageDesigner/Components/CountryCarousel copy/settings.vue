<template>
    <div>
        <div class="border border-gray-300 p-3 grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
            <div class="pt-3 col-span-12">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-2 flex">
                <InputLabel value="Navigation" class="me-3"/>
                <Checkbox name="navigation" class="mt-1" v-model:checked="configuration.navigation" />
            </div>
            <div class="col-span-2 flex">
                <InputLabel value="Pagination" class="me-3"/>
                <Checkbox class="mt-1" name="pagination" v-model:checked="configuration.pagination" />
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Items</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Item {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="title" value="Title" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="icon" value="Icon" />
                        <MediaButton class="mt-2" component="website" name="Select Icon" :multiple="false" return_type="url" v-model="item.icon"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="image" value="Image" />
                        <MediaButton id="image" class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="item.image"/>
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
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import Checkbox from '@/Components/Checkbox.vue';

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
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'More than 90,000 programs offered in 9+ countries',
                    navigation: 0,
                    pagination: 1,
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
                    'icon': '/images/pagebuilder/countrycarousels/ireland-logo.png',
                    'image': '/images/pagebuilder/countrycarousels/ireland.png',
                    'title': 'USA'
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
