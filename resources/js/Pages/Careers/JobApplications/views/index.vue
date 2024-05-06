<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :results="result.data" @view-application="view_application" @update-status="update_status"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <ApplicationView :current="current" @close-application="current = 0"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';
import ApplicationView from '../show.vue';

export default{
    components:{
        Header,
        Pagination,
        TableView,
        Filters,
        ApplicationView
    },
    props:{
        job: {
            type: Object,
            required: true
        }
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
            current: 0
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
            axios.post(route('careers.job.applications.results', {page: page, job: vm.job.slug}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        update_status(application, status){
            let vm = this;
            axios.get(route('careers.application.status', {application: application, status: status})).then(response => {
                if(vm.result && vm.result.meta){
                    vm.index(vm.result.meta.current_page);
                }
            }).catch(error => {

            });
        },
        view_application(application){
            this.current = application;    
        },
        close(){
            this.current = 0;
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
