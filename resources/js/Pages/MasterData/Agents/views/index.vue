<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="agent" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5 mb-12" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
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
                agent: 0
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
                axios.post('/masterdata/agents/results?page='+page, vm.filters).then(response => {
                    vm.result = response.data;
                }).catch(error => {

                });
            },
            edit(agent){
                this.agent = agent;
            },
            destroy(agent){
                let vm = this;
                vm.$swal({
                    title: "",
                    text: `Are you sure you want to delete ${agent.name} ?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Continue"
                }).then((response) => {
                    if(response.value) {
                        axios.delete("/masterdata/agents/"+agent.id+"/destroy").then( response => {
                            vm.index();
                            this.$toast.success(response.data.message, {                        
                            position: 'bottom-right'                   
                            });
                        }).catch(error => {
                            this.$toast.error('Failed to Delete Agent', {                        
                                position: 'bottom-right'                   
                            });
                        });
                    }
                });
            },
            close(){
                this.agent = 0;
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
