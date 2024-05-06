<template>
    <div>
        <PromoCode :lead="lead" :coupons="coupons" @refresh="index"/>
        <table class="min-w-full text-left text-sm font-light ">
			<thead class="border-b font-medium dark:border-neutral-500">
				<tr>
					<th class="bg-rose-light">S.No</th>
					<th class="bg-rose-light">PromoCode</th>
					<th class="bg-rose-light">Sent By</th>
					<th class="bg-rose-light">Sent On</th>
				</tr>
			</thead>
			<tbody>
                <tr v-for="(code, index) in codes.data" v-if="codes.data && codes.data.length">
                    <td>{{ index+1 }}</td>
                    <td>{{ code.code }}</td>
                    <td>{{ code.sent_by }}</td>
                    <td>{{ code.sent_on }}</td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import PromoCode from './promocode.vue';

export default{
    components:{
        ButtonRegular,
        PromoCode
    },
    props:{
        lead: {
            type: Object,
            required: true
        },
        coupons: {
            type: Object,
            required: true
        },
        results: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            codes: []
        }
    },
    methods:{
        index(lead){
            let vm = this;
            let payload = {};
            axios.post(route('leads.promocode.index', {interests: lead}), payload).then(response => {
                vm.codes = response.data;
            }).catch(error => {

            });
        }
    },
    watch: {
        'lead.id': function(){
            this.index(this.lead.id);
        }
    },
    mounted(){
        if(this.lead.id){
            this.index(this.lead.id);
        }
    }
}
</script>
