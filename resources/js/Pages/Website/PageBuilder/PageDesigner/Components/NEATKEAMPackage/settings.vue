<template>
    <div>
        <div class="p-3 border">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-full">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-full">
                    <InputLabel for="title" value="Package" />
                    <PackageAutocomplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title" :multiple="false" v-if="ispackageinitialized" />
                </div>
                <div class="col-span-12" v-if="package && package.prices" v-for="(key, index) in Object.keys(package.prices)" :key="index">
                    <div class="text-gray-800 font-semibold bg-gray-200 p-2 mb-5">Variation {{ index+1 }}</div>
                    <div class="mx-3">
                        <div class="mx-4" v-if="package.prices[key] && package.prices[key].title">
                            <InputLabel class="mx-4" :for="'name_' + key" :value="package.prices[key].title"/>
                        </div>
                        <span class="inline-block mr-2" v-else v-for="(sub, subKey) in package.prices[key]" :key="subKey">
                            <InputLabel :for="'name_' + key + '_' + subKey" :value="sub.title" />
                        </span>
                        <TextInput :id="'name_' + key" type="text" class="mt-1 block w-full" v-model="configuration.name[key]" placeholder="name" autofocus v-on:keyup="update_configuration" />
                    </div>
                </div>
                <div class="col-span-12">
                    <InputLabel for="title" value="Batch Start Date" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.batchdate"
                        placeholder="Batch Start Date" autofocus v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6 hidden">
                    <InputLabel for="title" value="Enable Subject Selection" />
                    <Checkbox v-model:checked="configuration.is_variable" />
                </div>
                <div class="col-span-6">
                    <div>
                        <InputLabel for="plan" value="Study Plan" />
                        <MediaButton class="mt-2" component="packages" name="Select Study Plan" accepts="pdf" :multiple="false" return_type="url" v-model="configuration.studyplan"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <InputLabel for="syllabys" value="Configure Syllabus" />
                    <SyllabusConfiguration v-model="configuration.courses" @updated="update_configuration"/>
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
import Checkbox from '@/Components/Checkbox.vue';
import PackageAutocomplete from '@/Components/AutoComplete/Packages.vue';
import SyllabusConfiguration from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/Syllabus/index.vue';

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
        Checkbox,
        PackageAutocomplete,
        SyllabusConfiguration
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: 'Courses',
                package: 0,
                name: [{

                }],
                batchdate: '',
                is_variable: 1,
                studyplan: '',
                courses: [
                    {
                        slug: 'science',
                        title: 'Science',
                        timings: 'Mon - Fri - 7:30PM to 9:00PM',
                        syllabus: [
                            {
                                title: 'Biological Classification',
                                topics: [
                                    {
                                        type: '',
                                        title: ''
                                    }
                                ]
                            }
                        ]
                    }
                ]
            },
            options: {
                packages: []
            },
            ispackageinitialized: false,
            loopCounter: 1

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
            this.show();

            axios.post(route('website.components.create', { component: 'package' }), payload).then((response) => {
                vm.options = response.data;
                vm.ispackageinitialized = true;
                if (vm.package && vm.package.subjects) {
                    vm.subjects = Array.from(new Set(vm.package.subjects.map(subject => subject.id)));
                }
            }).catch(error => {

            });
        },
        show() {
            let vm = this;
            let payload = {
                package: vm.configuration.package
            };
            axios.post(route('website.components.show', { component: 'neatkeamp-package' }), payload).then(response => {
                vm.package = response.data;

                if (vm.package && vm.package.subjects) {
                    vm.subjects = Array.from(new Set(vm.package.subjects.map(subject => subject.id)));
                }
            }).catch(error => {

            });
        },
    },
    watch: {
        "configuration.package": function () {
            this.update_configuration();
        },
        "configuration.courses": function(){
            this.update_configuration();
        },
        "configuration.package": function () {
            this.show();
        },
        "configuration.package": function () {
            this.create();
        },

    },
    mounted() {
        this.configuration = this.data;
        //this.$merge_objects(this.configuration, this.data);
        this.update_configuration();
        this.create();
        this.show();
        this.loopCount += 1;

    }
}
</script>
