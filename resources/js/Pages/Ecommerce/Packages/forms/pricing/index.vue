<template>
    <div class="mx-5">
        <div class="flow-root mb-3">
            <div class="float-right">
                <CreatePricing :packagedata="packagedata" :current="current" @close="current = 0" @index="index"/>                
            </div>
        </div>
        <div>
            <TableView :pricing="pricing" @edit="edit" @delete="destroy"/>
        </div>
        
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import TableView from './table.vue';
import CreatePricing from './create.vue';

export default{
    components:{
        ButtonRegular,
        TableView,
        CreatePricing
    },
    props: {
        packagedata: {
            type: Object,
            required: true,
        }
    },
    data(){
        return{
            pricing: [],
            current: 0,
            filters: {

            }
        }
    },
    methods:{
        index() {
            let vm = this;
            axios.post(route('ecommerce.pricing.index', {package: vm.packagedata.id}), vm.filters).then( response => {
                vm.pricing = response.data.data;
            }).catch(error => {

            });
        },
        edit(price) {
            this.current = price;
        },
        destroy(pricingid) {
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
                    axios.delete("/ecommerce/pricing/"+pricingid+"/destroy").then( response => {
                        vm.index();
                        if(response && response.data && response.data.success){
                            this.$toast.success(response.data.message, {                        
                                position: 'bottom-right'                   
                            });
                        }else{
                            this.$toast.error(response.data.message, {                        
                                position: 'bottom-right'
                            });
                        }
                    }).catch(error => {
                        this.$toast.error('Failed to Delete Pricing', {                        
                        position: 'bottom-right'
                    });

                    });
                }
            });
        }
    },
    mounted(){
        this.index();
    }
}
</script>
