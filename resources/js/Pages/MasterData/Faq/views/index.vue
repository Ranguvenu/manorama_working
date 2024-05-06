<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="faq" @close="close" @refresh="index"/>
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
            faq: 0
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
            axios.post('/masterdata/faq/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(faq){       
   
            this.faq = faq;
            
        },
        destroy(faq){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${faq.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/masterdata/faq/"+faq.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Faq', {                        
                        position: 'bottom-right'                   
                    });

                    });
                }
            });
        },
        close(){
            this.faq = 0;
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
