<template>
    <div v-if="$has_capability('view-'+taxonomy.slug)">
        <Header :filters="filters" @filter="index"  @reset="reset" @show-filters="toggle_filters" :taxonomy="taxonomy" :current="category" @close="close" @refresh="index"/>
        <!-- <Filters :taxonomy="taxonomy" :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView :taxonomy="taxonomy" class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Filters from '../filters/index.vue';
import Header from './header.vue';
import axios from 'axios';

export default{
    props:{
        taxonomy: {
            type: Object,
            required: true
        }
    },
    components:{
        Pagination,
        TableView,
        Filters,
        Header
    },

    data(){
        return {
            filters: this.initialize(),
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            show: false,
            category: 0
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
            axios.post("/masterdata/categories/"+vm.taxonomy.slug+"/results?page="+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(category){
            this.category = category;
        },
        destroy(category){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${category.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value){
                const responsevalue = response;
                axios.get("/masterdata/categories/"+vm.taxonomy.slug+"/"+category.id+"/existingcategory").then(response => {
                   if(response.data.data.length != 0 ){
                            vm.$swal({
                        title: "",
                        text: `${vm.taxonomy.name} : ${category.name} is already in use !`,
                        icon: "warning",
                        showCancelButton: false,
                    });                    
               
                   } else{
                       if(responsevalue.value) {                
                    
                            axios.delete("/masterdata/categories/"+vm.taxonomy.slug+"/"+category.id+"/destroy").then( response => {
                                vm.index();
                                this.$toast.success(response.data.message, {                        
                                position: 'bottom-right'                   
                            });

                            }).catch(error => {
                                this.$toast.error('Failed to Delete' + ' '+ vm.taxonomy.slug + ' '+ 'Category', {                        
                                position: 'bottom-right'                   
                            });

                            });
                        }                

                   }  

                }).catch(error => {

                });
            }


 
            });
        },
        toggle_filters(){
            this.show = !this.show
        },
        close(){
            this.category = 0;
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
