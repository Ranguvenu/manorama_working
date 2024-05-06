<template>
    <div>
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @manage="manage"/>
        <ManageNotificationSettings :current="current" @close="current = 0" @refresh="index"/>
    </div>
</template>
<script>
import axios from 'axios';
import TableView from './table.vue';
import ManageNotificationSettings from '../create.vue';
export default{
    components:{
        TableView,
        ManageNotificationSettings
    },
    data(){
        return {
            result: {
               data: [],
               links: [],
               meta: [] 
            },
            current: {}
        }
    },
    methods:{
        initialize(){
            return {
                search: '',
                perpage: 10
            }
        },
        index(page=1){
            let vm = this;
            axios.post(route('notifications.settings.results', {page: page}), vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {
                
            });
        },
        manage(setting){
            this.current = setting;
        }
    },
    
    mounted(){
        this.index();
    }
}
</script>
