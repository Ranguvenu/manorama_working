<template>
    <div class="w-full bg-white rounded-lg border-b-4 border-neutral-200 px-4 pt-6 pb-3">
        <div class="flex flex-wrap flex-row">
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">Address Line 1</div>
                <div class="text-black text-sm font-medium">{{ profile.address }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">Address Line 2</div>
                <div class="text-black text-sm font-medium">{{ profile.address2 }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-6">
                <div class="text-gray-600 text-sm mb-1">Country</div>
                <div class="text-black text-sm font-medium">{{ profile.country_name }}</div>
            </div>
        </div>
        <div class="flex flex-wrap flex-row rounded-md">
            <div class="sm:w-1/3 w-full flex flex-col mb-6">
                <div class="text-gray-600 text-sm mb-1">State</div>
                <div class="text-black text-sm font-medium">{{ profile.state_name }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-6">
                <div class="text-gray-600 text-sm mb-1">City</div>
                <div class="text-black text-sm font-medium">{{ profile.city }}</div>
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