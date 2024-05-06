<template>
    <div>
        <Header @filter="index" :filters="filters" :type="type" @show-filters="toggle_filters" :current="user" @close="close" @refresh="index"/>
        <Filters :type="type" :show="show" :filters="filters" @filter="index" @reset="reset"/>
        <TableView class="mt-5" :meta="result.meta" :type="type" :results="result.data" @edit="edit" @view="view_details" @delete="destroy" @activate="activate"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <ViewDetails :user="view" :category="type" @hide="view = 0"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Filters from '../filters/index.vue';
import Header from './header.vue';
import ViewDetails from '../details/index.vue';

export default{
    components:{
        Pagination,
        TableView,
        Filters,
        Header,
        ViewDetails
    },
    props:{
        type: {
            type: Object,
            required: true
        }
    },
    emits: ["hide", "refresh"],
    data(){
        return {
            filters: this.initialize(),
            show: false,
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            user: 0,
            view: 0
        }
    },
    methods:{
        toggle_filters(){
            this.show = !this.show
        },
        initialize(){
            return {
                search: '',
                date: '',
                status: -1,
                type: '',
                perpage: 10
            }
        },
        index(page = 1){
            let vm = this;
            axios.post(route('users.type.results', {category: vm.type.slug, page: page}), vm.filters).then(response => {
            vm.result = response.data;
            }).catch(error => {

            });
        },
        view_details(user){
            this.view = user;
        },
        edit(user){
            this.user = user;
        },
        destroy(user){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${user.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete("/users/staff/"+user.id+"/destroy").then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Internalstaff', {                        
                        position: 'bottom-right'
                    });

                    });
                }
            });
        },
        close(){
            this.user = 0;
        },
        reset(){
            this.filters = this.initialize();
            this.index();
        },
        activate(userid){
            let vm = this;
            axios.get('/users/'+vm.type.slug+'/'+userid+'/activate').then(response => {
                vm.index();
                this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });          
               
            }).catch(error => {
                this.$toast.error('Failed to Activate User', {                        
                        position: 'bottom-right'
                    });

            });

        }
    },
    mounted(){
        this.index();
    }
}
</script>
