<template>
    <div>
        <Header class="mb-5" :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="author" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result.meta" @pagechange="index"/>
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
            author: 0
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
            axios.post('/blog/author/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(author){       
   
            this.author = author;
            
        },
        destroy(author){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${author.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
         
                    axios.get("/blog/author/"+author.id+"/existingauthor").then(response => {
                   if(response.data.data.length != 0 ){
                            vm.$swal({
                        title: "",
                        text: `${author.name} is already in use !`,
                        icon: "warning",
                        showCancelButton: false,
                    });   

                }  else{
                    axios.delete("/blog/author/"+author.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                    }).catch(error => {
                           this.$toast.error(error.response.data.message, {                        
                            position: 'bottom-right'                   
                        });

                    });

                }
            }).catch(error => {

            });
        }

            });
    

        },
        close(){
            this.author = 0;
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
