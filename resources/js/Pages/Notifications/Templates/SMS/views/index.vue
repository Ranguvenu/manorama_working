<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="template" @close="close" @refresh="index"/>
        <Filters :show="show" :filters="filters" :notificationtypes="notificationtypes" @filter="index" @reset="reset"/>
        <TableView class="mt-5 mb-12" :results="result.data" @edit="edit" @delete="destroy"/>
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
        props: {
            notificationtypes: {
                type: Object,
                required: true,
            },
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
                template: 0
            }
        },
        methods:{
            toggle_filters(){
                this.show = !this.show
            },
            initialize(){
                return {
                    search: '',
                    status: 1,
                    type: '',
                    perpage: 10
                }
            },
            index(page = 1){
                let vm = this;
                axios.post('/notifications/template/sms/results?page='+page, vm.filters).then(response => {
                    vm.result = response.data;
                }).catch(error => {

                });
            },
            edit(template){
                this.template = template;
            },
            destroy(template){
                let vm = this;
                vm.$swal({
                    title: "",
                    text: `Are you sure you want to delete ${template.title} ?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Continue"
                }).then((response) => {
                    if(response.value) {
                        axios.delete("/notifications/template/sms/"+template.id+"/destroy").then( response => {
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
                });
            },
            close(){
                this.template = 0;
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
