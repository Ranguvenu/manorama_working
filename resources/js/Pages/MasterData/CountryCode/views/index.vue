<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="countrycode" @close="close" @refresh="index"/>
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
        Header,
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
            countrycode: 0
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
            axios.post('/masterdata/countrycode/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
                console.log(vm.result);


            }).catch(error => {
            });
        },
        edit(countrycode){
            this.countrycode = countrycode;
        },
        destroy(countrycode){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${countrycode.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value){
                    const responsevalue = response;
                    axios.get("/masterdata/countrycode/"+countrycode.id+"/existingcode").then(response => {
                        if(response.data.data.length != 0 ){
                            vm.$swal({
                                title: "",
                                text: `The country ${countrycode.name} is already in use !`,
                                icon: "warning",
                                showCancelButton: false,
                            });                    
                        } else{
                            if(responsevalue.value) {                
                                axios.delete("/masterdata/countrycode/"+countrycode.id+"/destroy").then( response => {
                                    vm.index();
                                    this.$toast.success(response.data.message, {                        
                                        position: 'bottom-right'                   
                                    });
                                }).catch(error => {
                                    this.$toast.error('Failed to Delete Country Code', {                        
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
        close(){
            this.countrycode = 0;
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
