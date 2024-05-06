<template lang="">
    <div class="m-2 upcoming_classroom_widget">
        <h4 class="text-lg font-semibold mb-3">Upcoming classrooms</h4>
        <div class="rounded-md p-4 bg-white border classrooms_container">
            <div class="flex" v-for="(classroom,index) in classrooms">
                <div class="date_container flex flex-col me-3 items-center">
                    <div class="border-s-4 font-semibold px-2 py-1 border-primary">
                        <div class="text-xs text-gray-500 ">1st Aug 2023</div>
                        <div>3:00 PM</div>
                    </div>
                    <div class="dotedseparater w-1 border-s border-dashed border-gray-400 h-full"></div>
                </div>
                <div class="detail_container grow bg-gray-100 rounded-md mb-4 mx-2 p-3">
                    <div class="font-semibold text-sm mb-2">Demo Assignment is due to technical error</div>
                    <div class="text-xs text-gray-500">Speaker - Ashok</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue';
export default {
    setup(){
        const classrooms = ref(4);
        return {classrooms};
    }
}
</script>
<style lang="">

</style>
