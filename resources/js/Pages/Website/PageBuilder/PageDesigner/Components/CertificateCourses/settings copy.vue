<template>
    <div class="border border-gray-300 p-3">
        <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3 pb-5 ">
            <div class="col-span-6">
                <InputLabel for="tile" value="Title" />
                <TextInput type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="tile" value="Limit" />
                <TextInput type="number" class="mt-1 block w-full" v-model="configuration.limit" placeholder="Limit" autofocus v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-12">
                <InputLabel for="Caption" value="Caption" />
                <TextInput id="Caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-12">
                <InputLabel for="searchlabel" value="Title Alignment" />
                <select class="w-full mt-2 border-gray-300 rounded" v-model="configuration.title_alignment">
                    <option value="start">Left</option>
                    <option value="center">Center</option>
                    <option value="end">Right</option>
                </select>
            </div>
            <div class="col-span-12" v-if="ispackageinitialized">
                <InputLabel for="tile" value="Packages"/>
                <!-- <packagesAutocomplete v-model="configuration.goal" :data="options.packages" returns="id" label="title" :multiple="false" v-if="ispackageinitialized"/> -->
                <MultiSelect class="mt-2" v-model="configuration.packages" returns="id" :options="options.packages" label="title" :multiple="true"/>

            </div>
            <div class="col-span-6">
                <InputLabel for="tile" value="View All Label" />
                <TextInput type="text" class="mt-1 block w-full" v-model="configuration.more.label" placeholder="View All Label" autofocus v-on:keyup="update_configuration"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="tile" value="View All Link" />
                <TextInput type="text" class="mt-1 block w-full" v-model="configuration.more.link" placeholder="Link to view all" autofocus v-on:keyup="update_configuration"/>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    // import packagesAutocomplete from '@/Components/AutoComplete/packages.vue';
    import MultiSelect from "@/Components/MultiSelect.vue";

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
            // packagesAutocomplete,
            MultiSelect
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    title_alignment: '',
                    packages: [],
                    limit: 4,
                    more: {
                        label: 'View All Courses',
                        link: ''
                    }
                },
                ispackageinitialized: false,
                options: {
                    packages: []
                }
            }
        },
        methods:{
            initialize(){
                return{
                    type: '',
                    packages: [],
                    code: '',
                    auto_generate: 0,
                    discount_type: '',
                    discount_value: '',
                    valid_from: '',
                    valid_to: '',
                    coupon_usage_limit: 1,
                    user_usage_limit: '',
                }
            },
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            create() {
                let vm = this;
                axios.get(route('ecommerce.coupons.create')).then(response => {
                    vm.options = response.data;
                    console.log('options',vm.options)
                    vm.ispackageinitialized = true;
                }).catch(error =>{

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
