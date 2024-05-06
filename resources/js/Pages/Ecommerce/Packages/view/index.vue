<template>
    <div>
        <div class="flex flex-row flex-wrap mb-5">
            <div class="md:w-2/12">
                <img :src="data.thumbnail"/>
            </div>
            <div class="w-10/12">
                <div class="mx-3">
                    <div class="ck_content text-sm" v-html="data.description"></div>
                    <div class="text-sm text-gray-600 mt-2">{{ data.valid_from }} - {{ data.valid_to }}</div>
                    <div class="text-sm text-gray-600">Package Type: {{ data.package_type_name }}</div>
                    <div class="text-sm text-gray-600">Validity: {{ data.valid_for }} <span v-if="data.validity_type == 'days'">Days from date of purchase</span></div>
                    <div class="text-sm text-gray-600">Courses: {{data.courses.length}}</div>
                </div>
            </div>
        </div>
        <div class="font-md font-semibold">Subjects</div>
        <div class="mt-3">
            <template v-for="(subject, index) in data.courses">
                <CardView :data="subject" @view-enrollments="view_enrollments"/>
            </template>
        </div>
        <Enrollments :current="current" @close="close_enrollments"/>
    </div>
</template>
<script>
import CardView from './card.vue';
import Enrollments from './enrollments/index.vue';
export default{
    props:{
        data: {
            type: Object,
            required: true
        }
    },
    components:{
        CardView,
        Enrollments
    },
    data(){
        return{
            current: 0
        }
    },
    methods:{
        view_enrollments(batch){
            this.current = batch;
        },
        get_url(course){
            return this.$page.props.mdl_url+'/course/view.php?id='+course;
        },
        close_enrollments(){
            this.current = 0;
        }
    },
    mounted(){

    }
}
</script>
