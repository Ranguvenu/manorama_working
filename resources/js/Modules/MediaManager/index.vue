<template>
    <Modal :show="show" @close="$emit('hide')">
        <template #header>
            <div class="text-xl">{{ title }}</div>
        </template>
        <div>
            <div class="pt-3 px-3">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center">
                        <li class="mr-2" v-for="(tab, index) in tabs">
                            <a href="javascript:void(0)" :class="{ 'border-primary border-b-4 text-primary': (tab.component === active) }" v-on:click="switch_tab(tab)" aria-current="page" class="inline-block py-2 px-3 text-blue-600 rounded-t-lg active ">{{ tab.name }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <MediaUploads v-if="active == 'media-uploads'" :accepts="accepts" :component="component" :multiple="multiple" @file-selected="uploaded"/>
                    <MediaManager v-if="active == 'media-library'" :accepts="accepts" :component="component" :items="items" :multiple="multiple" @selected="selected"/>
                </div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('hide')">Close</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-if="media && media.length" v-on:click="insert_media">Insert Media</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
    import Modal from '@/Components/Modal.vue';
    import MediaUploads from './upload.vue';
    import MediaManager from './manager/index.vue';
    import ButtonRegular from '@/Components/Button.vue';

    export default {
        props:{
            title:{
                type: String,
                default: 'Media'
            },
            show: {
                type: Boolean,
                required: true
            },
            component:{
                type: String,
                required: true
            },
            multiple:{
                type: [Boolean, Number],
                required: true
            },
            items:{
                type: Array,
                required: true
            },
            accepts: {
                type: String,
                required: false
            }
        },
        emits: ["insert-media", "hide", "selected", "file-uploaded"],
        components:{
            MediaUploads,
            MediaManager,
            Modal,
            ButtonRegular
        },
        data(){
            return{
                tabs: [
                    {
                        name: 'Upload Files',
                        slug: 'uploads',
                        component: 'media-uploads'
                    },
                    {
                        name: 'Media Library',
                        slug: 'media',
                        component: 'media-library'
                    }
                ],
                active: 'media-library',
                media: []
            }
        },
        methods:{
            switch_tab(tab){
                this.active = tab.component;
            },
            selected(media){
                this.media = media;
                this.$emit('selected', media.url);
            },
            uploaded(media){
                this.active = 'media-library';
                this.$emit('file-uploaded', media);
                this.media.push(media);
            },
            insert_media(){
                this.$emit('insert-media', this.media)
            }
        },
        mounted(){
           
        }
    }
</script>
