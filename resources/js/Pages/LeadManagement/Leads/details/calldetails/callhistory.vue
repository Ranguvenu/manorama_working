<template>
    <div>
        <div class="flow-root">
            <div class="text-sm font-semibold text-gray-700 float-left my-2">Call History</div>
            <a class="float-right h-8 px-4 m-2 bg-primary text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-medium text-xs tracking-widest float-right" href="javascript:void(0)" v-on:click="click_to_call(lead.caller, lead)">Click to Call</a>
        </div>
        <table class="min-w-full text-left text-sm font-light mt-2">
			<thead class="border-b font-medium dark:border-neutral-500">
				<tr>
					<th class="bg-rose-light">Collection Agent</th>
					<th class="bg-rose-light">Last Handled By</th>
					<th class="bg-rose-light">Created On</th>
                    <th class="bg-rose-light">Package</th>
					<th class="bg-rose-light">Status</th>
                    <th class="bg-rose-light">Response</th>
                    <th class="bg-rose-light">Callback On</th>
				</tr>
			</thead>
			<tbody>
                <tr v-for="(data, index) in history" :key="data.id" v-if="history && history.length">
                    <td>{{data.collection_agent}}</td>
                    <td>{{ data.last_handled }}</td>
                    <td>{{data.created_on}}</td>
                    <td>{{ data.package }}</td>
                    <td>{{data.status}}</td>
                    <td>{{data.response}}</td>
                    <td>{{data.callback_on}}</td>
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
import ButtonRegular from '@/Components/Button.vue';
import axios from 'axios';
export default{
    components:{
        ButtonRegular
    },
    props:{
        lead: {
            type: Object,
            required: true
        },
        history: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods: {
        click_to_call(phone, lead){
            let vm = this;
            let payload = {
                phone: phone,
            }
            axios.post(route('integrations.raalink.call', {interest: lead.id}), payload).then(response => {
                if(response.data.success){
                    window.open(response.data.url);
                }
            }).catch(error => {

            });
            // return "http://172.30.1.133/crmc2c.php?exten="+this.$page.props.auth.user.name+"&phone="+phone+"&profileId="+profile;
        }
    },
    mounted(){

    }
}
</script>
