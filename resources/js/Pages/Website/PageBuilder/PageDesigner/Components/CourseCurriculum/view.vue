<template>
	<div class="text-center text-zinc-800 md:text-[25px] text-[19px] font-semibold mb-8">{{ data.title }}</div>
	<div class="md:w-3/4 custom_md:w-full md:mx-auto w-full">
		<div class="flex flex-wrap items-center justify-between mb-2">
			<div class="flex text-zinc-800 text-base font-medium ">
				<div class="mr-6">{{ data.days }}</div>
				<div class="mr-6">{{ data.hours }}</div>
			</div>
			<div class="sm:w-auto w-full text-right">
				<a href="javascript:void(0)" @click.prevent="toggleExpandAll"
					class="text-rose-500 text-base font-medium">{{ expandalltext }}</a>
			</div>
		</div>
		<div v-for="(item, index) in data.items" :key="index"
			class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
			<div @click="toggleAccordion(index)" role="button" :aria-expanded="isOpen[index]"
				:aria-controls="'day' + index + 'collapse'"
				class="flex justify-between items-center md:py-4 py-3 transition duration-150 ease-in-out cursor-pointer">
				<div class="text-zinc-700 text-sm font-semibold">{{ item.title }}</div>
				<div>
					<ChevronDownIcon class="h-6 w-6 text-zinc-700" :class="{ 'transform rotate-180': isOpen[index] }"
						aria-hidden="true" />
				</div>
			</div>
			<div :class="{ 'hidden': !isOpen[index] }" :id="'day' + index + 'collapse'" data-te-collapse-item>
				<div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed ck-content"
					v-html="item.description">
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";

export default {
	components: {
		ChevronDownIcon,
	},
	props: {
		data: {
			type: Object,
			required: true,
		},
	},
	data() {
		const isOpen = Array(this.data.items.length).fill(false);
		return {
			isOpen,
			expandalltext: 'Expand all',
		};
	},
	methods: {
		toggleAccordion(index) {
			this.isOpen[index] = !this.isOpen[index];
		},
		toggleExpandAll() {
			const isAllExpanded = this.isOpen.every((item) => item);
			this.isOpen = this.isOpen.map(() => !isAllExpanded);
			this.expandalltext = isAllExpanded ? 'Expand all' : 'Collapse all';

		},
	},
};
</script>
