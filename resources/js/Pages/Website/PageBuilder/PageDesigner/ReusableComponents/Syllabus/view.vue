<template>
    <div>
        <div class="flex flex-wrap gap-6 mb-5">
            <a v-for="(course, index) in courses" @click="currentindex = index"
                :class="{ 'text-primary border-b-primary border-b-2 font-medium': currentindex == index }"
                class="text-gray-500 cursor-pointer py-1 mr-2">{{ course.title }}</a>
        </div>
        <div :class="{ 'block': currentindex == index, 'hidden': currentindex != index }"
            v-for="(course, index) in courses">
            <template v-if="course">
                <div v-if="course && course.timings" class="bg-purple-50 px-4 py-4 rounded-md mb-3 text-black text-sm font-medium">{{ course.timings }}</div>
                <div v-for="(chapter, chapterindex) in course.syllabus">
                    <div class=" bg-gray-50 border border-gray-200 mb-3 px-2 py-3  cursor-pointer text-sm" :class="{'pb-0':currentchapterindex == chapterindex}"
                        @click="currentchapterindex = chapterindex">
                        <div class="flex justify-between items-center px-2 border-gray-200" :class="{ 'border-b  pb-2': currentchapterindex == chapterindex && currentindex == index }">
                            <div>
                                <span class="font-medium">Chapter {{ chapterindex + 1 }} : {{ chapter.title }}</span>
                            </div>
                            <div class="flex items-center">
                                <ChevronRightIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"
                                    v-if="!(currentchapterindex == chapterindex && currentindex == index)" />
                                <ChevronDownIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"
                                    v-if="currentchapterindex == chapterindex && currentindex == index" />
                            </div>
                        </div>
                        <div class="px-4 py-3" v-if="currentchapterindex == chapterindex && currentindex == index">
                            <ul>
                                <li v-for="(topic, topicindex) in chapter.topics" :class="{'border-b-0':(topicindex == chapter.topics.length - 1)}"
                                    class="flex text-sm items-center border-b border-gray-200 border-dotted py-3 "> <img
                                        :src="'/images/syllabus_topic_types/' + topic.type + '.png'"
                                        class="w-[15px] h-auto flex-shrink-0 mr-3" alt=""> <span class="font-medium mr-1">
                                        {{ get_topic_name(topic.type) }} : </span> <span class="text-gray-800"> {{
                                            topic.title }} </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import { ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/24/solid'

export default {
    components: {
        ChevronDownIcon,
        ChevronRightIcon,
    },
    props: {
        courses: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            currentindex: 0,
            currentchapterindex: 0,
            contenttypes: {
                test: 'Test',
                liveclass: 'Live Class',
                reading: 'Reading',
                material: 'Study Material',
                practicequestions: 'Practice Questions',
                doubtsolving: 'Doubt Solving'
            },
        }
    },
    methods: {
        get_topic_name(type) {
            let types = this.contenttypes;
            return this.contenttypes[type] ? this.contenttypes[type] : '';
        }
    },
    mounted() {

    }
}
</script>
