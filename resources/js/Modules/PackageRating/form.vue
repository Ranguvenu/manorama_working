<template>
    <div class="packagereview">
        <div class="flex items-center py-4 border-b border-zinc-100">
            <img v-if="$page.props.auth.user.avatar?.url" :src="$page.props.auth.user.avatar?.url"
                alt="Profile Picture of {{ $page.props.auth.user.name }}"
                class="w-14 h-14 rounded-full mr-4 rounded-full">
            <img v-else src="/images/profile/profile.png" alt="Profile Picture of {{ $page.props.auth.user.name }}"
                class="w-14 h-14 rounded-full mr-4 rounded-full">
            <div class="text-black">
                <p class="text-[15px] font-medium mb-1">{{ $page.props.auth.user.fullname }}</p>
                <div class="flex">
                    <p class="text-[13px] font-light">Posting Publicly</p>
                    <img src="/images/profile/info2.png" class="w-3 h-3 ms-2 mt-1"/>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="w-full flex justify-center items-center my-6 rating_wrap">
                <div class="m-auto rating-container">
                    <vue3-star-ratings starSize="28" inactiveColor="#d6d6d6" :disableClick="false" starColor="#FFC107" v-model="data.rating"/>
                </div>
            </div>
            <div class="w-full mb-6">
                <TextArea id="review" type="text" v-model="data.review"
                    class="bg-white rounded-[5px] border border-stone-300 h-[120px] block w-full mt-2" required autofocus
                    autocomplete="review" placeholder="Share details of your own experience"/>
                <InputError class="mt-2" v-if="errors && errors.review" :message="errors.review[0]" />
            </div>
            <div class="flex justify-end items-center">
                <div>
                    <a class="px-[30px] py-2.5 border border-rose-500 rounded-lg text-rose-600 text-[15px] font-semibold cursor-pointer" v-on:click="$emit('cancel')">Cancel</a>
                </div >
                <div class="ml-4">
                    <a class="px-[30px] py-2.5 bg-rose-600 rounded-lg text-zinc-100 text-[15px] font-semibold cursor-pointer" v-if="!current" v-on:click="$emit('submit')">Submit</a>
                </div>
                <div class="ml-4">
                    <a class="px-[30px] py-2.5 bg-rose-600 rounded-lg text-zinc-100 text-[15px] font-semibold cursor-pointer" v-if="current" v-on:click="$emit('update', data.id)">Update</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import vue3StarRatings from "vue3-star-ratings";

export default {
    components: {
        Modal,
        InputLabel,
        InputError,
        TextInput,
        TextArea,
        "vue3-star-ratings": vue3StarRatings
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            required: true
        },
        current: {
            type:Number,
            required: true
        }
    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>
