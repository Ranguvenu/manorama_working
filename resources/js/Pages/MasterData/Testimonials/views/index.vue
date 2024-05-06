<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="testimonial" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';

// import axios from 'axios';

export default{
    components:{
        Pagination,
        TableView,
        Filters,
        Header,
    },
    data(){
        return {
            filters: this.initialize(),
            show: false,
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            testimonial: 0
        }
    },
    methods:{
        toggle_filters(){
            this.show = !this.show
        },
        initialize(){
            return {
                search: '',
                perpage: 10
            }
        },
        index(page = 1){
            let vm = this;
            axios.post('/masterdata/testimonials/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {
            });
        },
        edit(testimonial){
            this.testimonial = testimonial;
        },
        destroy(testimonial){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${testimonial.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/masterdata/testimonials/"+testimonial.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                            position: 'bottom-right',                   
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Testimonials', {                        
                            position: 'bottom-right'
                        });

                    });
                }
            });
        },
        close(){
            this.testimonial = 0;
        },
        reset(){
            this.filters = this.initialize();
        }
    },
    
    mounted(){
        this.index();
    }
}
</script>
