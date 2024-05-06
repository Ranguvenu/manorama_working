<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @view-history="view_history"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <ViewHistory :history="history" @close="close_history"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';
import ViewHistory from "./history.vue";

export default{
    components:{
        Pagination,
        TableView,
        Header,
        Filters,
        ViewHistory
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
            history: {}
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
            axios.post('/notifications/logs/email/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;

            }).catch(error => {
            });
        },
        close_history(){
            this.history = {};
        },
        view_history(data){
            this.history = data;
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
