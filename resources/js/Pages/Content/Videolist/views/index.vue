<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" :current="videolist" @close="close" @refresh="index"/>
          <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
export default{
    components:{
        Header,
        Pagination,
        TableView,
     
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
            videolist: 0
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
            axios.post('/content/videolist/results?page='+page, vm.filters).then(response => {
                console.log(response.data);
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(videolist){  
            this.videolist = videolist;            
        },
        destroy(videoslist){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${videoslist.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/content/videolist/"+videoslist.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Video List', {                        
                        position: 'bottom-right'                   
                    });

                    });
                }
            });
        },
        close(){
            this.videolist = 0;
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
