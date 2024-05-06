<template>
    <div>
        <Header :filters="filters" @filter="index"  @reset="reset" @show-filters="toggle_filters" @close="close" @refresh="index"/>
        <Filters :show="show" :data="data" :filters="filters" @filter="index" @reset="reset"/>
        <TableView class="mt-5" :results="result.data" @destroy="destroy"/>
        <Pagination v-if="result && result.meta" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from "./table.vue";
import Filters from "../filters/index.vue";
import Header from "./header.vue";

export default{
    components:{
        TableView,
        Filters,
        Pagination,
        Header
    },
    props:{
        data:{
            type:Object,
            required:false,
        }
    },

    data(){
        return{
            result: {
                data: [],
                meta: [],
                links: []
            },
            filters: this.initialize(),
            show: false
        }
    },
    methods: {
        toggle_filters(){
            this.show = !this.show
        },
        initialize(){
            return {
                search: '',
                perpage: 10,
                author: '',
                status:'',
      
            }
        },
        index(page=1){
            let vm = this;
            axios.post('/website/pages/results?page='+page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        destroy(page){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete the page ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete(route('website.pages.destroy', {page: page})).then(response => {
                        this.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                        vm.index();
                    }).catch(error => {

                    });
                }
            });
        },
        close(){
            this.college = 0;
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
