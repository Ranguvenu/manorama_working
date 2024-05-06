<template>
    <div>
        <CallHistory :lead="lead" :history="data.callhistory"/>
        <div class="border border-gray-200 my-5"></div>
        <CommentsHistory :comments="data.comments" :lead="lead" @refresh="index"/>
    </div>
</template>
<script>
import CallHistory from "./callhistory.vue";
import CommentsHistory from "./commentshistory.vue";
export default{
    components:{
        CallHistory,
        CommentsHistory
    },
    props:{
        lead: {
            type: Object,
            required: true
        },
    },
    data(){
        return{
            data: {
                comments: [],
                callhistory: []
            }
        }
    },
    methods:{
        index(){
            let vm = this;
            axios.get(route('leads.responses.index', {interests: vm.lead.id})).then(response => {
                vm.data = response.data;
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.index();
    }
}
</script>
