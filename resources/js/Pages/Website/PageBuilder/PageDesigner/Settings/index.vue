<template>
    <div>
        <Modal :show="show" @close="$emit('close-settings')">
            <template #header>
                <div class="text-lg font-semibold text-gray-800">{{ element }}</div>
            </template>
            <div class="bg-gray-100 mb-5 rounded border border-gray-200 text-sm font-medium text-center dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap text-sm font-medium text-center">
                    <li class="mr-2" v-for="(tab, index) in tabs">
                        <a href="javascript:void(0)" :class="{ 'bg-white text-primary': (tab.component === active) }" v-on:click="switch_tab(tab)" aria-current="page" class="text-gray-600 inline-block py-2 px-3">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="px-4 py-2 mt-2 builder-settings-body">
                <div v-if="active == 'general'">
                    <slot/>
                </div>
                <AdvancedSettings :data="data" @advanced-settings="advanced_settings" v-if="active == 'advanced'"/>
            </div>
            <template #footer>
                <ButtonRegular size="sm" color="default" v-on:click="$emit('close-settings')">Cancel</ButtonRegular>
                <ButtonRegular size="sm" color="primary" v-on:click="$emit('save-settings')">Save</ButtonRegular>
            </template>
        </Modal>
    </div>
</template>
<script>
    import Modal from '@/Components/Modal.vue';
    import ButtonRegular from '@/Components/Button.vue';
    import AdvancedSettings from './advanced.vue';
    export default{
        props:{
            component: {
                type: String,
                requried: true
            },
            element:{
                type: String,
                required: true
            },
            show: {
                type: [Boolean, Number],
                required: true
            },
            data:{
                type: Object,
                required: true
            }
        },
        emits: ['close-settings', 'save-settings', 'advanced-settings'],
        components:{
            Modal,
            ButtonRegular,
            AdvancedSettings,
        },
        data(){
            return{
                tabs: [
                    {
                        name: 'General',
                        slug: 'general',
                        component: 'general'
                    },
                    {
                        name: 'Advanced',
                        slug: 'advanced',
                        component: 'advanced'
                    }
                ],
                active: 'general',
            }   
        },
        methods: {
            switch_tab(tab){
                this.active = tab.component;
            },
            advanced_settings(settings){
                this.$emit('advanced-settings', settings);
            }
        },
        mounted(){
            this.advanced_settings(this.data);
        }
    }
</script>
