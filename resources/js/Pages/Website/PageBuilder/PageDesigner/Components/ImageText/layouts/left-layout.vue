<template>
	<div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-6">{{data.title}}</div>
	<div class="flex md:flex-nowrap flex-wrap items-center imagetext">
		<video-player class="video-player w-full md:!w-1/2 rounded-[20px] overflow-hidden" v-if="(data && data.media_type == 'video')" :poster="data.image" :src="data.video"
			type="video/mp4" crossorigin="anonymous" playsinline controls :volume="0.6" v-on:click="open_modal" />
		<img v-if="(data && data.media_type == 'image')" :src="data.image" class="w-full mb-2 md:mx-auto md:w-1/2  " />
		<div class="md:pl-12 mb-2 w-full md:w-1/2" v-if="data && data.description">
			<div class="card-text ck-content" v-html="data.description"></div>
		</div>
	</div>
	<LightBox :show="show" :data="data" @close="close_modal"/>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'
import Modal from '@/Components/Modal.vue';
import LightBox from './light-box.vue';

export default defineComponent({
	components: {
		VideoPlayer,
		Modal,
		LightBox
	},
	props: {
		data: {
			type: Object,
			required: true
		},
	},
	data() {
		return {
			show: false,
		}
	},
	methods: {
		open_modal() {
			this.show = true;
		},
		close_modal(){
			this.show = false;
		}
	}
})
</script>

<style>
.vjs-big-play-button {
	margin: 186px;
	margin-inline-start: 240px;
	border: none;
	background: none;
}

.vjs-poster {
	background-size: cover;
}

.video-player {
	width: 100%;
}
</style>
