<template>
    <div>
        <Header :filters="filters" @filter="index"  @reset="reset" @show-filters="toggle_filters" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5 mb-12" :meta="result.meta" :results="result.data"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result.meta" @pagechange="index"/>
    </div>
</template>
<script>
    import Header from './header.vue';
    import Pagination from '@/Components/Pagination.vue';
    import TableView from './table.vue';
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
                axios.post(route('contact.results', {page: page}), vm.filters).then(response => {
                    vm.result = response.data;
                }).catch(error => {

                });
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
