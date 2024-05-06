<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight mb-3">
            Footer Configuration
        </div>
        <div>
            <draggable class="dragArea list-group w-full" :list="configuration.footer_links">
                <div class="border p-3 my-2" v-for="(link, linkindex) in configuration.footer_links" :key="linkindex">
                    <InputLabel>Heading <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="hidden" class="mt-2 w-full" autofocus > {{ linkindex+1 }} </TextInput>                          
                    <TextInput type="text" class="mt-2 w-full" autofocus v-model="link.name"/>
                    <InputError
                            class="mt-2"
                            v-if="errors && errors['configuration.footer_links.' + linkindex + '.name']"
                            :message="errors['configuration.footer_links.' + linkindex + '.name'][0]"
                            />
                    <draggable class="dragArea list-group w-full" :list="link.children">
                        <div class="my-2 bg-zinc-100 border border-zinc-200 p-3" v-for="(element, elementindex) in link.children" :key="elementindex">
                            <div class="flex">
                                <div class="w-60 me-2 ">
                                    <TextInput type="hidden" class="mt-2 w-full"  autofocus>{{ elementindex+1 }} </TextInput>
                             
                                    <InputLabel>Label<span class="text-red-400">*</span></InputLabel>
                                    <TextInput type="text" class="mt-2 w-full" v-model="element.name" autofocus/>
                                    <InputError
                                        class="mt-2"
                                        v-if="errors && errors['configuration.footer_links.' + linkindex +'.children.'+ elementindex +'.name']"
                                        :message="errors['configuration.footer_links.' + linkindex +'.children.'+ elementindex +'.name'][0]"
                                     />
                                </div>
                                <div class="w-full">
                                    <InputLabel>URL<span class="text-red-400">*</span></InputLabel>
                                    <TextInput type="text" class="mt-2 w-full" v-model="element.link" autofocus/>
                                    <InputError
                                        class="mt-2"
                                        v-if="errors && errors['configuration.footer_links.' + linkindex +'.children.'+ elementindex +'.link']"
                                        :message="errors['configuration.footer_links.' + linkindex +'.children.'+ elementindex +'.link'][0]"
                                     />
                                </div>
                                <div class="w-25">
                                    <ButtonRegular class="mt-8" size="sm" color="secondary" v-on:click="remove_link(linkindex, elementindex)">
                                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true" />
                                    </ButtonRegular>
                                </div>
                            </div>
                        </div>
                        <div class="flow-root mt-5 mb-2">
                            <div class="float-right">
                                <ButtonRegular size="sm" color="primary" v-on:click="remove_category(linkindex)">Remove Category</ButtonRegular>
                                <ButtonRegular size="sm" color="secondary" v-on:click="add_link(linkindex)">Add Link</ButtonRegular>
                            </div>
                        </div>
                    </draggable>
                </div>
            </draggable>
            <div class="flow-root mt-5 mb-2">
                <div class="float-right">
                    <ButtonRegular size="sm" color="secondary" v-on:click="add_category">Add Category</ButtonRegular>
                </div>
            </div>
        </div>
        <div class="flow-root mt-5 mb-2">
            <div class="float-right">
                <ButtonRegular size="sm" color="primary" v-on:click="save_settings">Save Settings</ButtonRegular>
            </div>
        </div>
    </div>
</template>
<script>
import { VueDraggableNext } from 'vue-draggable-next'
import ButtonRegular from "@/Components/Button.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { MinusIcon } from "@heroicons/vue/24/solid";
import InputError from '@/Components/InputError.vue';

export default{
    components:{
        InputLabel,
        TextInput,
        ButtonRegular,
        InputError,
        MinusIcon,
        'draggable': VueDraggableNext
    },
    props:{
        settings: {
            type: Object,
            required: false
        },
        errors: {
            type: Object,
            required: false
        }
    },
    data(){
        return{
            configuration: {
                footer_links: [
                    {
                        name: 'Manorama Horizon',
                        children: [
                            {
                                name: 'About',
                                link: '/about'
                            }
                        ]
                    }
                ]
            },
            category: "theme_footer",
        }
    },
    methods:{
        add_link(index){
            let item = this.create_link();
            this.configuration.footer_links[index].children.push(item);
        },
        add_category(){
            let item = this.create_category();
            this.configuration.footer_links.push(item);
        },
        remove_link(key, index){
            this.configuration.footer_links[key].children.splice(index, 1);
            this.update_configuration();
        },
        remove_category(index){
            this.configuration.footer_links.splice(index, 1);
        },
        create_link(){
            return {
                'name': 'About',
                'link': '/about'
            }
        },
        create_category(){
            return {
                name: 'Manorama Horizon',
                children: [
                    {
                        name: 'About',
                        link: '/about'
                    }
                ]
            };
        },
        save_settings(){
            this.$emit('save-settings', this.category, this.configuration);
        }
    },
    watch:{
        settings(){
            console.log(this.settings);
            if(this.settings && this.settings.footer_links && this.settings.footer_links.length){
                this.configuration = this.$merge_objects(this.configuration, this.settings);
            }
        }
    },
    mounted(){
        this.$emit('get-settings', this.category);
    }
}
</script>
