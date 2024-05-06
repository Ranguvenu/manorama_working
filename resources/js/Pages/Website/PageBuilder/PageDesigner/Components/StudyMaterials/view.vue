<template>
    <ul class="flex nav_list">
        <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
            <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
        </li>
    </ul>
    <div class="w-full my-8">
        <div class="flex justify-center text-black text-[26px] font-semibold leading-[35px] my-6">{{ data.title }}</div>
        <div class="flex flex-row flex-wrap mt-6 mb-12">
            <div class="md:w-1/4 w-1/2 pr-4 mb-4">
                <label class="block mb-1 text-zinc-800 text-[16px]" for="goals">Goals</label>
                <MultiSelect v-model="filters.goal" placeholder="Select" returns="id" :options="options.goals" label="title" :multiple="false"/>
            </div>
            <div class="md:w-1/4 w-1/2 pr-4 mb-4">
                <label class="block mb-1 text-zinc-800 text-[16px]" for="board">Choose Board</label>
                <MultiSelect v-model="filters.board" placeholder="Select" returns="id" :options="options.boards" label="title" :multiple="false"/>
            </div>
            <div class="md:w-1/4 w-1/2 pr-4 mb-4">
                <label class="block mb-1 text-zinc-800 text-[16px]" for="classes">Choose Class</label>
                <MultiSelect v-model="filters.classes" placeholder="Select" returns="id" :options="options.classes" label="title" :multiple="false"/>
            </div>
            <div class="md:w-1/4 w-1/2 pr-4 mb-4">
                <label class="block mb-1 text-zinc-800 text-[16px]" for="classes">Choose Subject</label>
                <MultiSelect v-model="filters.subject" placeholder="Select" returns="id" :options="options.subjects" label="title" :multiple="false"/>
            </div>
            <!--<div class="md:w-1/4 w-1/2 pr-4 mb-4">
                <label for="chapters" class="block mb-1 text-zinc-800 text-[16px]">Choose Chapter</label>
                <select id="chapters" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                    <option selected>Select</option>
                    <option value="1">Chapter1</option>
                    <option value="2">Chapter2</option>
                    <option value="3">Chapter3</option>
                    <option value="4">Chapter4</option>
                </select>
                <InputLabel class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="classes">Choose Chapter</InputLabel>
                <MultiSelect v-model="filters.chapter" placeholder="Select Subject" returns="id" :options="options.chapters" label="title" :multiple="false"/>
            </div>-->
            <div class="md:w-1/4 w-full pr-4 mb-4">
                <label for="search_topics" class="block mb-1 text-zinc-800 text-[16px]">Search</label>
                <input
                class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5"
                v-model="filters.search"
                type="text"
                v-on:keyup="index"
                :placeholder="data.search" />
            </div>
            <button type="submit" class="inline-flex items-center self-end py-2.5 px-[18px] mb-4 text-sm font-medium text-white bg-rose-600 rounded-[5px] hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-200 dark:bg-rose-500 dark:hover:bg-rose-600 dark:focus:ring-rose-700" v-on:click="index">Search</button>
        </div>
        <div class="grid grid-cols-1 sm:gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-if="studymaterials.data && studymaterials.data.length">
            <div class="media_xs:col-span-12 sm:col-span-6 xl:col-span-3 lg:col-span-4" v-for="(studymaterial, index) in studymaterials.data">
                <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg w-full">
                    <div class="relative">
                        <img class="rounded-tl-lg rounded-tr-lg object-cover h-48 w-full" :src="studymaterial.thumbnail" :alt="studymaterial.title" />
                        <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]" v-if="studymaterial.badge"><span class="text-white text-xs">{{ studymaterial.badge }}</span></div>
                    </div>
                    <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                        <div class="break-all text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight"><a :href="route('studymaterial.show', {material: studymaterial.slug})">{{ studymaterial.title }}</a></div>
                        <div class="text-gray-600 text-xs">{{ studymaterial.created_on }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex justify-center border border-primary rounded-md text-gray-700 text-md py-4">No Materials Found</div>
        </div>
        <Pagination v-if="studymaterials.meta && studymaterials.meta.links" :meta="studymaterials" @pagechange="index"/>
    </div>
</template>
<script>
import Pagination from "@/Components/Pagination.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import InputLabel from "@/Components/InputLabel.vue";

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components:{
        Pagination,
        MultiSelect,
        InputLabel,
    },
    data() {
        return {
            filters: {
                perpage: this.data.perpage,
                category: 0,
                type: this.data.type,
                search: '',
                goal: '',
                board: '',
                classes: '',
                subject: '',
                chapters: '',
            },
            studymaterials: {
                data: [],
                meta: [],
            },
            options: {
                goals: [],
                boards: [],
                classes: [],
                subjects: [],
                chapters: [],
            },
            current: 0
        }
    },
    methods: {
        create(){
            let vm = this;
            axios.get(route('website.components.create', {component: 'studymaterials', type: vm.data.type})).then( (response) => {
                vm.options = response.data;
            }).catch(error => {

            });
        },
        index(page=1){
            let vm = this;
            axios.post(route('website.components.index', {component: 'studymaterials', page: page}), vm.filters).then((response) => {
               vm.studymaterials = response.data;
            }).catch(error => {

            });
        },
        get_children(type, id){
            let vm = this;
            axios.get(route('masterdata.hierarchy.children', {hierarchy: id})).then(response => {
                vm.options[type] = response.data;
            }).catch(error => {

            });
        },
    },
    mounted() {
        this.create();
        this.index();
    },
    watch:{
        "filters.goal": function(){
            this.filters.board = '';
            this.filters.classes = '';
            this.filters.subject = '';
            if(this.filters.goal){
                this.get_children('boards', this.filters.goal);
            }
        },
        "filters.board": function(){
            this.filters.classes = '';
            this.filters.subject = '';
            if(this.filters.board){
                this.get_children('classes', this.filters.board);
            }
        },
        "filters.classes": function(){
            this.filters.subject = '';
            if(this.filters.classes){
                this.get_children('subjects', this.filters.classes);
            }
        },
    },
}
</script>


