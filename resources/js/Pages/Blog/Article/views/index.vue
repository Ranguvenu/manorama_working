<template>
    <div>
        <Header class="mb-5" @filter="index" :filters="filters" @show-filters="toggle_filters" :type="type" :current="article" @close="close" @refresh="index"/>
        <Filters class="p-2" :show="show" :data="data" :type="type" :filters="filters" @filter="index" @reset="reset"/>
        <CardsView class="mt-5" :results="result.data" :type="type" @edit="edit" @delete="destroy"/>
        <Pagination v-if="result.meta && result.meta.links" :type="type" :meta="result" @pagechange="index"/>
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
    props:{
        data: {
            type: Object,
            required: true
        },
        type: {
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
            article: 0
        }
    },
    methods:{
        toggle_filters(){
            this.show = !this.show
        },
        initialize(){
            return {
                search: '',
                category: 0,
                author: 0,
                perpage: 10
            }
        },
        index(page = 1){
            let vm = this;
            axios.post(route('blog.article.results', {page: page, category: vm.type.slug}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(article){       
            this.article = article;
        },
        destroy(article){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete ${article.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete(route('blog.article.destroy', {article: article.id, category: vm.type.slug})).then( response => {
                        vm.index();
                        vm.$toast.success(response.data.message, {                        
                            position: 'bottom-right'                   
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Article', {                        
                            position: 'bottom-right'                   
                        });

                    });
                }
            });
        },
        close(){
            this.article = 0;
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
