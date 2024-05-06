
import SidebarVue from '@/Components/Sidebar.vue';
<template>
    <div>
        <div class="flow-root pb-3">
            <div class="float-left">
                <div class="font-semibold text text-gray-800 leading-tight mb-3">Blog Sidebar Configuration</div>
            </div>
            <div class="float-right">
                <a href="javascript:void(0)" v-on:click="add_widget()" class="border-primary border border-2 px-4 py-1 text-sm text-primary cursor-pointer">Add Widget</a>
            </div>
        </div>
        <div class="border mb-2 p-2" v-for="(widget, index) in configuration.sidebar">
            <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-y-4 gap-x-4">
                <div class="col-span-6">
                    <InputLabel>Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="widget.title"/>
                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('configuration', 'title', index)]" :message="errors[$get_error_key('configuration', 'title', index)][0]" />
                </div>
                <div class="col-span-6">
                    <InputLabel>Layout <span class="text-red-400">*</span></InputLabel>
                    <select class="rounded mt-1 block w-full border-0.5 border-zinc-300" v-model="widget.layout">
                        <option value="thumbnail">Thumbnail Layout</option>
                        <option value="list">List Layout</option>
                    </select>
                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('configuration', 'layout', index)]" :message="errors[$get_error_key('configuration', 'layout', index)][0]" />
                </div>
                <div class="col-span-6">
                    <InputLabel>View More Label <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="widget.more.label"/>
                </div>
                <div class="col-span-6">
                    <InputLabel>View More Link <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="widget.more.link"/>
                </div>
                <div class="col-span-6">
                    <InputLabel>Limit <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="number" class="mt-1 block w-full" v-model="widget.limit"/>
                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('configuration', 'limit', index)]" :message="errors[$get_error_key('configuration', 'limit', index)][0]" />
                </div>
                <div class="col-span-6">
                    <InputLabel>Goal <span class="text-red-400">*</span></InputLabel>
                    <GoalsAutocomplete v-model="widget.value" :data="options.goals" returns="id" label="title" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors[$get_error_key('configuration', 'value', index)]" :message="errors[$get_error_key('configuration', 'value', index)][0]" />
                </div>
            </div>
            <div class="flow-root mt-5 mb-2" v-if="configuration && configuration.sidebar && configuration.sidebar.length > 1">
                <div class="float-right">
                    <ButtonRegular size="sm" color="secondary" v-on:click="remove_widget(index)">Remove</ButtonRegular>
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
import ButtonRegular from '@/Components/Button.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import GoalsAutocomplete from '@/Components/AutoComplete/Goals.vue';
export default {
    components:{
        ButtonRegular,
        InputLabel,
        TextInput,
        InputError,
        GoalsAutocomplete
    },
    data(){
        return {
            configuration: {
                sidebar: [
                    {
                        title: '',
                        layout: '',
                        limit: 2,
                        more: {
                            link: '',
                            label: ''
                        },
                        value: 0,
                        type: 'hierarchy'
                    }
                ]
            },
            options: {
                goals:[]
            },
            category: "blog_sidebar",
        }
    },
    props: {
        settings: {
            type: Object,
            required: false,
        },
        errors: {
            type: Object,
            required: false
        }
    },
    methods: {
        add_widget(){
            let widget = this.create_widget();
            this.configuration.sidebar.push(widget);
        },
        create_widget(){
            return {
                title: '',
                layout: '',
                limit: 2,
                more: {
                    link: '',
                    label: ''
                },
                value: 0,
                type: 'hierarchy'
            }
        },
        remove_widget(index){
            this.configuration.sidebar.splice(index, 1);
        },
        save_settings() {
            this.$emit("save-settings", this.category, this.configuration);
        },
    },
    watch: {    
        settings() {
            if(this.settings && this.settings.sidebar && this.settings.sidebar.length){
                this.configuration = this.$merge_objects(this.configuration, this.settings);
            }
        }
    },
    mounted(){
        this.$emit("get-settings", this.category);
    }   
}
</script>