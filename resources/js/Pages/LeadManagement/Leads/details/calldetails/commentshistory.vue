<template>
    <div>
        <div class="flow-root">
            <div class="text-sm font-semibold text-gray-700 float-left my-2">Comments History</div>
            <AddResponse :lead="lead" @refresh="$emit('refresh')"></AddResponse>
        </div>
        <table class="min-w-full text-left text-sm font-light mt-2">
			<thead class="border-b font-medium dark:border-neutral-500">
				<tr>
					<th class="bg-rose-light">Collection Agent</th>
					<th class="bg-rose-light">Last Handled By</th>
					<th class="bg-rose-light">Created On</th>
					<th class="bg-rose-light">Status</th>
                    <th class="bg-rose-light">Response</th>
                    <th class="bg-rose-light">Callback On</th>
				</tr>
			</thead>
			<tbody>
                <tr v-for="(data, index) in comments" :key="data.id" v-if="comments && comments.length">
                    <td>{{data.collection_agent}}</td>
                    <td>{{ data.last_handled }}</td>
                    <td>{{data.created_on}}</td>
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
import AddResponse from './addresponse.vue';
export default{
    components:{
        AddResponse
    },
    props:{
        lead: {
            type: Object,
            required: true
        },
        comments: {
            type: Array,
            required: true,
        },
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
