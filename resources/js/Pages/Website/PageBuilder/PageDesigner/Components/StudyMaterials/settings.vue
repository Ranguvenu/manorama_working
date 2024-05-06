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
                    <InputLabel for="icon" value="Title"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.title"
                        placeholder="Heading" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-5">
                    <InputLabel for="icon" value="Link"/>
                    <TextInput type="text" class="mt-1 block w-full" v-model="breadcrump.link"
                        placeholder="Link" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="icon" value="Is Link Active"/>
                    <div class="my-3">
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
        <div class="p-3 border mt-2">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-6">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="perpage" value="Postings Per Page" />
                    <TextInput id="perpage" type="number" class="mt-1 block w-full" v-model="configuration.perpage"
                        placeholder="Postings Per Page" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="searchlabel" value="Search Label" />
                    <TextInput id="searchlabel" type="text" class="mt-1 block w-full" v-model="configuration.search"
                        placeholder="Search Label" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MediaButton from '@/Components/MediaButton.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import TextArea from '@/Components/TextArea.vue';
import { MinusIcon } from "@heroicons/vue/24/solid";
import Checkbox from '@/Components/Checkbox.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline,
        TextArea,
        MinusIcon,
        Checkbox
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                breadcrumps: [],
                search: '',
                type: '',
                perpage: 10
            }
        }
    },
    methods: {
        update_configuration() {
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
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
