<template>
    <div>
        <div class="p-3">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-full">
                    <InputLabel for="title" value="Title" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-full">
                    <InputLabel for="title" value="Package" />
                    <PackageAutocomplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title"
                        :multiple="false" v-if="ispackageinitialized" />
                </div>
                <div class="col-span-full">
                    <label class="block mb-2 font-medium text-sm text-gray-700" for="description">Description</label>
                    <CkEditor v-model="configuration.description" @input="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="title" value="Class Timings" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="configuration.timings"
                        placeholder="Class Timings" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="title" value="Batch Duration" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="configuration.batchduration"
                        placeholder="Batch Duration" autofocus autocomplete="title" v-on:keyup="update_configuration" />
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
import MultiSelect from '@/Components/MultiSelect.vue';
import PackageAutocomplete from '@/Components/AutoComplete/Packages.vue';

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
        MultiSelect,
        PackageAutocomplete
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                package: 0,
                description: '',
                timings: '',
                batchduration: '',
            },
            options: {
                packages: []
            },
            ispackageinitialized: false
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        create() {
            let vm = this;
            let payload = {
                package: vm.configuration.package
            }
            axios.post(route('website.components.create', { component: 'cepackage' }), payload).then((response) => {
                vm.options = response.data;
                vm.ispackageinitialized = true;
            }).catch(error => {

            });
        },
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
        this.create();
    }
}
</script>
