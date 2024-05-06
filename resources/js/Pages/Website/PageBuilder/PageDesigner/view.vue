<template>
    <div>
        <div v-for="element in elements" :key="element.name" >
            <ViewComponents :component="element.component" :configuration="element.configuration"/>
        </div>         
    </div>
</template>
<script>
    import ViewComponents from './Components/view.vue';
    export default{
        components:{
            ViewComponents
        },
        props:{
            page: {
                type: Number,
                required: true
            }
        },
        data(){
            return{
                enabled: true,
                elements: [],
                draging: false,
                show: false,
            }
        },
        methods:{
            get_components(){
                let vm = this;
                axios.get('/website/pages/'+vm.page+'/design/create').then(response => {
                    vm.elements = response.data.data;
                }).catch(error => {

                });
            }
        },
        mounted(){
            this.get_components();
        }
    }
</script>
