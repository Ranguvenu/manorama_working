<template>
    <template v-for="(faq, index) in results.data">
        <div class="text-zinc-800 text-xl font-medium leading-tight my-4">{{ faq.category }}</div>
        <template v-for="(item, key) in faq.questions">
            <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                <Accordion :title="item.title" :description="item.description"/>
            </div>
        </template>
    </template>        
</template>
<script>
import Accordion from '@/Components/Accordion.vue';
export default {
    components:{
        Accordion
    },
    props:{
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            results: [],
            current: -1
        };
    },
    methods:{
        index(){
            let vm = this;
            let payload = {
                categories: vm.data.categories
            };
            axios.post(route('website.components.index', { component: 'faq' }), payload).then((response) => {
                vm.results = response.data;
            }).catch(error => {

            });
        },
        toggleAccordion(index) {
            this.current = index;
        }
    },
    mounted(){
        this.index();
    }    
}
</script>