<template>
	<div>
	    <div class="flow-root pb-3">
	        <div class="float-left">
	            <div class="font-semibold text text-gray-800 leading-tight mb-3">Links</div>
	        </div>
	    </div>
	    <div class="border mb-2 p-2" >
	        <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-y-4 gap-x-4">
	            <div class="col-span-8">
	                <InputLabel>Home <span class="text-red-400">*</span></InputLabel>
	                <PagesAutocomplete v-model="configuration.home" :data="options.pages" returns="slug" label="title" :multiple="false"/>
	                <InputError class="mt-2" v-if="errors && errors.home" :message="errors.home[0]"/>
	            </div>
	            <div class="col-span-8">
	                <InputLabel>Articles <span class="text-red-400">*</span></InputLabel>
	                <PagesAutocomplete v-model="configuration.articles" :data="options.pages" returns="slug" label="title" :multiple="false"/>
	            </div>
	            <div class="col-span-8">
	                <InputLabel>Current Affairs <span class="text-red-400">*</span></InputLabel>
	                <PagesAutocomplete v-model="configuration.currentaffairs" :data="options.pages" returns="slug" label="title" :multiple="false"/>
	            </div>
	            <div class="col-span-8">
	                <InputLabel>Study Materials <span class="text-red-400">*</span></InputLabel>
	                <PagesAutocomplete v-model="configuration.studymaterials" :data="options.pages" returns="slug" label="title" :multiple="false"/>
	            </div>
	            <div class="col-span-8">
	                <InputLabel>Webinars <span class="text-red-400">*</span></InputLabel>
	                <PagesAutocomplete v-model="configuration.webinars" :data="options.pages" returns="slug" label="title" :multiple="false"/>
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
import PagesAutocomplete from '@/Components/AutoComplete/Pages.vue';
export default {
    components:{
        ButtonRegular,
        InputLabel,
        TextInput,
        InputError,
        PagesAutocomplete
    },
    emits: ["save-settings","get-settings"],
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
    data(){
        return {
            configuration: {
            	home: '',
                articles: '',
                currentaffairs: '',
                studymaterials: '',
                webinars: '',
            },
            options: {
                pages:[]
            },
            category: "links",
        }
    },
    methods: {
        save_settings() {
            this.$emit("save-settings", this.category, this.configuration);
        },
    },
    watch: {    
        settings() {
            if(this.settings){
                this.configuration = this.$merge_objects(this.configuration, this.settings);
            }
        }
    },
    mounted(){
        this.$emit("get-settings", this.category);
    }   
}
</script>
