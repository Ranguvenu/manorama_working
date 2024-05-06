<template>
    <div>
        <Header :filters="filters" @filter="index" />
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <EditSapData :current="sapid" @close="close" @refresh="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import EditSapData from '../edit.vue';

export default{
    components:{
        Header,
        Pagination,
        TableView,
        EditSapData,    
    },
    data(){
        return {
            filters: this.initialize(),
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            sapid: 0,
        }
    },
    methods:{
        initialize(){
            return {
                search: '',
                perpage: 10
            }
        },
        index(page = 1){
            let vm = this;
            axios.post(route('integrations.sap.results', { page: page }), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(sapid){
            this.sapid = sapid;
        }, 
        close(){
            this.sapid = 0;
        },
    }, 
    mounted(){
        this.index();
    }
}
</script>
