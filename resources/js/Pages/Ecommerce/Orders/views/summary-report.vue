<template>
    <div class="bg-white shadow-md p-4 rounded-lg border mb-3">
        <div class="flex items-center justify-between border-b pb-3">
            <h3 class="text-primary text-lg font-semibold">Top Selling Packages in Current Month</h3>
            <!-- <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md" >
                <option value="" >Current Month</option>
            </select> -->
        </div>
        <div class="flex py-3 w-full">
            <div class="flex flex-col text-white items-center justify-center rounded-[10px] bg-indigo-500 py-6 px-5 w-full md:mr-3 md:w-1/4">
                <span class="text-sm font-light text-gray-100 mb-2">Transactions Amount</span>
                <h3 class="text-4xl font-semibold">₹ {{ totalamount }}</h3>
                <div class="bg-indigo-400 w-full my-5 h-[1px]"></div>
                <span class="text-sm font-light text-gray-100 mb-2">Total Orders</span>
                <h3 class="text-4xl font-semibold">{{ totalorders }}</h3>
            </div>
            <div class="flex-grow-1 p-5 w-full md:w-3/4 rounded-[10px] bg-indigo-50/[0.5]">
                <div class="flex w-full items-center justify-center mb-3 border-b pb-2" v-for="(order, index) in summary.data" v-if="summary.data && summary.data.length">
                    <div class="w-16 h-16 flex-shrink-0 bg-indigo-400 rounded bg-no-repeat bg-center bg-cover mr-4" :style="{ 'background-image': 'url(' + order.thumbnail + ')' }"></div>
                    <h5 class="flex-grow-1 font-semibold mr-2 text-indigo-800">{{ order.title }}</h5>
                    <div class="w-1/6 ml-auto">
                        <div class="rounded-full bg-primary w-8 h-8 text-white flex items-center justify-center">{{ order.orders_count }}</div>
                    </div>
                </div>
                 <div v-else>
                    <div class="text-center">No Data Available</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            summary: {
               data: [],
            },
            totalamount: '',
            totalorders: '',
        }
    },
    methods:{
        index(){
            let vm = this;
            let payload = {};
            axios.post(route('reports.summary.transactions'), payload).then(response =>{
                vm.summary = response.data;
                vm.totalamount = response.data.totalamount;
                vm.totalorders = response.data.totalorders;
            }).catch(error => {

            });
        },
    },
    mounted(){
        this.index();
    }
}
</script>
