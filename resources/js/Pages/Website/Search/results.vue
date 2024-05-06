<template>
    <div class="my-8" v-if="term">
        <div class="text-gray-600">Showing results for <span class="font-bold text-gray-900">"{{ term }}"</span></div>
    </div>
    <CourseResults :response="results.pages"/>
    <WebinarResults :response="results.webinars"/>
    <ArticleResults :response="results.articles"/>
    <CurrentAffairResults :response="results.currentaffairs"/>
    <StudyMaterialResults :response="results.studymaterials"/>    
</template>
<script>
import CourseResults from './courses.vue';
import WebinarResults from './webinars.vue';
import ArticleResults from './articles.vue';
import CurrentAffairResults from './currentaffairs.vue';
import StudyMaterialResults from './studymaterials.vue';
export default{
    components:{
        CourseResults,
        WebinarResults,
        ArticleResults,
        CurrentAffairResults,
        StudyMaterialResults
    },
    props:{
        results: {
            type: Object,
            required: true
        },
        term: {
            type: String,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>
