<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="resource" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :results="result.data" :meta="result.meta" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
    import Header from './header.vue';
    import Pagination from '@/Components/Pagination.vue';
    import TableView from './table.vue';
    import Filters from '../filters/index.vue';
    import axios from 'axios';

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
                resource: 0
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
                axios.post('/content/resources/results?page='+page, vm.filters).then(response => {
                    vm.result = response.data;
                }).catch(error => {

                });
            },
            edit(resource){
                this.resource = resource;
            },
            destroy(resource){
                let vm = this;
                vm.$swal({
                    title: "",
                    text: `Are you sure you want to delete ${resource.title} ?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Continue"
                }).then((response) => {
                    if(response.value) {
                        axios.delete("/content/resources/"+resource.id+"/destroy").then( response => {
                            vm.index();
                        }).catch(error => {

                        });
                    }
                });
            },
            close(){
                this.resource = 0;
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
