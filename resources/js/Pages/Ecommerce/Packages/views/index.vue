<template>
    <div>
        <Header @filter="index" :filters="filters" :type="type" @show-filters="toggle_filters" @close="close" @refresh="index" />
        <Filters :data="data" :type="type" :show="show" :filters="filters" @filter="index" @reset="reset" />
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy" />
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index" />
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Filters from '../filters/index.vue';
import Header from './header.vue';

export default {
    components: {
        Pagination,
        TableView,
        Filters,
        Header
    },
    props: {
        type: {
            type: Object,
            required: true
        },
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            filters: this.initialize(),
            show: false,
            result: {
                data: [],
                links: [],
                meta: []
            },
        }
    },
    methods: {
        toggle_filters() {
            this.show = !this.show
        },
        initialize() {
            return {
                perpage: 6,
                search: '',
                date: {
                    start: '',
                    end: ''
                },
                goal: '',
                board: '',
                class: '',
                subject: '',
                payment: '',
            }
        },
        index(page = 1) {
            let vm = this;
            axios.post(route('ecommerce.packages.results', {page: page}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(packages) {
            this.$emit('edit', packages);
        },
        destroy(data) {
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if (response.value) {
                    axios.delete(route('ecommerce.packages.destroy', { package: data.id })).then(response => {
                        if(response.data.success){
                            vm.index();
                            this.$toast.success(response.data.message, {
                                position: 'bottom-right'
                            });
                        }else{
                            this.$toast.error(response.data.message, {
                                position: 'bottom-right'
                            });  
                        }
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Package', {
                            position: 'bottom-right'
                        });

                    });
                }
            });
        },
        get_children(type, id){
            let vm = this;
            axios.get(route('masterdata.hierarchy.children', {hierarchy: id})).then(response => {
                vm.data[type] = response.data;
            }).catch(error => {

            });
        },
        close() {
            this.user = 0;
        },
        reset() {
            this.filters = this.initialize();
            this.index();
        }
    },
    watch:{
        "filters.goal": function(){
            this.filters.board = '';
            this.filters.classes = '';
            this.filters.subject = '';
            if(this.filters.goal){
                this.get_children('boards', this.filters.goal);
            }
        },
        "filters.board": function(){
            this.filters.classes = '';
            this.filters.subject = '';
            if(this.filters.board){
                this.get_children('classes', this.filters.board);
            }
        },
        "filters.classes": function(){
            this.filters.subject = '';
            if(this.filters.classes){
                this.get_children('subjects', this.filters.classes);
            }
        },
    },
    mounted() {
        this.index();
    }
}
</script>
