<template>
    <div>
        <div class="p-3 border mt-2">
            <div class="flex justify-between items-center mb-3">
                <div class="text-gray-800">Breadcrumps</div>
                <div>
                    <ButtonOutline size="sm" v-on:click="add_breadcrump">Add Breadcrump</ButtonOutline>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-for="(breadcrump, index) in configuration.breadcrumps">
                <div class="col-span-4">
                    <InputLabel for="breadcrum_title" value="Title"/>
                    <TextInput id="breadcrum_title" type="text" class="mt-1 block w-full" v-model="breadcrump.title"
                        placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="breadcrum_link" value="Link"/>
                    <TextInput id="breadcrum_link" type="text" class="mt-1 block w-full" v-model="breadcrump.link"
                        placeholder="Link" autofocus autocomplete="link" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="active" value="Is Link Active"/>
                    <div id="active" class="my-3">
                        <Checkbox name="status" v-model:checked="breadcrump.active" />
                    </div>
                </div>
                <div class="col-span-1">
                    <ButtonOutline class="mt-5" size="sm" v-on:click="remove_breadcrump(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true"/>
                    </ButtonOutline>
                </div>
            </div>
        </div>
        <div class=" p-3">
            <div class="col-span-full">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Cards</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.items" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Card {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="card_title" value="Title" />
                        <TextInput id="card_title" type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="grid grid-cols-1 bg-gray-100 gap-y-5 mt-3 sm:grid-cols-12">
                        <div class=" col-span-10 ms-3 mt-3 text-gray-800">Links</div>
                        <div class="col-span-2 items-center ms-12">
                            <ButtonOutline color="primary" size="sm" v-on:click="add_link(index)">Add Link</ButtonOutline>
                        </div>                    
                    </div>
                    <div v-for="(link, item_index) in item.links">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                            <div class="col-span-6">
                                <InputLabel for="link_title" value="Title" />
                                <TextInput id="link_title" type="text" class="mt-1 block w-full" v-model="link.title" placeholder="Title" autofocus autocomplete="title"/>
                            </div>
                            <div class="col-span-5">
                                <InputLabel for="url" value="URL" />
                                <TextInput id="url" type="text" class="mt-1 block w-full" v-model="link.url" placeholder="URL" autofocus autocomplete="url"/>
                            </div>
                            <div class="col-span-1">
                                <ButtonOutline class="mt-7 w-fit" size="sm" v-on:click="remove_link(item_index, index)">
                                    <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true"/>
                                </ButtonOutline>
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
    import Checkbox from '@/Components/Checkbox.vue';
    import { MinusIcon } from "@heroicons/vue/24/solid";

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
            MinusIcon,
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    items: [],
                    breadcrumps: []
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
            add_link(index) {
                let link = this.create_link();
                
                this.configuration.items[index].links.push(link)
                this.update_configuration();
            },
            remove_item(index) {
                this.configuration.items.splice(index, 1);
                this.update_configuration();
            },
            add_breadcrump(){
                let item = this.create_breadcrump();
                this.configuration.breadcrumps.push(item);
                this.update_configuration();
            },
            remove_breadcrump(index){
                this.configuration.breadcrumps.splice(index, 1);
                this.update_configuration();
            },
            remove_link(item_index, index){
                this.configuration.items[index].links.splice(item_index, 1);
                this.update_configuration();
            },
            create_breadcrump(){
                return {
                    title: 'Breadcrump',
                    link: '#',
                    active: 1
                };
            },
            create_item() {
                return {
                    title: '',
                    links: []
                }
            },
            create_link() {
                return {
                    title: '',
                    url: ''
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
