<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="college" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <CardsView class="mt-5" :results="result.data" @view="view" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <ViewDetails :details="details" @hide="details = 0"/>
    </div>
</template>
<script>
    import Header from './header.vue';
    import Pagination from '@/Components/Pagination.vue';
    import CardsView from './cards.vue';
    import Filters from '../filters/index.vue';
    import ViewDetails from './details.vue';
    export default{
        components:{
            Header,
            Pagination,
            CardsView,
            Filters,
            ViewDetails,
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
                college: 0,
                details: 0
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
                axios.post('/masterdata/colleges/results?page='+page, vm.filters).then(response => {
                    vm.result = response.data;
                }).catch(error => {

                });
            },
            view(college){
                this.details = college;
            },
            edit(college){
                this.college = college;
            },
            destroy(college){
                let vm = this;
                vm.$swal({
                    title: "",
                    text: `Are you sure you want to delete ${college.name} ?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Continue"
                }).then((response) => {
                    if(response.value) {
                        axios.delete("/masterdata/colleges/"+college.id+"/destroy").then( response => {
                            vm.index();
                            this.$toast.success(response.data.message, {                        
                                 position: 'bottom-right'                   
                            });
                        }).catch(error => {
                                this.$toast.error('Failed to Delete College', {                        
                                    position: 'bottom-right'                   
                                });
                        });
                    }
                });
            },
            close(){
                this.college = 0;
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
