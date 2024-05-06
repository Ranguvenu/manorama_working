<template>
    <div>
        <div class="flow-root pb-3">
            <div class="float-left">
                <div class="font-semibold text text-gray-800 leading-tight mb-3">Menu Settings</div>
            </div>
            <div class="float-right">
                <a href="javascript:void(0)" v-on:click="add_menu()" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer">Add Menu</a>
            </div>
        </div>
        <div>
        <draggable class="dragArea list-group w-full" :list="configuration.menu" >
           <div class="border p-3 my-2 " v-for="(menu, menuindex) in configuration.menu" :key="menuindex">   
   
            <div class="bg-gray-200 p-2 flow-root">
                <div class="float-left">
                    Menu Item {{ menuindex+1 }}
                </div>
                <div class="float-right">
                    <a href="javascript:void(0)" v-if="configuration && configuration.menu && configuration.menu.length > 1" v-on:click="remove_menu(menuindex)" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer me-2">Remove Menu</a>
                    <a href="javascript:void(0)" v-on:click="add_category(menuindex)" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer">Add Category</a>
                </div>
            </div>
            <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-y-7 gap-x-2 m-2">
                <div class="col-span-6" >
                    <InputLabel>Main Menu Item Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="menu.title" required autofocus
                        autocomplete="recipient" />                        
                         <InputError
                            class="mt-2"
                            v-if="errors && errors['configuration.menu.' + menuindex + '.title']"
                            :message="errors['configuration.menu.' + menuindex + '.title'][0]"
                            />
                </div>
                <div class="col-span-6" >
                            <InputLabel>URL <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="menu.url" required autofocus
                                autocomplete="recipient" />
                                <!-- {{ errors['configuration.menu.' + index + '.' + 'categories.'+ index+'.' +'items.'+index+'.url'] }} -->
                                <InputError
                                    class="mt-2"
                                    v-if="errors && errors['configuration.menu.' + menuindex + '.url']"
                                    :message="errors['configuration.menu.' + menuindex + '.url'][0]"
                            /> 
                </div>
            </div>
            <draggable class="dragArea list-group w-full" :list="menu.categories" >              
            	<div class="border p-3 my-2" v-for="(category, catindex) in menu.categories" :key="catindex">
           		 <div class="bg-gray-200 p-2 flow-root">

                    <div class="float-left">
                        Category {{ catindex+1 }}
                    </div>
                    <div class="float-right">
                        <a href="javascript:void(0)" v-if="menu && menu.categories && menu.categories.length > 1" v-on:click="remove_category(menuindex, catindex)" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer me-2">Remove Category</a>
                        <a href="javascript:void(0)" v-on:click="add_item(menuindex, catindex)" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer">Add Item</a>
                    </div>
                </div>
                <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-y-7 gap-x-2 m-2">
                    <div class="col-span-6" >
                        <InputLabel>Category Title <span class="text-red-400">*</span></InputLabel>
                        <TextInput type="text" class="mt-1 block w-full" v-model="category.title" required autofocus
                            autocomplete="recipient" />
                            <InputError
                            class="mt-2"
                            v-if="errors && errors['configuration.menu.' + menuindex + '.categories.' + catindex + '.title']"
                            :message="errors['configuration.menu.' + menuindex + '.categories.' + catindex + '.title'][0]"
                            />
                    </div>
                    <div class="col-span-6" >
                            <InputLabel>URL <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="category.url" required autofocus
                                autocomplete="recipient" />
                                <!-- {{ errors['configuration.menu.' + index + '.' + 'categories.'+ index+'.' +'items.'+index+'.url'] }} -->
                                <InputError
                                    class="mt-2"
                                    v-if="errors && errors['configuration.menu.' + menuindex + '.categories.' + catindex + '.url']"
                                     :message="errors['configuration.menu.' + menuindex + '.categories.' + catindex + '.url'][0]"
                            /> 
                </div>
                </div>
                <draggable class="dragArea list-group w-full" :list="category.items" >          
                   <div class="border p-3 my-2" v-for="(item, itemindex) in category.items" :key="itemindex">
                    <div class="bg-gray-200 p-2 flow-root">
                    <div class="float-left">
                        Item {{ itemindex+1 }}
                    </div>
                    <div class="float-right" v-if="category.items && category.items.length > 1">
                        <a href="javascript:void(0)" v-on:click="remove_item(menuindex, catindex, itemindex)" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer">Remove Item</a>
                    </div>
                </div>
                    <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-y-7 gap-x-2 m-2">
                        <div class="col-span-6" >
                            <InputLabel>Title <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="item.title" required autofocus
                                autocomplete="recipient" />
                                <InputError
                                    class="mt-2"
                                    v-if="errors && errors['configuration.menu.' + menuindex+'.'+ 'categories.'+ catindex +'.'+'items.'+ itemindex +'.title']"
                                    :message="errors['configuration.menu.' + menuindex+'.'+ 'categories.'+ catindex +'.'+'items.'+ itemindex +'.title'][0]"
                            />
                        </div>
                        <div class="col-span-6" >
                            <InputLabel>URL <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="item.url" required autofocus
                                autocomplete="recipient" />
                                <!-- {{ errors['configuration.menu.' + index + '.' + 'categories.'+ index+'.' +'items.'+index+'.url'] }} -->
                                <InputError
                                    class="mt-2"
                                    v-if="errors && errors['configuration.menu.' + menuindex+'.'+ 'categories.'+ catindex +'.'+'items.'+ itemindex+'.url']"
                                    :message="errors['configuration.menu.' + menuindex+'.'+ 'categories.'+ catindex +'.'+'items.'+ itemindex+'.url'][0]"
                            /> 
                        </div>
                    </div>
                </div>
                </draggable>                
            </div>
            </draggable>
        </div>
        </draggable>
    </div>
        <div class="flow-root mt-5 mb-2">
            <div class="float-right">
                <ButtonRegular size="sm" color="primary" v-on:click="save_settings">Save Settings</ButtonRegular>
            </div>
        </div>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import ButtonRegular from '@/Components/Button.vue';
import { VueDraggableNext } from 'vue-draggable-next'
export default {
    components: {
        InputLabel,
        TextInput,
        InputError,
        ButtonRegular,
        'draggable': VueDraggableNext
    },
    props: {
        settings: {
            type: Object,
            required: false
        },
        errors: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            configuration: {
                menu: [
                    {
                        title: 'School Students',
                        url: '',
                        categories: [
                            {
                                title: 'CBSE',
                                url: '',
                                items: [
                                    {
                                        title: 'Class 8',
                                        url: ''
                                    }
                                ]
                            }
                        ]
                    }
                ]
            },
            category: 'menu_settings',
        }
    },
    methods: {
        add_menu() {
            let menu = this.create_menu();
            this.configuration.menu.push(menu);
        },
        create_menu() {
            return {
                title: 'School Students',
		 url: '',
                categories: [
                    {
                        title: 'CBSE',
			 url: '',
                        items: [
                            {
                                title: 'Class 8',
                                url: ''
                            }
                        ]
                    }
                ]
            }
        },
        remove_menu(index) {
            this.configuration.menu.splice(index, 1);
        },
        add_category(index) {
            let category = this.create_category();
            this.configuration.menu[index].categories.push(category);
        },
        create_category() {
            return {
                title: 'CBSE',
		 url: '',
                items: [
                    {
                        title: 'Class 8',
                        url: ''
                    }
                ]
            }
        },
        remove_category(index, catindex) {
            this.configuration.menu[index].categories.splice(catindex, 1);;
        },
        add_item(index, catindex) {
            let item = this.create_item();
            this.configuration.menu[index].categories[catindex].items.push(item);
        },
        create_item() {
            return {
                title: 'Class 8',
                url: ''
            }
        },
        remove_item(index, catindex, itemindex) {
            this.configuration.menu[index].categories[catindex].items.splice(itemindex, 1);;
        },
        save_settings(){
            this.$emit('save-settings', this.category, this.configuration);
        }
    },
    watch: {
        settings() {
            this.configuration = this.$merge_objects(this.configuration, this.settings);
        }
    },
    mounted() {
        this.$emit('get-settings', this.category);
    }
}
</script>
