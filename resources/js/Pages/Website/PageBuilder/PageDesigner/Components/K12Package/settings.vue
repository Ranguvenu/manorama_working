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
                    <PackageAutocomplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title"
                        :multiple="false" v-if="ispackageinitialized" />
                    <!-- <MultiSelect class="mt-2" v-model="configuration.package" returns="id" :options="options.packages"
                        label="title" :multiple="false" /> -->
                </div>
                <div class="col-span-6">
                    <InputLabel for="title" value="Batch Start Date" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.batchdate"
                        placeholder="Batch Start Date" autofocus v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
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
            console.log('payloadss', payload);
            axios.post(route('website.components.create', { component: 'package' }), payload).then((response) => {
                vm.options = response.data;
                console.log('ptionsk12',vm.options);

                vm.ispackageinitialized = true;
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
        }
    },
    mounted() {
        this.configuration = this.data;
        //this.$merge_objects(this.configuration, this.data);
        this.update_configuration();
        this.create();
    }
}
</script>
