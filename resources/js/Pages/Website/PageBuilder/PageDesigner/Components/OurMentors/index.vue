<template>
    <div>
        <ComponentView :data="data.settings"/>
        <SettingsBase :show="!preview" element="Our Mentors" :data="data.advanced" @close-settings="$emit('close-settings')" @advanced-settings="update_advanced_configuration" @save-settings="$emit('save-settings')">
            <ComponentSettings :data="data.settings" @update-configuration="update_configuration"/>
        </SettingsBase>
    </div>
</template>
<script>
    import ComponentSettings from "./settings.vue";
    import ComponentView from './view.vue'
    import SettingsBase from '../../Settings/index.vue';
    export default{
        props:{
            preview: {
                type: Boolean,
                required: true
            },
            data:{
                type: Object,
                required: true
            }
        },
        emits: ['close-settings', 'update-configuration', 'update-advanced-configuration'],
        components:{
            ComponentSettings,
            ComponentView,
            SettingsBase
        },
        data(){
            return{

            }
        },
        methods:{
            update_configuration(configuration){
                this.$emit('update-configuration', configuration);
            },
            update_advanced_configuration(data){
                this.$emit('update-advanced-configuration', data);
            }
        },
        mounted(){

        }
    }
</script>
