<template>
    <div>
        <template v-for="(recomendation, index) in recomendations">
            <template v-if="recomendation && recomendation.elements">
                <div class="text-black text-base font-semibold mb-4">{{ recomendation.title }}</div>
                <component :is="recomendation.layout" :data="recomendation.elements"></component>
                <div class="text-blue-800 text-sm font-medium flex my-4" v-if="recomendation.more.link">
                    <a :href="recomendation.more.link">{{ recomendation.more.label }}
                        <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span>
                    </a>
                </div>
            </template>
        </template>
    </div>
</template>
<script>
    import ListLayout from './layouts/list.vue';
    import ThumbnailLayout from './layouts/thumbnail.vue';
    export default{
        components:{
            "list": ListLayout,
            "thumbnail": ThumbnailLayout
        },
        data(){
            return {
                recomendations: []
            }
        },
        methods: {
            index(){
                let vm = this;
                axios.get(route('modules.sidebar.index')).then(response => {
                    vm.recomendations = response.data;
                }).catch(error => {

                });
            }
        },
        mounted(){
            this.index();
        }
    }
</script>