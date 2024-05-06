<template>
    <div class="border border-gray-300 p-3">
        <InputLabel for="packages" value="Packages" />
        <PackageAutocomplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title" :multiple="false" v-if="ispackageinitialized"/>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
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
            PackageAutocomplete
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    package: 0,
                },
                options: {
                    packages: []
                },
                ispackageinitialized: false,
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            create() {
                let vm = this;
                let payload = {
                    package: vm.configuration.package
                }
                axios.post(route('website.components.create', { component: 'package' }), payload).then((response) => {
                    vm.options = response.data;
                    vm.ispackageinitialized = true;
                }).catch(error => {

                });
            },
        },
        watch: {
            "configuration.package": function () {
                this.update_configuration();
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
            this.create();
        }
    }
</script>
