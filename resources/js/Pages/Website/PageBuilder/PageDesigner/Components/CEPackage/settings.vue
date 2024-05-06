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
                    <InputLabel for="title" value="Batch Start Date" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="configuration.batchstart"
                        placeholder="Batch Start Date" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="title" value="Total Duration" />
                    <TextInput type="text" class="mt-1 block w-full" v-model="configuration.duration"
                        placeholder="Total Duration" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
            </div>
            <div class="border border-gray-300 my-2 mt-6">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Topics</div>

                <div v-for="(item, index) in configuration.topics" class="mx-2 mt-3 mb-4" :key="index">
                    <div class="flex">
                        <div class="w-full">
                            <InputLabel for="name" value="Topic Name" />
                            <TextInput type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Topic Name"
                                autofocus v-on:keyup="update_configuration" />
                        </div>
                        <div class="w-50 mx-2">
                            <InputLabel for="duration" value="Topic Duration" />
                            <TextInput type="text" class="mt-1 block w-full" v-model="item.duration"
                                placeholder="Topic Duration" autofocus v-on:keyup="update_configuration" />
                        </div>
                        <div class="mt-5">
                            <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                                v-if="configuration.topics.length > 1">Remove</ButtonOutline>
                        </div>
                    </div>

                </div>
                <div class="mt-6 flex items-center justify-center gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Topic</ButtonOutline>
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
                batchstart: '',
                duration: '',
                topics: [
                    {
                        title: 'Ancient & Medieval India',
                        type: 'video',
                        duration: '14hr',
                    }
                ]
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
        add_item() {
            let item = this.create_item();
            this.configuration.topics.push(item);
            this.update_configuration();
        },
        remove_item(index) {
            this.configuration.topics.splice(index, 1);
            this.update_configuration();
        },
        create_item() {
            return {
                title: '',
                type: '',
                duration: '',
            }
        },
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
        this.create();
    }
}
</script>
