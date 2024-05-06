<template>
    <ButtonOutline class="text-base" size="md" v-on:click="open_modal">Add Syllabus</ButtonOutline>
    <Modal max-width="7xl" :show="show" @close="close_modal">
        <template #header>
            <div>Configure Syllabus</div>
        </template>
        <!-- <pre>
            {{ syllabus }}
        </pre> -->
        <div class="px-3 max-h-96 overflow-y-auto">
            <draggable class="dragArea list-group w-full" :list="syllabus">
                <div class="border mb-2" v-for="(course, courseindex) in syllabus">
                    <div class="bg-zinc-100 p-2 cursor-pointer" v-on:click="toggle_course_tab(courseindex)">
                        <div class="flow-root">
                            <div class="float-left">
                                <span v-if="course.title">{{ course.title }}</span>
                                <span v-else>Course {{ courseindex+1 }}</span>
                            </div>
                            <div class="float-right">
                                <ChevronRightIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!(courseindex == activecourse)"/>
                                <ChevronDownIcon class="mx-auto h-5 w-5  text-gray-1000" aria-hidden="true" v-if="(courseindex == activecourse)"/>
                            </div>
                        </div>
                    </div>
                    <div class="p-2" v-if="activecourse == courseindex">
                        <div class="py-2 flex">
                            <div class="w-full">
                                <InputLabel for="title" value="Subject Title" />
                                <TextInput type="text" class="mt-1 block w-full"
                                    placeholder="Subject Title" v-model="course.title" autofocus/>
                            </div>
                            <div class="w-full ms-2">
                                <InputLabel for="title" value="Class Timinigs" />
                                <TextInput type="text" class="mt-1 block w-full"
                                    placeholder="Class Timinigs" v-model="course.timings" autofocus/>
                            </div>
                        </div>
                        <div class="text-regular mb-2">Chapters</div>
                        <draggable class="dragArea list-group w-full" :list="course.syllabus">
                            <div class="border p-2" v-for="(chapter, chapterindex) in course.syllabus">
                                <div class="w-full mb-2">
                                    <InputLabel for="title" value="Chapter Title"/>
                                    <TextInput type="text" class="mt-1 block w-full"
                                        placeholder="Subject Title" v-model="chapter.title" autofocus v-on:keyup="$emit('updated')"/>
                                </div>
                                <div class="border p-2">
                                    <div class="text-regular mb-2 font-semibold">Topics</div>
                                    <draggable class="dragArea list-group w-full" :list="chapter.topics">
                                        <div v-for="(topic, topicindex) in chapter.topics">
                                            <div class="flex">
                                                <div class="w-25 mb-2">
                                                    <InputLabel for="type" value="Type"/>
                                                    <select class="border-gray-300 rounded-md py-2 shadow-sm mt-1" v-model="topic.type" v-on:change="$emit('updated')">
                                                        <option v-for="(contenttype, contentindex) in contenttypes" :value="contentindex">{{ contenttype }}</option>
                                                    </select>
                                                </div>
                                                <div class="w-full ms-2">
                                                    <InputLabel for="type" value="Title"/>
                                                    <TextInput type="text" class="mt-1 block w-full"
                                                        placeholder="Topic Title" v-model="topic.title" autofocus v-on:keyup="$emit('updated')"/>
                                                </div>
                                                <div class="w-25 ms-2">
                                                    <InputLabel for="title" value=""/>
                                                    <ButtonRegular class="mt-5" size="sm" color="secondary" v-on:click="remove_topic(courseindex, chapterindex, topicindex)">Remove</ButtonRegular>
                                                </div>
                                            </div>
                                        </div>
                                    </draggable>
                                    <div class="text-right">
                                        <ButtonRegular size="sm" color="primary" v-on:click="add_topic(courseindex, chapterindex)">Add Topic</ButtonRegular>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <ButtonRegular size="sm" color="secondary" v-on:click="remove_chapter(courseindex, chapterindex)">Remove Chapter</ButtonRegular>
                                </div>
                            </div>
                        </draggable>
                        <div class="text-right">
                            <ButtonRegular size="sm" color="primary" v-on:click="add_chapter(courseindex)">Add Chapter</ButtonRegular>
                            <ButtonRegular size="sm" color="secondary" v-on:click="remove_course(courseindex)">Remove Course</ButtonRegular>
                        </div>
                    </div>
                </div>
            </draggable>
            <div class="text-right">
                <ButtonRegular size="sm" color="primary" v-on:click="add_course">Add Course</ButtonRegular>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="primary" v-on:click="close_modal">Save & Close</ButtonRegular>
        </template>
    </Modal> 
</template>
<script>
import ButtonOutline from '@/Components/ButtonOutline.vue';
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/24/solid'
import { VueDraggableNext } from 'vue-draggable-next'

export default{
    components:{
        ButtonOutline,
        Modal,
        ButtonRegular,
        TextInput,
        InputLabel,
        ChevronRightIcon,
        ChevronDownIcon,
        'draggable': VueDraggableNext
    },
    props:{
        modelValue: {
            type: [Array],
            required: true
        },
    },
    data(){
        return {
            show: false,
            syllabus: [],
            contenttypes: {
                test : 'Test',
                liveclass: 'Live Class',
                reading: 'Reading',
                material: 'Study Material',
                practicequestions: 'Practice Questions',
                doubtsolving: 'Doubt Solving'
            },
            activecourse: -1
        }
    },
    methods:{
        remove_topic(courseindex, chapterindex, topicindex){
            console.log( this.syllabus[courseindex].syllabus[chapterindex]);
            this.syllabus[courseindex].syllabus[chapterindex].topics.splice(topicindex, 1);
            this.$emit('updated')
        },
        add_topic(courseindex, chapterindex){
            let topic = this.create_topic();
            this.syllabus[courseindex].syllabus[chapterindex].topics.push(topic);
            this.$emit('updated')
        },
        create_topic(){
            return {
                type: '',
                title: ''
            }
        },
        remove_chapter(courseindex, chapterindex){
            this.syllabus[courseindex].syllabus.splice(chapterindex, 1);
            this.$emit('updated')
        },
        add_chapter(courseindex){
            let chapter = this.create_chapter();
            this.syllabus[courseindex].syllabus.push(chapter);
            this.$emit('updated')
        },
        create_chapter(){
            let topics = [];
            topics.push(this.create_topic());
            return {
                title: '',
                topics: topics
            }
        },
        add_course(){
            let course = this.create_course();
            this.syllabus.push(course);
            this.$emit('updated')
        },
        create_course(){
            let syllabus = [];
            let chapter = this.create_chapter();
            syllabus.push(chapter);
            return {
                title: '',
                timings: '',
                syllabus: syllabus
            }
        },
        remove_course(courseindex){
            this.syllabus.splice(courseindex, 1);
            this.$emit('updated')
        },
        open_modal(){
            this.show = true;
        },
        close_modal(){
            this.show = false;
        },
        toggle_course_tab(courseindex){
            if(courseindex === this.activecourse){
                this.activecourse = -1
            }else{
                this.activecourse = courseindex;
            }
        }
    },
    watch: {
        modelValue: function(){
            this.syllabus = this.modelValue;
        }
    },
    mounted(){
        this.syllabus = this.modelValue;
    }
}
</script>
