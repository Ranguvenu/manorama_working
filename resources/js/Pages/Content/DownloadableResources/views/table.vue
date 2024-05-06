<template>
		<div>
			<table class="min-w-full text-left text-sm font-light">
				<thead class="border-b font-medium dark:border-neutral-500">
					<tr>
						<th>Title</th>
						<th>Valid From</th>
						<th>Valid To</th>
						<th>Resource Type</th>
						<th >Download</th>
						<th>Status</th>
						<th v-if="$has_capability('create-downloadable-resource')">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" :key="data.id" v-if="results && results.length">
						<td>{{ data.title }}</td>
						<td>{{ data.valid_from }}</td>
						<td>{{ data.valid_to }}</td>
						<td>{{ data.resource_type }}</td>
						<td>
							<span v-if="data.resource_url">
								<a :href="data.resource_url" target="__blank" class="cursor-pointer" title="Download"><ArrowDownTrayIcon class="ms-5 h-6 w-6 text-primary" /></a>
							</span>
							<span v-else>
								NA
							</span>
						</td>
						<td>{{ data.status }}</td>
						<td v-if="$has_capability('create-downloadable-resource')">
							<ActionsDropdown align="right">
								<template v-slot:content>
									<div class="divide-y border-lightestgrey">
										<a href="javascript:void(0)" v-if="$has_capability('edit-downloadable-resource')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
										<a href="javascript:void(0)" v-if="$has_capability('delete-downloadable-resource')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
	import { onMounted } from 'vue';
 	import ActionsDropdown from '@/Components/ActionsDropdown.vue';
	import { ArrowDownTrayIcon } from "@heroicons/vue/24/solid";
	export default {
		props: {
			results: {
				type: Array,
				required: true,
			},
			meta: {
                type: Object,
                required: true
            }
		},
		components: {
			ActionsDropdown,
			ArrowDownTrayIcon
		},
		data() {
			return {};
		},
		methods: {
			
		},
		mounted() {},
	};
</script>
