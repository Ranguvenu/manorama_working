<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="job" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :results="result.data" :meta="result.meta" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';

export default{
    components:{
        Header,
        Pagination,
        TableView,
        Filters
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
            job: 0
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
            axios.post(route('careers.jobs.results', {page: page}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(job){
            this.job = job;
        },
        destroy(job){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${job.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete(route('careers.jobs.destroy', {job: job.id})).then( response => {
                        vm.index();
                    }).catch(error => {

                    });
                }
            });
        },
        close(){
            this.job = 0;
        },
        reset(){
            this.filters = this.initialize();
            this.index();
        }
    }, 
    mounted(){
        this.index();
    }
}
</script>
