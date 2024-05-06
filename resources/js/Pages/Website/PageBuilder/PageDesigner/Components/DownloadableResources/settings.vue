<template>
    <div>
        <div class="p-3 border mt-2">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-12">
                    <InputLabel for="perpage" value="Resources per page" />
                    <TextInput id="perpage" type="number" class="mt-1 block w-full" v-model="configuration.perpage"
                        placeholder="Resources per page" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="caption" value="Caption" />
                    <TextArea id="caption" class="border-gray-300 mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus v-on:keyup="update_configuration"/>
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
                caption: '',
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
