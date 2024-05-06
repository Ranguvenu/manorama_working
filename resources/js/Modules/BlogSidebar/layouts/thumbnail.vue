<template>
    <template  v-for="(course, index) in data">
        <a :href="route('frontend.package', { type: course.page.type, page: course.page.page })">
            <div class="mb-3">
                <img :src="course.thumbnail"/>
            </div>
        </a>
    </template>
</template>
<script>
    export default{
        props:{
            data: {
                type: Array,
                required: true
            }
        },
        data(){
            return {

            }
        },
        methods:{ 

        },
        mounted(){

        }
    }
</script>