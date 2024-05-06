<template>
    <div>
        <PurchaseInformation :data="data"/>
    </div>
</template>
<script>
import PurchaseInformation from '@/Pages/UserManagement/Users/details/purchase-information.vue';
export default{
    props:{
        lead: {
            type: Object,
            required: true
        },
        results: {
            type: Object,
            required: true
        }
    },
    components:{
        PurchaseInformation
    },
    data(){
        return {
            data: {}
        }
    },
    methods:{
        show(){
            let vm = this;
            axios.get(route('users.type.show', {  category: 'subscribers', user: vm.lead.is_registered })).then(response => {
                vm.data = response.data.data;
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.show();
    }
}
</script>