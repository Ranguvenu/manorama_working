<template>
    <div>
        <Header :filters="filters" @filter="index"  @reset="reset" @show-filters="toggle_filters" :current="role" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Filters from '../filters/index.vue';
import Header from './header.vue';
export default{
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
            role: 0
        }
    },
    methods:{
        initialize(){
            return {
                search: '',
                perpage: 10
            }
        },
        toggle_filters(){
            this.show = !this.show
        },
        index(page = 1){
            let vm = this;
            axios.post('/users/roles/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(role){
            this.role = role;
        },
        destroy(role){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${role.fullname} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/users/roles/"+role.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                            position: 'bottom-right'                   
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Role', {                        
                            position: 'bottom-right'                   
                        });                        

                    });
                }
            });
        },
        close(){
            this.role = 0;
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
