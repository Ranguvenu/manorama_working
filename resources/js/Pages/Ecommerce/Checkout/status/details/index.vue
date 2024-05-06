<template>
    <div class="w-full bg-white rounded border-b-4 border-neutral-200 px-4 pt-6 pb-3">
        <div class="text-black text-base font-semibold">Package Details</div>
        <div class="flex flex-wrap flex-row bg-gray-100 rounded-md px-6 py-8">
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">Course</div>
                <div class="text-black text-sm font-medium">{{ response.package }}</div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                <div class="text-gray-600 text-sm mb-1">Subjects</div>
                <div class="text-black text-sm font-medium"><span class="me-2" v-for="(subject, index) in response.subjects" :key="index">{{ subject }}</span></div>
            </div>
            <div class="sm:w-1/3 w-full flex flex-col mb-6" v-if="response.valid_till">
                <div class="text-gray-600 text-sm mb-1">Valid Till</div>
                <div class="text-black text-sm font-medium">{{ response.valid_till }}</div>
            </div>
        </div>
        <div class="mt-4 border-t border-gray-200">
            <div class="text-black text-base font-semibold mb-2 mt-3">Payment Details</div>
            <div class="flex flex-wrap flex-row rounded-md">
                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                    <div class="text-gray-600 text-sm mb-1">Payment Status</div>
                    <div class="text-green-600 text-sm font-medium">{{ response.status_name }}</div>
                </div>
                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                    <div class="text-gray-600 text-sm mb-1">Transaction ID</div>
                    <div class="text-black text-sm font-medium">{{ response.transaction_id }}</div>
                </div>
                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                    <div class="text-gray-600 text-sm mb-1">Transaction Date and Time</div>
                    <div class="text-black text-sm font-medium">{{ response.transaction_date }}</div>
                </div>
                <div class="sm:w-1/3 w-full flex flex-col mb-6" >
                    <div class="text-gray-600 text-sm mb-1">Total Amount</div>
                    <div class="text-black text-sm font-medium">₹{{ response.net_payable }}</div>
                </div>
                <div class="sm:w-1/3 w-full flex flex-col mb-6" v-if="response.status == 6">
                    <div class="text-gray-600 text-sm mb-1">Trial Expires On</div>
                    <div class="text-black text-sm font-medium">{{ response.expires_on }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        response: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>
