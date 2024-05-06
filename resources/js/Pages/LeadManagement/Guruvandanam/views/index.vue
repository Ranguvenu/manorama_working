<template>
    <div>
        <Header :filters="filters" @filter="index" />
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :meta="result.meta" :results="result.data" />
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
 
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';


export default{
    components:{
        Header,
        Pagination,
        TableView,    
    },
    data(){
        return {
            filters: this.initialize(),
 
            result: {
               data: [],
               links: [],
               meta: [] 
            },
          
        
        }
    },
    methods:{
    
        initialize(){
            return {
                search: '',
                perpage: 10
            }
        },
        index(page = 1) {
            let vm = this;      
            axios.post('/guruvandanam/results?page='+page,vm.filters).then(response => {        
                    vm.result = response.data;             
            
          }).catch(error => {

          }); 

        },

       
    }, 
    mounted(){
        this.index();
    }
}
</script>
