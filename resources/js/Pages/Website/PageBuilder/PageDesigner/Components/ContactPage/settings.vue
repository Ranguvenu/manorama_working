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
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-2">
                <div>
                    <InputLabel for="primary_title" value="Primary Title" />
                    <TextInput id="primary_title" type="text" class="mt-1 block w-full" v-model="configuration.primary_title" placeholder="Primary Title" autofocus autocomplete="primary_title" v-on:keyup="update_configuration"/>
                </div>
                <div class="ms-6">
                    <InputLabel for="secondary_title" value="Secondary Title" />
                    <TextInput id="secondary_title" type="text" class="mt-1 block w-full" v-model="configuration.secondary_title" placeholder="Secondary Title" autofocus autocomplete="secondary_title" v-on:keyup="update_configuration"/>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-2">
                <div>
                    <InputLabel for="font_color_primary" value="Font Color Primary" />
                    <color-picker id="font_color_primary" class="h-30 w-full" v-model:pureColor="configuration.font_color_primary" lang="En" useType="pure"/>
                </div>
                <div class="ms-6">
                    <InputLabel for="font_color_secondary" value="Font Color Secondary" />
                    <color-picker id="font_color_secondary" class="h-30 w-full" v-model:pureColor="configuration.font_color_secondary" lang="En" useType="pure"/>
                </div>
            </div>
            <div class="col-span-full mt-3">
                <label class="block mb-2 font-medium text-sm text-gray-700" for="description">Description</label>
                <CkEditor v-model="configuration.description" @input="update_configuration"/>
            </div>
        </div>
    </div>
</template>
<script>
    import CkEditor from '@/Components/CkEditor.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
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
            ButtonOutline,
            Checkbox,
            MinusIcon
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    primary_title: '',
                    secondary_title: '',
                    description: '',
                    font_color_primary: '',
                    font_color_secondary: '',
                    breadcrumps: []
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
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
            create_breadcrump(){
                return {
                    title: 'Breadcrump',
                    link: '#',
                    active: 1
                };
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
