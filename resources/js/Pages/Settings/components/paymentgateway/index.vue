<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight">
            Payment Gateway
        </div>
        <div class="ms-1">
            <div class="mt-3">
                <InputLabel for="send_sms_via"
                    >Active Payment Gateway
                    <span class="text-red-400">*</span></InputLabel
                >
                <select
                    style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                    id="send_sms_via"
                    class="mt-1 block w-full border-0.5"
                    v-model="configuration.paymentgateway"
                >
                    <option value="">Select</option>
                    <option value="razorpay">Razor Pay</option>
                </select>
                <InputError
                    class="mt-2"
                    v-if="errors && errors.paymentgateway"
                    :message="errors.paymentgateway[0]"
                />
            </div>
            <div class="border border-2 rounded mt-5 p-4">
                <div
                    class="font-semibold text text-gray-800 leading-tight"
                    style="font-size: 14px"
                >
                    Razor Pay Configuration
                </div>
                <div class="mt-3">
                    <InputLabel for="razor_key_id"
                        >Razor Pay Key Id
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="razor_key_id"
                        type="text"
                        class="mt-2 w-full"
                        v-model="configuration.payment_razorpay_key_id"
                        autofocus
                        autocomplete="host"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.payment_razorpay_key_id"
                        :message="errors.payment_razorpay_key_id[0]"
                    />
                </div>
                <div class="mt-5">
                    <InputLabel for="razor_key_secret"
                        >Razor Pay Key Secret
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="razor_key_secret"
                        type="text"
                        class="mt-2 w-full"
                        v-model="configuration.payment_razorpay_key_secret"
                        autofocus
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.payment_razorpay_key_secret"
                        :message="errors.payment_razorpay_key_secret[0]"
                    />
                </div>
                <div class="flow-root mt-5 mb-2">
                    <div class="float-right">
                        <ButtonRegular
                            size="sm"
                            color="primary"
                            v-on:click="save_settings"
                            >Save Settings</ButtonRegular
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ButtonRegular from "@/Components/Button.vue";
export default {
    components: {
        InputLabel,
        TextInput,
        InputError,
        ButtonRegular,
    },
    props: {
        settings: {
            type: Object,
            required: false,
        },
    },
    data() {
        return {
            configuration: {
                paymentgateway: "",
                payment_razorpay_key_id: "",
                payment_razorpay_key_secret: "",
            },
            category: "paymentgateway_settings",
            is_valid: true,
            response: {},
            response_errors: {},
            errors: [],
        };
    },
    methods: {
        save_settings() {
            this.$emit("save-settings", this.category, this.configuration);
        },
    },
    watch: {
        settings() {
            this.configuration = this.$merge_objects(
                this.configuration,
                this.settings
            );
        },
    },
    mounted() {
        this.$emit("get-settings", this.category);
    },
};
</script>
