<template>
	<div>
		<table class="min-w-full text-left text-sm font-light">
			<thead class="border-b font-medium dark:border-neutral-500">
				<tr>
					<th>Name</th>
					<th>Source</th>
					<th>Requested On</th>
					<th>Tags</th>
					<th>Phone number</th>
					<th>Package</th>
					<th>Email</th>
					<th>Status</th>
					<th>CC Agent</th>
					<th>Followup Date</th>
					<th>Response</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" :key="data.id" v-if="results && results.length">
					<td>
						{{ data.name }}
						<div v-if="data.is_registered" class="border border-primary py-1 px-2 rounded text-primary w-fit mt-1">
							Registered
						</div>
					</td>
					<td>{{ data.source }}</td>
					<td>{{ data.requested_on }}</td>
					<td>{{ data.tags }}</td>
					<td>{{ data.phone }}</td>
					<td>{{ data.package }}</td>
					<td>
						<div>{{ data.email }}</div>
						<div v-if="data.interests > 1" class="cursor-pointer border border-primary w-fit rounded-[50px] px-2 text-primary" v-on:click="$emit('set-search', data.email)">+{{ data.interests }}</div>
					</td>
					<td>{{ data.status_name }}</td>
					<td>
						<div v-if="data.agent">
							<div>{{ data.agent_name }}</div>
							<a href="javascript:void(0)" class="text-red-500 cursor-pointer" v-if="$has_capability('assign-agent')" v-on:click="$emit('assign-agent', data.id, data.agent)">Edit Agent</a>
							<div><a href="javascript:void(0)" class="text-red-500 cursor-pointer" v-if="$has_capability('assign-agent')" v-on:click="$emit('remove-agent', data.id, data.agent,data.agent_name)">Remove Agent</a></div>
						</div>
						<div v-else>
							<a href="javascript:void(0)" class="text-red-500 cursor-pointer" v-if="$has_capability('assign-agent')" v-on:click="$emit('assign-agent', data.id, data.agent)">Assign Agent</a>
						</div>
					</td>
					<td>
						<div>{{ data.followup_on }}</div>
					</td>
					<td>
						<div>{{ data.response }}</div>
					</td>
					<td>
						<ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('view-all-leads') || $has_capability('view-assigned-leads')" v-on:click="$emit('view', data.id)" class="block py-1 px-4 actions_icon">Details</a>
                                <a href="javascript:void(0)" v-if="$has_capability('edit-lead')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <div v-if="data.status">
                                	<a href="javascript:void(0)" v-if="$has_capability('delete-lead')" v-on:click="$emit('undisqualify', data)" class="block py-1 px-4 actions_icon">Qualify</a>
                                </div>
                                <div v-else>
                                	<a href="javascript:void(0)" v-if="$has_capability('delete-lead')" v-on:click="$emit('disqualify', data)" class="block py-1 px-4 actions_icon">Disqualify</a>
                                </div>
                            </div>
                          </template>
                        </ActionsDropdown>
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
	import ActionsDropdown from '@/Components/ActionsDropdown.vue';
	export default {
	  	props:{
			results: {
		  		type: Array,
		  		required: true,
			},
			meta: {
				type: Object,
				required: true,
			}
	  	},
		emits: ["view", "edit", "delete", "assign-agent", "set-search"],
	  	components:{
			ActionsDropdown,
	  	},
	  	data(){
			return {

			}
	  	},
	  	methods:{
	 
	  	},
	 	mounted(){

		},
	}
</script>
