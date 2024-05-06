<template>
    <Modal maxWidth="4xl" :show="show" @close="$emit('close')">
        <template #header>
            <div class="text-lg">Enrollments</div>
        </template>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Order Id</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Enrollment Date</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(enrollment, index) in enrollments.data"
                    v-if="enrollments && enrollments.data && enrollments.data.length">
                    <td>{{ enrollment.order_key }}</td>
                    <td>{{ enrollment.email }}</td>
                    <td>{{ enrollment.firstname }}</td>
                    <td>{{ enrollment.lastname }}</td>
                    <td>{{ enrollment.created_on }}</td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('close')">Close</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue'
import ButtonRegular from '@/Components/Button.vue';
export default{
    components:{
        Modal,
        ButtonRegular
    },
    props:{
        current: {
            type: Number,
            required: false
        }
    },
    data(){
        return {
            show: false,
            enrollments: {
                data: [],
                meta: []
            },
            filters:{
                perpage: 10,
            }
        }
    },
    methods:{
        index(page = 1){
            let vm = this;
            axios.post(route('ecommerce.batch.enrollments', {page: page, batch: vm.current}), vm.filters).then(response => {
                vm.enrollments = response.data;
                console.log(vm.enrollments);
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