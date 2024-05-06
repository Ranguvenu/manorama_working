<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-full">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full" v-if="ispackageinitialized">
                    <InputLabel for="package" value="Package" />
                    <PackageAutocomplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title" :multiple="false" v-if="ispackageinitialized"/>
                </div>
            </div>
        </div>
        <div class="border border-gray-300 p-3 mt-3" >
            <div class="text-lg font-semibold py-2 text-gray-800">Tests</div>
            <div class="border border-gray-300 my-2" v-for="(item, index) in configuration.tests" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Test {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="item.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="duration" value="Duration" />
                        <TextInput id="duration" type="text" class="mt-1 block w-full" v-model="item.duration" placeholder="Marks" autofocus autocomplete="marks" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="questions" value="Questions" />
                        <TextInput id="questions" type="number" class="mt-1 block w-full" v-model="item.questions" placeholder="Questions" autofocus autocomplete="questions" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="marks" value="Marks" />
                        <TextInput id="marks" type="number" class="mt-1 block w-full" v-model="item.marks" placeholder="Marks" autofocus autocomplete="marks" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="dates" value="Dates" />
                        <TextInput id="dates" type="text" class="mt-1 block w-full" v-model="item.dates" placeholder="Dates" autofocus autocomplete="dates" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                        v-if="configuration.tests.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Item</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import PackageAutocomplete from '@/Components/AutoComplete/Packages.vue';
    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            PackageAutocomplete
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Free Test',
                    package: '',
                    tests: [
                        {
                            title: '2024 UPSC IAS MOCK-TEST_1 (IMP Topics of Current Affairs) ENGLISH',
                            duration: '60 Mins',
                            questions: 50,
                            dates: 'Feb 13 Mon 12:30PM',
                            marks: 100,
                        }
                    ],
                },
                options: {
                    packages: []
                },
                ispackageinitialized: false
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_item() {
                let item = this.create_item();
                this.configuration.tests.push(item);
                this.update_configuration();
            },
            remove_item(index) {
                this.configuration.tests.splice(index, 1);
                this.update_configuration();
            },
            create_item() {
                return {
                    title: '2024 UPSC IAS MOCK-TEST_1 (IMP Topics of Current Affairs) ENGLISH',
                    duration: '60 Mins',
                    questions: 50,
                    dates: 'Feb 13 Mon 12:30PM',
                    marks: 100,
                }
            },
            create() {
                let vm = this;         
                let payload = {
                    packages: vm.configuration.package
                }
                axios.post(route('website.components.create', { component: 'test-package' }), payload).then((response) => {
                    vm.options = response.data;
                    vm.ispackageinitialized = true;
                }).catch(error => {

                });
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
            this.create();
        }
    }
</script>
