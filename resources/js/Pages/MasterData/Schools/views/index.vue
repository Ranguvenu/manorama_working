<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="school" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy" @view = "view_details"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <ViewDetails :details="details"  @hide="details = 0"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import ViewDetails from './details.vue';
import Filters from '../filters/index.vue';

export default{
    components:{
        Header,
        Pagination,
        TableView,
        Filters,
        ViewDetails
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
            school: 0,
            details: 0,
        
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
            axios.post('/masterdata/schools/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(school){
            this.school = school;
        },
        view_details(school){
           
            this.details = school;
        },
        destroy(school){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${school.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/masterdata/schools/"+school.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete School', {                        
                        position: 'bottom-right'
                    });

                    });
                }
            });
        },
        close(){
            this.school = 0;
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
