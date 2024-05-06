<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight">SMS Settings</div>
        <div class="ms-1">
            <div class="mt-3">
                <InputLabel for="send_sms_via">Send SMS Via <span class="text-red-400">*</span></InputLabel>
                <select style="border-radius: 0.4rem; border: 1px solid #d9d9d9;" id="send_sms_via"
                    class="mt-1 block w-full border-0.5" v-model="configuration.send_sms_via">
                    <option value="">Select Via</option>
                    <option value="sms_country">SMS Country</option>
                    <option value="sms_sinch">Sinch</option>
                </select>
                <InputError class="mt-2" v-if="errors && errors.send_sms_via" :message="errors.send_sms_via[0]" />
            </div>
            <div class="border border-2  rounded mt-5 p-4">
                <div class="font-semibold text text-gray-800 leading-tight" style="font-size: 14px;">Sinch Configuration
                </div>
                <div class="mt-3">
                    <InputLabel for="sinch_plan_id">App ID <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sinch_plan_id" type="text" class="mt-2 w-full" v-model="configuration.sinch_plan_id"
                        autofocus autocomplete="host" />
                    <InputError class="mt-2" v-if="errors && errors.sinch_plan_id" :message="errors.sinch_plan_id[0]" />
                </div>
                <div class="mt-5">
                    <InputLabel for="sinch_api_token">Password <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sinch_api_token" type="text" class="mt-2 w-full" v-model="configuration.sinch_api_token"
                        autofocus />
                    <InputError class="mt-2" v-if="errors && errors.sinch_api_token" :message="errors.sinch_api_token[0]" />
                </div>
                <div class="mt-5">
                    <InputLabel for="sinch_from_number">Sender ID <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sinch_from_number" type="text" class="mt-2 w-full"
                        v-model="configuration.sinch_from_number" autofocus />
                    <InputError class="mt-2" v-if="errors && errors.sinch_from_number"
                        :message="errors.sinch_from_number[0]" />
                </div>

            </div>
            <div class="border border-2 rounded mt-5 p-4">
                <div class="font-semibold text text-gray-800 leading-tight" style="font-size: 14px;">SMS Country</div>
                <div class="mt-3">
                    <InputLabel for="sms_country_auth_key">Auth Key <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sms_country_auth_key" type="text" class="mt-2 w-full"
                        v-model="configuration.sms_country_auth_key" autofocus />
                    <InputError class="mt-2" v-if="errors && errors.sms_country_auth_key"
                        :message="errors.sms_country_auth_key[0]" />
                </div>
                <div class="mt-5">
                    <InputLabel for="sms_country_auth_token">Auth Token <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sms_country_auth_token" type="text" class="mt-2 w-full"
                        v-model="configuration.sms_country_auth_token" autofocus />
                    <InputError class="mt-2" v-if="errors && errors.sms_country_auth_token"
                        :message="errors.sms_country_auth_token[0]" />
                </div>
                <div class="mt-5">
                    <InputLabel for="sms_country_sender_id">Sender ID <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="sms_country_sender_id" type="text" class="mt-2 w-full"
                        v-model="configuration.sms_country_sender_id" autofocus />
                    <InputError class="mt-2" v-if="errors && errors.sms_country_sender_id"
                        :message="errors.sms_country_sender_id[0]" />
                </div>
            </div>
            <div class="mt-8" v-if="response_errors && response_errors.exception">
                <div class="bg-red-100 border rounded border-red-500 text-red-700 px-4 py-3">{{ response_errors.message }}
                </div>
            </div>
            <div class="mt-8" v-if="response && response.success">
                <div class="bg-green-100 border rounded border-green-500 text-green-700 px-4 py-3">{{ response.message }}
                </div>
            </div>
            <div class="flow-root mt-5 mb-2">
                <div class="float-right">
                    <ButtonRegular size="sm" color="primary" v-on:click="save_settings">Save Settings</ButtonRegular>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import ButtonRegular from '@/Components/Button.vue';
export default {
    components: {
        InputLabel,
        TextInput,
        InputError,
        ButtonRegular
    },
    props: {
        settings: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            configuration: {
                send_sms_via: '',
                sinch_plan_id: '',
                sinch_api_token: '',
                sinch_from_number: '',
                sms_country_auth_key: '',
                sms_country_auth_token: '',
                sms_country_sender_id: ''
            },
            category: 'sms_settings',
            is_valid: true,
            response: {},
            response_errors: {},
            errors: []
        }
    },
    methods: {
        save_settings() {
            this.$emit('save-settings', this.category, this.configuration);
        }
    },
    watch: {
        settings() {
            this.configuration = this.$merge_objects(this.configuration, this.settings);
        }
    },
    mounted() {
        this.$emit('get-settings', this.category);
    }
}
</script>
