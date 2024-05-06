<template>
    <div>
        <Header :filters="filters" @filter="index" @reset="reset" @show-filters="toggle_filters" @close="close" @create-hierarchy="create_hierarchy" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <Cards @create-hierarchy="create_hierarchy" @delete-hierarchy="destroy" :data="result.data" :meta="result.meta" @refresh="index"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <HierarchyForm :show="hierarchy.show" :hierarchy="hierarchy" @close="close" @refresh="refresh"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import Cards from './cards.vue';
import Filters from '../filters/index.vue';
import Header from './header.vue';
import HierarchyForm from '../form.vue';
import axios from 'axios';

export default{
    components:{
        Pagination,
        Cards,
        Filters,
        Header,
        HierarchyForm
    },
    props: {
        hierarchies: {
            type: Object,
            required: false
        }
    },
    data(){
        return {
            filters: this.initialize(),
            show: false,
            current: '',
            componentid: 0,
            componenttype: '',
            hierarchy: this.initialize_hierarchy(),
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            current_page: 1,
        }
    },
    methods: {
        index(page){
            let vm = this;
            axios.post(route('masterdata.hierarchy.results', {page: page}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        refresh(type = 0){
            let vm = this;
            if(type == 1){
                vm.index();
            }else{
                vm.index(this.current_page);
            }
        },  
        destroy(hierarchy){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete(route('masterdata.hierarchy.destroy', {hierarchy: hierarchy.id})).then(response => {
                        vm.index();
                        vm.$emit('refresh');
                        vm.$emit('close');
                        if (response.data.success) {
                            this.$toast.success(response.data.message, {                        
                                position: 'bottom-right'                   
                            });
                        } else {
                            this.$toast.error('Failed to Delete', {                        
                                position: 'bottom-right'
                            });                            
                        }
                    }).catch(error => {
                        this.$toast.error('Failed to Delete', {                        
                            position: 'bottom-right'
                        });
                    });
                }
            });
        },
        toggle_filters(){
            this.show = !this.show
        },
        reset(){
            this.filters = this.initialize();
        },
        initialize() {
            return {
                search: '',
                perpage: 6
            }
        },
        initialize_hierarchy(){
            return {
                show: false,
                type: 0,
                parent: 0,
                depth: 0,
                label: ''
            }
        },
        create_hierarchy(hierarchy){
            this.hierarchy = hierarchy;
        },
        close(){
            this.hierarchy = this.initialize_hierarchy();
        }
    },
    watch: {
        "result.meta.current_page": function(){
            this.current_page = this.result.meta.current_page;
        }
    },
    mounted() {
        this.index();
    }
}
</script>
