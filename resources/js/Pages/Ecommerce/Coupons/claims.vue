<template>
    <Modal :show="show" max-width="4xl" @close="$emit('close')">
        <template #header>
            <div class="text-lg">Coupon Code Claims</div>
        </template>
        <div class="px-3">
            <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th>S.No</th>
                        <th>Coupon Code</th>
                        <th>Claimed By</th>
                        <th>Discount Availed</th>
                        <th>Package</th>
                        <th>Claimed On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in coupons.data"
                        v-if="coupons && coupons.data && coupons.data.length">
                        <td>{{ $get_sno(index + 1, coupons.meta.current_page, coupons.meta.per_page) }}</td>
                        <td>{{ data.code }}</td>
                        <td>{{ data.claimed_by }}</td>
                        <td>{{ data.discount_availed }}</td>
                        <td>{{ data.package }}</td>
                        <td>{{ data.claimed_on }}</td>
                    </tr>
                    <tr v-else>
                        <td colspan="14">
                            <div class="text-center">No Data Available</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('close')">Close</ButtonRegular>                
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';
export default{
    components:{
        Modal,
        ButtonRegular
    },
    props:{
        current: {
            type: Number,
            required: true
        }
    },
    data(){
        return{
            show: false,
            filters: {
                perpage: 10
            },
            coupons: {
                data: [],
                meta: []
            }
        }
    },
    methods:{
        index(){
            let vm = this;
            axios.post(route('ecommerce.coupons.claims', {coupon: this.current}), vm.filters).then(response => {
                vm.coupons = response.data;
            }).catch(error => {

            });
        }
    },
    watch:{
        current() {
            if(this.current){
                this.index();
                this.show = true;
            }else{
                this.show = false;
            }
        }
    },
    mounted(){

    }
}
</script>