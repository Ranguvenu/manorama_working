<template>
    <component :is="data.layout" :data="data" :testimonials="testimonials"></component>
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
            testimonials: {
                data: [],
                meta: []
            },
            filters: {
                perpage: this.data.perpage ? this.data.perpage : 10,
                package: this.data.package ? this.data.package : 0
            }
        }
    },
    methods: {
        index(page=1){
            let vm = this;
            axios.post(route('website.components.index', {component: 'testimonials', page: page}), vm.filters).then((response) => {
                if(page == 1){
                    vm.testimonials = response.data;
                }else{
                    if(response.data.data.length){
                        response.data.data.forEach((value, index) => {
                            vm.testimonials.data.push(value)
                        });
                        vm.testimonials.meta = response.data.meta;
                    }
                }
            }).catch(error => {

            });
        },
    },
    watch:{
        "data.perpage": function(){
            this.filters.perpage = this.data.perpage;
            this.index();
        },
        "data.package": function(){
            this.filters.package = this.data.package;
            this.index();
        }
    },
    mounted() {
        this.index();
    }
}
</script>
