<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight">SSO Settings</div>
        <div class="mt-5">
            <InputLabel for="name">LMS Url <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="url"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.lms_url"
                autofocus
                autocomplete="url"
            />
            <InputError class="mt-2" v-if="errors && errors.lms_url" :message="errors.lms_url[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="name">LMS Token <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="token"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.lms_token"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.lms_token" :message="errors.lms_token[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="name">Encryption Key <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="encryptionkey"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.lms_encryption_key"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.lms_encryption_key" :message="errors.lms_encryption_key[0]"/>
        </div>
        <div class="mt-8" v-if="response_errors && response_errors.exception">
            <div class="bg-red-100 border rounded border-red-500 text-red-700 px-4 py-3">{{ response_errors.message }}</div>
        </div>
        <div class="mt-8" v-if="response && response.success">
            <div class="bg-green-100 border rounded border-green-500 text-green-700 px-4 py-3">{{ response.message }}</div>
        </div>
        <div class="flow-root mt-5 mb-2">
            <div class="float-right">
                <ButtonRegular size="sm" color="primary" :disabled="is_valid ? false : true" v-on:click="save_settings">Save Settings</ButtonRegular>
                <ButtonRegular size="sm" color="primary" v-on:click="test_connection">Test Connection</ButtonRegular>
            </div>
        </div>
    </div>
</template>
<script>
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import ButtonRegular from '@/Components/Button.vue';
    export default{
        components:{
            InputLabel,
            TextInput,
            InputError,
            ButtonRegular
        },
        props:{
            settings: {
                type: Object,
                required: false
            }
        },
        data(){
            return{
                configuration: {
                    lms_token: '',
                    lms_url: '',
                    lms_encryption_key: ''
                },
                category: 'lms_sso_settings',
                is_valid: false,
                response: {},
                response_errors: {},
                errors: []
            }
        },
        methods:{
            test_connection(){
                let vm = this;
                vm.errors = [];
                axios.post(route('integrations.sso.test.connection'), vm.configuration).then(response => {
                    if(!response.data.success){
                        vm.response_errors.exception = true;
                        vm.response_errors.message = response.data.message;
                        vm.response = {};
                        vm.is_valid = false;
                    }else{
                        vm.is_valid = true;
                        vm.response = response.data;
                        vm.response_errors = [];
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                });
            },
            save_settings(){
                this.$emit('save-settings', this.category, this.configuration);
            }
        },
        watch:{
            settings(){
                this.configuration = this.$merge_objects(this.configuration, this.settings);
            }
        },
        mounted(){
            this.$emit('get-settings', this.category);
        }
    }
</script>
