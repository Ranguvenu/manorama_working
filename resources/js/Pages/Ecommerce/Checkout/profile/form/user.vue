<template>
    <div class="w-full bg-white rounded-lg border-b-4 border-neutral-200 px-4 pt-6 pb-3">
        <div class="flex flex-wrap flex-row">
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">First Name</div>
                <div class="text-black text-sm font-medium">{{ profile.firstname }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">Last Name</div>
                <div class="text-black text-sm font-medium">{{ profile.lastname }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-6">
                <div class="text-gray-600 text-sm mb-1">Email</div>
                <div class="text-black text-sm font-medium">{{ profile.email }}</div>
            </div>
        </div>
        <div class="flex flex-wrap flex-row rounded-md">
            <div class="sm:w-1/3 w-full flex flex-col mb-6">
                <div class="text-gray-600 text-sm mb-1">Phone</div>
                <div class="text-black text-sm font-medium">{{ profile.phone_number }}</div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        profile: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods: {

    },
    mounted(){

    }
}
</script>