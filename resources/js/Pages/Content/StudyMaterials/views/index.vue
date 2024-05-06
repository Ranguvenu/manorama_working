<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="studymaterial" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <CardsView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import CardsView from './cards.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';

export default{
    components:{
        Header,
        Pagination,
        CardsView,
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
            studymaterial: 0
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
            axios.post('/content/studymaterial/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(studymaterial){       
           
   

            this.studymaterial = studymaterial;
            
        },
        destroy(studymaterial){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${studymaterial.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/content/studymaterial/"+studymaterial.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Study Material', {                        
                        position: 'bottom-right'                   
                    });

                    });
                }
            });
        },
        close(){
            this.studymaterial = 0;
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
