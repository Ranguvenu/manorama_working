<template>
    <div class="mx-5">
        <div class="flow-root mb-3">
            <div class="float-right">
                <CreateBatch :packagedata="packagedata" :current="current" @close="current = 0" @refresh="index"/>                
            </div>
        </div>
        <div>
            <TableView :batches="batches" @edit="edit" @delete="destroy" @view-enrollments="view_enrollments"/>
        </div>
        <Enrollments :current="showenrollments" @close="close_enrollments"/>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import TableView from './table.vue';
import CreateBatch from './create.vue';
import Enrollments from '../../view/enrollments/index.vue';

export default{
    components:{
        ButtonRegular,
        TableView,
        CreateBatch,
        Enrollments
    },
    props:{
        packagedata: {
            type: Object,
            required: true
        },
        data: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            batches: [],
            current: 0,
            showenrollments: 0,
            filters: {

            }
        }
    },
    methods:{
        index() {
            let vm = this;
            axios.post(route('ecommerce.batch.index', {package: vm.packagedata.id}), vm.filters).then( response => {
                vm.batches = response.data.data;
            }).catch(error => {

            });
        },
        switch(data){
            this.$emit('switch', data);
        },
        edit(batch) {
            this.current = batch;
        },
        destroy(batchid) {
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
                    axios.delete("/ecommerce/batch/"+batchid+"/destroy").then( response => {
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
                        this.$toast.error('Failed to Delete Batch', {                        
                        position: 'bottom-right'
                    });

                    });
                }
            });
        },
        close_enrollments(){
            this.showenrollments = 0;
        },
        view_enrollments(batch){
            this.showenrollments = batch;
        },
    },
    mounted(){
        this.index();
    }
}
</script>
