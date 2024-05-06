<template>
    <component :is="data.layout" :data="data"></component>
</template>
<script>
import GridLayout from './layouts/grid-layout.vue';
import CarouselLayout from './layouts/carousel-layout.vue';
export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {
        GridLayout,
        CarouselLayout
    },
    data() {
        return {

        }
    },
    methods: {
    },
    mounted() {
    },
    computed: {

    }
}
</script>
