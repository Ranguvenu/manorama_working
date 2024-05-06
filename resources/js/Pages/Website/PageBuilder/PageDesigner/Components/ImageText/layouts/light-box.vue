<template>
	<Modal v-if="(data && data.player_mode == 'light-box')" :show="show" @close="$emit('close')">
		<span class="inline-block float-right">
			<div class="h-8 w-8 rounded-full cursor-pointer flex items-center justify-center bg-zinc-100 text-gray-400" v-on:click="$emit('close')">
				<svg class="h-4 w-4 " stroke="currentColor" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
			</div>
		</span>
		<video-player class="video-player my-10" :poster="data.image" :src="data.video" type="video/mp4" crossorigin="anonymous"
			playsinline autoplay controls :volume="0.6"/>
	</Modal>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { VideoPlayer } from '@videojs-player/vue';
import 'video.js/dist/video-js.css';
import Modal from '@/Components/Modal.vue';

export default defineComponent({
	components: {
		VideoPlayer,
		Modal
	},
	props: {
		data: {
			type: Object,
			required: true
		},
		show: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {

		}
	},
	methods: {
		
	}
})
</script>
