<template>
	<div>
        <Header :filters="filters" @filter="index"  @reset="reset" @show-filters="toggle_filters" :current="coupon" @close="close" @refresh="index"/>
        <!-- <Filters :show="show" :filters="filters" @filter="index" @reset="reset"/> -->
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @delete="destroy" @view-claims="view_claims"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index"/>
        <CouponCodeClaims :current="current" @close="close_claims_modal"/>
    </div>
</template>
<script>
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Header from './header.vue';
import Filters from '../filters/index.vue';
import CouponCodeClaims from "../claims.vue";

export default{
    components:{
        Header,
        Pagination,
        TableView,
        Filters,
        CouponCodeClaims
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
            coupon: 0,
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
            axios.post(route('ecommerce.coupons.results', { page: page }), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        edit(coupon){
            this.coupon = coupon;
        },
        view_claims(coupon){
            this.current = coupon;
        },
        destroy(coupon){
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to delete coupon ${coupon.code} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if(response.value) {
                    axios.delete(route('ecommerce.coupons.destroy', { coupon: coupon.id })).then( response => {
                        vm.index();
                        this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'
                    });
                    }).catch(error => {
                        this.$toast.error('Failed to Delete coupon', {                        
                        position: 'bottom-right'
                    });

                    });
                }
            });
        },
        close(){
            this.coupon = 0;
        },
        close_claims_modal(){
            this.current = 0;
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
