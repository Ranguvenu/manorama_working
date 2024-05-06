<template>
    <template v-for="element in elements" :key="element.name">
        <div v-if="element && element.visible">
            <ViewComponents :component="element.component" :configuration="element.configuration"/>
        </div>
    </template>
</template>
<script>
    import ViewComponents from './PageBuilder/PageDesigner/Components/view.vue';
    export default{
        props:{
            page: {
                type: Number,
                required: true
            }
        },
        components:{
            ViewComponents
        },
        data(){
            return{
                elements: []
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