<template>
	<div class="text-zinc-800 text-[22px] sm:text-[25px] font-semibold mb-4">{{ data.title }}</div>
	<Carousel v-bind="settings" :breakpoints="breakpoints" class="client-carousel">
		<Slide class=" rounded-[11px] mt-2" v-for="(item, index) in data.items">
			<div class="item flex">
				<div>
					<img :src="item.logo" class="m-auto" />
				</div>
			</div>
		</Slide>
		<template #addons>
			<div v-if="data.navigation" class="nav_left hidden sm:flex">
				<Navigation class="nav_alignment" />
			</div>
			<Pagination class="client-carousel" v-if="data.pagination" />
		</template>
	</Carousel>
</template>

<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

export default {
	name: 'Basic',
	components: {
		Carousel,
		Slide,
		Pagination,
		Navigation,
	},
	data: () => ({
		settings: {
			itemsToShow: 1,
			snapAlign: 'center',
			itemsToScroll: '1'
		},
		// breakpoints are mobile first
		// any settings not specified will fallback to the carousel settings
		breakpoints: {
			// 300 and up
			300: {
				itemsToShow: 3.25,
				snapAlign: 'left',
				itemsToScroll: 1
			},
			640: {
				itemsToShow: 3.25,
				snapAlign: 'left',
				itemsToScroll: 1
			},
			// 768 and up
			768: {
				itemsToShow: 4.25,
				snapAlign: 'start',
				itemsToScroll: 4
			},
			// 1024 and up
			1024: {
				itemsToShow: 5.25,
				snapAlign: 'left',
				itemsToScroll: 5

			}
		},
	}),

	props: {
		data: {
			type: Object,
			required: true
		}
	},
}
</script>

<style>
.client-carousel .carousel__pagination {
	margin: 40px 0 0;
}

.client-carousel .carousel__viewport {
	padding-top: 35px;
}

.carousel__item {
	min-height: 100px;
	width: 100%;
	color: var(--vc-clr-white);
	font-size: 20px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.carousel__slide {
	padding-top: 50px;
	padding-inline: 10px;
}

.carousel__icon {
	width: 32px;
	height: 32px;
}

.carousel__next {
	right: 10px;
}

.carousel__prev {
	right: 65px !important;
	left: inherit !important;
}

.carousel__prev,
.carousel__next {
	position: absolute !important;
	width: 40px !important;
	height: 40px !important;
	top: -30px !important;
	background-color: #FEF5F8 !important;
	border-radius: 50% !important;
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	color: #ED396C !important;
	font-size: 18px !important;
	cursor: pointer !important;
}

.kpcarousel .carousel__prev,
.kpcarousel .carousel__next {
	top: -15px !important;
}
</style>

