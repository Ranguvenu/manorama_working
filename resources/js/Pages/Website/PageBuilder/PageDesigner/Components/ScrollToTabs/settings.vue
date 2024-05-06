<template>
    <div>
        <div class="p-3 border mt-2">
            <div class="flex justify-between items-center mb-3">
                <div class="text-gray-800">Tabs</div>
                <div>
                    <ButtonOutline size="sm" v-on:click="add_tab">Add Tab</ButtonOutline>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-for="(tab, index) in configuration.tabs">
                <div class="col-span-6">
                    <InputLabel for="icon" value="Title"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="tab.name"
                        placeholder="Heading" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="icon" value="Link"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="tab.scroll_to"
                        placeholder="Link" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-1">
                    <ButtonOutline class="mt-5" size="sm" v-on:click="remove_tab(index)">
                        <MinusIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true"/>
                    </ButtonOutline>
                </div>
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
import { MinusIcon } from "@heroicons/vue/24/solid";

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        CkEditor,
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline,
        MinusIcon
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                tabs: [
                    {
                        name: 'Testimonials',
                        scroll_to: 'testimonials'
                    }
                ]
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        add_tab(){
            let item = this.create_tab();
            this.configuration.tabs.push(item);
            this.update_configuration();
        },
        remove_tab(index){
            this.configuration.tabs.splice(index, 1);
            this.update_configuration();
        },
        create_tab(){
            return {
                name: 'Testimonials',
                scroll_to: 'tesimonials'
            }
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
