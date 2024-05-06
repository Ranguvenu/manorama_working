<template>
    <div class="pagedesigner sm:mt-[8rem]">
        <div class="bg-rose-100 toolbar px-5 py-2 sticky top w-100">
            <div class="flex justify-between">
                <div>
                    <div class="text-sm text-gray-500">Currently Editing</div>
                    <div class="text-regular text-gray-800">{{ data.title }}</div>
                </div>
                <div class="flex">
                    <!--<span class="text-gray-600 py-4 text-sm me-4 flex"><QuestionMarkCircleIcon class="me-1 w-4 text-gray-500"></QuestionMarkCircleIcon>Edited</span>-->
                    <ButtonRegular size="sm" color="primary" v-on:click="publish">Publish</ButtonRegular>
                    <ButtonRegular size="sm" color="secondary" v-on:click="preview">Preview</ButtonRegular>
                </div>
            </div>
        </div>
        <div>
            <draggable class="dragArea list-group w-full" :list="elements" @update="log">
                <div v-for="element in elements" :key="element.name">
                    <DesignComponents :page="page" :component="element" :configuration="element.configuration"
                        @delete-component="destroy" @duplicate-component="clone" @save-configuration="save_configuration"
                        @update-visibility="update_visibility" />
                </div>
            </draggable>
        </div>
        <div class="m-5">
            <div class="max-w-7xl mx-auto">
                <button class="border-2 border-dashed border-gray-400 p-5 text-center w-full" v-if="!show"
                    v-on:click="show = !show">
                    <PlusIcon class="mx-auto h-8 w-8 text-gray-600"/>
                </button>
            </div>
            <Modal :show="show" @close="show = false">
                <template #header>
                    <div class="text-lg text-gray-800">Add Element</div>
                </template>
                <div class="p-3 w-full" v-if="show">
                    <AvailableElements @add-component="add_component" />
                </div>
            </Modal>
        </div>
    </div>
</template>
<script>
import { VueDraggableNext } from 'vue-draggable-next';
import DesignComponents from './Components/index.vue';
import AvailableElements from './elements.vue';
import ButtonRegular from '@/Components/Button.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import Modal from '@/Components/Modal.vue';
import { PlusIcon, QuestionMarkCircleIcon } from "@heroicons/vue/24/solid";

export default {
    components: {
        AvailableElements,
        DesignComponents,
        Modal,
        PlusIcon,
        ButtonRegular,
        ButtonOutline,
        QuestionMarkCircleIcon,
        draggable: VueDraggableNext
    },
    props: {
        page: {
            type: Number,
            required: true
        },
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            enabled: true,
            elements: [],
            draging: false,
            show: false,
        }
    },
    methods: {
        get_components() {
            let vm = this;
            axios.get('/website/pages/' + vm.page + '/design/create').then(response => {
                vm.elements = response.data.data;
            }).catch(error => {

            });
        },
        add_component(component) {
            let vm = this;
            let payload = {
                order: 0,
                configuration: component.configuration,
                page_component_type_id: component.id
            };
            axios.post('/website/pages/' + vm.page + '/design/store', payload).then(response => {
                vm.get_components();
                vm.show = false;
            }).catch(error => {

            });
        },
        save_configuration(componentid, configuration) {
            let vm = this;
            let payload = {
                order: 0,
                configuration: configuration
            };
            axios.post('/website/pages/' + vm.page + '/design/' + componentid + '/update', payload).then(response => {
                console.log(response);
            }).catch(error => {

            });
        },
        update_positions(elements) {
            let vm = this;
            axios.post('/website/pages/' + vm.page + '/design/positions', elements).then(response => {
                console.log(response);
            }).catch(error => {

            });
        },
        destroy(componentid) {
            let vm = this;
            axios.delete('/website/pages/' + vm.page + '/design/' + componentid + '/destroy').then(response => {
                vm.get_components();
            }).catch(error => {

            });
        },
        publish(){
            let vm = this; 
            axios.post(route('website.pages.publish', {page: vm.page}), vm.elements).then(response => {
                if(response && response.data && response.data.success){
                    let url = '';
                    if(response.data.page_type == 'package'){
                        url  = route('frontend.package', { page: response.data.page_slug, type: response.data.page_type })
                    }else{
                        url = route('frontend.index', {page: response.data.page_slug, type: response.data.page_type})
                    }
                    this.$inertia.visit(url);
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {

            });
        },
        preview(){
            let url = route('website.pages.components.show', [this.page])
            window.open(url, '__blank');
        },
        clone(componentid) {
            let vm = this;
            axios.get(route('website.pages.components.clone', { page: vm.page, component: componentid })).then(response => {
                vm.get_components();
            }).catch(error => {

            });
        },
        update_visibility(componentid, visibility) {
            let vm = this;
            axios.get(route('website.pages.components.visibility', { page: vm.page, component: componentid, visible: visibility })).then(response => {
                vm.get_components();
            }).catch(error => {

            });
        },
        log(event) {
            this.update_positions(this.elements);
        }
    },
    mounted() {
        console.log(this.page);
        this.get_components();
    }
}
</script>
