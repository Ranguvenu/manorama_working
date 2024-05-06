<template>
    <div>
        <div class="font-semibold text text-gray-800 leading-tight">
            Theme Settings
        </div>
        <div class="ms-1">
            <div class="mt-3">
                <InputLabel for="theme_ga_code"
                    >Google Analytics Tracking Code
                    <span class="text-red-400">*</span></InputLabel
                >

                <TextInput
                    id="theme_ga_code"
                    type="text"
                    class="mt-2 w-full"
                    v-model="configuration.theme_ga_code"
                    autofocus
                    autocomplete="host"
                />
                <InputError
                    class="mt-2"
                    v-if="errors && errors.theme_ga_code"
                    :message="errors.theme_ga_code[0]"
                />
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3 border-2 p-3">
                        <div class="sm:col-span-12  ">
                    <InputLabel for="theme_facebook"
                         class = "font-semibold text text-gray-800 leading-tight">Social Media
                        </InputLabel
                    >
                    </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_facebook"
                        >Facebook
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_facebook"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_facebook"
                        autofocus
                        autocomplete="host"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_facebook"
                        :message="errors.theme_facebook[0]"
                    />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_instagram"
                        >Instagram
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_instagram"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_instagram"
                        autofocus
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_instagram"
                        :message="errors.theme_instagram[0]"
                    />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_youtube"
                        >Youtube <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_youtube"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_youtube"
                        autofocus
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.theme_youtube"
                        :message="errors.theme_youtube[0]"
                    />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_linkedin"
                        >LinkedIn
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_linkedin"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_linkedin"
                        autofocus
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.theme_linkedin"
                        :message="errors.theme_linkedin[0]"
                    />
                </div>
                <div class="sm:col-span-12">
                    <InputLabel for="theme_pininterest"
                        >PinInterest
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_pininterest"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_pininterest"
                        autofocus
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_pininterest"
                        :message="errors.theme_pininterest[0]"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3 border-2 p-3">
                <div class=" sm:col-span-6">
                    <InputLabel for="theme_secondaryfooter_content"
                        >Secondary Footer Content
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextArea
                        id="theme_secondaryfooter_content"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        v-model = "configuration.theme_secondaryfooter_content"
                        autocomplete="theme_secondaryfooter_content"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_secondaryfooter_content"
                        :message="errors.theme_secondaryfooter_content[0]"
                    />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_contactemail"
                        >Contact Email
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_contactemail"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_contactemail"
                        autofocus
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_contactemail"
                        :message="errors.theme_contactemail[0]"
                    />
                </div>
                <div class="sm:col-span-12">
                    <InputLabel for="theme_contactphone"
                        >Contact Phone
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="theme_contactphone"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="configuration.theme_contactphone"
                        autofocus
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.theme_contactphone"
                        :message="errors.theme_contactphone[0]"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12  mt-3 border-2 p-3">
                        <div class="sm:col-span-12  ">
                    <InputLabel for="theme_logo"
                         class = "font-semibold text text-gray-800 leading-tight">Logo
                        </InputLabel
                    >
                    </div>
                <div class="sm:col-span-6">
                    <InputLabel for="theme_websitelogo">Website Logo</InputLabel>
                    <MediaButton class="mt-1" accepts="png,jpeg,jpg,svg,webp" component="articles" name="Upload Website Logo"
                        :multiple="false" return_type="url" v-model="configuration.theme_websitelogo" />
                    <small class="text-gray-600">Note: Image should be in .png, .jpeg, .jpg, .svg or .webp format.</small>  
                    <InputError class="mt-1" v-if="errors && errors.theme_websitelogo" :message="errors.theme_websitelogo[0]" />
                </div>
                      <div class="sm:col-span-6">
                    <InputLabel for="theme_mobilelogo">Mobile Logo</InputLabel>
                    <MediaButton class="mt-1" accepts="png,jpeg,jpg,svg,webp" component="articles" name="Upload Mobile Logo"
                        :multiple="false" return_type="url" v-model="configuration.theme_mobilelogo" />
                    <small class="text-gray-600">Note: Image should be in .png, .jpeg, .jpg, .svg or .webp format.</small>  
                    <InputError class="mt-1" v-if="errors && errors.theme_mobilelogo" :message="errors.theme_mobilelogo[0]" />
                </div>
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
</template>
<script>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ButtonRegular from "@/Components/Button.vue";
import MediaButton from "@/Components/MediaButton.vue";
import TextArea from "@/Components/TextArea.vue";
export default {
    components: {
        InputLabel,
        TextInput,
        InputError,
        ButtonRegular,
        MediaButton,
        TextArea
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
                theme_ga_code: "",
                theme_facebook: "",
                theme_instagram: "",
                theme_youtube: "",
                theme_linkedin: "",
                theme_pininterest: "",
                theme_secondaryfooter_content: "",
                theme_contactemail: "",
                theme_contactphone: "",
                theme_websitelogo: "",
                theme_mobilelogo: "",

            },
            category: "theme_settings",
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
