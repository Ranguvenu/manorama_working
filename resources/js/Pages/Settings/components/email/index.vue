<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight">Email Settings</div>
        <div class="mt-5">
            <InputLabel for="email_smtp_host">SMTP Host <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_host"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_host"
                autofocus
                autocomplete="host"
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_host" :message="errors.email_smtp_host[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="email_smtp_port">SMTP Port <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_port"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_port"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_port" :message="errors.email_smtp_port[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="email_smtp_username">SMTP Username <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_username"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_username"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_username" :message="errors.email_smtp_username[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="email_smtp_password">SMTP Password <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_password"
                type="password"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_password"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_password" :message="errors.email_smtp_password[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="encryption">SMTP Encryption <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="encryption"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_encryption"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.encryption" :message="errors.encryption[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="email_smtp_from_mail">From Email <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_from_mail"
                type="email"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_from_mail"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_from_mail" :message="errors.email_smtp_from_mail[0]"/>
        </div>
        <div class="mt-5">
            <InputLabel for="email_smtp_from_name">From Name <span class="text-red-400">*</span></InputLabel>
            <TextInput
                id="email_smtp_from_name"
                type="text"
                class="mt-2 w-full"
                v-model="configuration.email_smtp_from_name"
                autofocus
            />
            <InputError class="mt-2" v-if="errors && errors.email_smtp_from_name" :message="errors.email_smtp_from_name[0]"/>
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
            </div>
        </div>
    </div>
</template>
<script>
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import ButtonRegular from '@/Components/Button.vue';
    import Button from '@/Components/Button.vue';
    export default{
        components:{
            InputLabel,
            TextInput,
            InputError,
            ButtonRegular,
            Button
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
                    email_smtp_host: '',
                    email_smtp_port: '',
                    email_smtp_username: '',
                    email_smtp_password: '',
                    email_smtp_from_mail: '',
                    email_smtp_from_name: '',
                    email_smtp_encryption: ''
                },
                category: 'email_smtp_settings',
                is_valid: true,
                response: {},
                response_errors: {},
                errors: []
            }
        },
        methods:{
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
