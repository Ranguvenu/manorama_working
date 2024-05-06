<template>
    <div>
        <div class="col-span-12">
            <InputLabel for="title" value="Title" />
            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title"
                autofocus autocomplete="title" v-on:keyup="update_configuration" />
        </div>
        <div class="border border-gray-300 p-3 mb-3">
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">
                Courses
            </div>
            <pre>{{ }}</pre>

            <div class="my-2" v-for="(course, index) in configuration.courses" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">
                    Tab{{ index + 1 }}
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                    <div class="col-span-4">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="course.title"
                            placeholder="Title" autofocus autocomplete="title" />
                    </div>       
                    <!-- {{options.goals}}         -->
                    <div class="col-span-4">
                        <InputLabel for="tile" value="Goal" />                                                       
                        <GoalsAutocomplete v-model="course.goal" :data="options.goals[index] " returns="id" label="title"
                            :multiple="false" v-if="ispackageinitialized" />
                    </div>
           
                    <div class="col-span-4">
                        <InputLabel for="searchlabel" value="Time Line" />
                    <select class="w-full mt-2 border-gray-300 rounded" v-model="course.timeline">
                        <option value="past">Past</option>
                        <option value="future">Future</option>                    
                    </select>
                    </div>

                    <div class="col-span-6">
                        <InputLabel for="viewmorelabel" value="View More Label" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="course.more.label"
                            :placeholder="course.more.label" autofocus v-on:keyup="update_configuration" />
                    </div>
                    <div class="col-span-6">
                        <InputLabel for="tile" value="Limit" />
                        <TextInput type="number" class="mt-1 block w-full" v-model="course.limit" placeholder="Limit"
                            autofocus v-on:keyup="update_configuration" />
                    </div>

                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_tab(index)"
                        v-if="configuration.courses.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_tab()">Add Tab</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import MediaButton from "@/Components/MediaButton.vue";
import ButtonOutline from "@/Components/ButtonOutline.vue";
import ActionButtons from "@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/settings.vue";
import { MinusIcon } from "@heroicons/vue/24/solid";
import Checkbox from "@/Components/Checkbox.vue";
import GoalsAutocomplete from "@/Components/AutoComplete/Goals.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

export default {
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    components: {
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline,
        ActionButtons,
        MinusIcon,
        Checkbox,
        GoalsAutocomplete,
        MultiSelect,
    },
    emits: ["update-configuration"],
    data() {
        return {
            configuration: {
                title: "",
                courses: [
                    {
                        title: "Fundamental",
                        goal: "",
                        limit: 0,
                        timeline: "",
                        more: {
                            label: "Viewmore",
                        },
                    },
                ],
            },
            options: {
                goals: [],
            },
            ispackageinitialized: false,
        };
    },
    methods: {
        update_configuration() {
            this.$emit("update-configuration", this.configuration);
        },
        add_tab() {
            let tab = this.create_tab();
            this.configuration.courses.push(tab);
            this.update_configuration();
        },
        remove_tab(index) {
            this.configuration.courses.splice(index, 1);
            this.update_configuration();
        },
        create_tab() {
            return {
                title: "",
                goal: "",
                limit: "",
                timeline: "",
                more: {
                    label: "",
                },
            };
        },
        create() {
                let vm = this;
            
                let payload = {
                    goal: vm.configuration?.courses
                }
                axios.post(route('website.components.create', { component: 'our-offerings' }), payload).then((response) => {
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
    },
    watch: {},
    
};
</script>
