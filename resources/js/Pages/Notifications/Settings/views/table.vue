<template>
    <div>
        <table class="min-w-full text-left text-sm font-light table-auto">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Notification Type</th>
                    <th>Method</th>
                    <th>Recipients</th>
                    <th>Template</th>
                    <th>From Address</th>
                    <th>From Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" v-if="results && results.length">
                    <td class="">{{ data.title }}</td>
                    <td class="">{{ data.method }}</td>
                    <td class="" v-html="from_address(data.recipient)"></td>
                    <td class="">{{ data.template_name }}</td>
                    <td class="" v-html="from_address(data.from_address)"></td>
                    <td class="">{{ data.from_name }}</td>
                    <td>
                        <a href="javascript:void(0)" v-on:click="$emit('view-history', data)">
                            <ButtonOutline class="text-base font-semibold" size="sm" v-on:click="$emit('manage', data)">Manage</ButtonOutline>
                        </a>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import ButtonOutline from "@/Components/ButtonOutline.vue";
    import { ClockIcon } from "@heroicons/vue/24/outline";
    export default{
        props:{
            results: {
                type: Array,
                required: true
            },
            meta: {
                type: Object,
                required: true
            }
        },
        components:{
            ClockIcon,
            ButtonOutline
        },
        data(){
            return{

            }
        },
        methods:{
          from_address(address){
            return String(address).split(",").join("<br>");
          }
        },
        mounted(){

        }
    }
</script>
