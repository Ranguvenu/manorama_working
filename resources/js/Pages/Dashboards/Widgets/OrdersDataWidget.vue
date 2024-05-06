<template lang="">
    <div class="m-2">
        <h4 class="text-lg font-semibold mb-3">Orders</h4>
        <div class="rounded-md overflow-hidden">
            <table class="table widget-table rounded">
                <thead>
                    <tr>
                        <th class="">Orders</th>
                        <th class="">Amount</th>
                        <th class="">Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in data" :key ="index">
                        <td class="">
                            <div>
                                <div class="font-semibold mb-1">{{ order.fullname }}</div>
                                <div class="text-xs">{{ order.packagename }}, {{ order.courses }}</div>
                                <div class="text-xs">Order ID: {{ order.orderid }}</div>
                            </div>
                        </td>
                        <td class="">
                            <div class="font-bold"><span>&#x20B9</span> <span>{{ order.amount }}</span></div>
                        </td>
                        <td class="text-secondary">{{ order.created_at }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue';

export default {
    data(){
        return {
            data:{},
        }
    },
    methods:{
        index(){
            let vm = this;
            axios.get(route('reports.orders')).then( (response) => {
                vm.data = response.data.data;
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.index();
    }
}
</script>
<style lang="">

</style>
