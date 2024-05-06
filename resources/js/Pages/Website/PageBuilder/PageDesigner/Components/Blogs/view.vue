<template>
    <ul class="flex nav_list">
        <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
            <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
        </li>
    </ul>
    <div class="w-full my-8">
        <div class="flex justify-center text-black text-[26px] font-semibold leading-[35px] my-6">{{ data.title }}</div>
        <div class="flex justify-center mb-12">
            <div class="relative sm:w-[603px]   w-full flex items-center h-12 bg-white shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-[7px] overflow-hidden px-6">
                <MagnifyingGlassIcon class="mx-auto w-[19px] h-[19px] text-zinc-500" aria-hidden="true"/>
                <input
                class="h-full w-full border-none shadow-none text-gray-600 text-base p"
                v-model="filters.search"
                type="text"
                id="articlesearch"
                v-on:keyup="index"
                :placeholder="data.search" /> 
            </div>
        </div>
        <div class="tab_wrap mb-4 pt-0 pb-8">
            <ul class="flex overflow-x-auto md:justify-center no-scrollbar text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" role="tablist">
                <li class="mr-2 shrink-0 my-1" role="presentation" v-on:click="filter_postings(0)">
                    <a href="javascript:void(0)" class="inline-block text-nowrap px-8 py-1 bg-white border border-gray-200 rounded text-gray-600 text-md" :class="{'active' : (current == 0)}"
                        id="all" data-tabs-target="#all" type="button" role="tab" aria-controls="all"
                        aria-selected="false">All</a>
                </li>
                <li class="mr-2 shrink-0 my-1 " v-for="(category, index) in options.categories" v-on:click="filter_postings(category.id)">
                    <a href="javascript:void(0)" class="inline-block text-nowrap px-4 py-1 border border-gray-200 bg-white rounded text-gray-600 text-md" :class="{'active' : (current == category.id)}" type="button" role="tab"
                        :aria-controls="category.slug" aria-selected="false">{{ category.name }}</a>
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12" v-if="blogs.data && blogs.data.length">
            <div class="sm:col-span-12 xl:col-span-3 lg:col-span-4 md:col-span-6" v-for="(blog, index) in blogs.data" :key="index">
                <a :href="data.type === 'webinar' ? route('webinar.show', {webinar: blog.slug}) : route('blog.show', {category: data.type, article: blog.slug})">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg w-full">
                        <div class="relative">
                            <img class="rounded-tl-lg rounded-tr-lg object-cover h-48 w-full" :src="blog.thumbnail" :alt="blog.title" />
                            <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]" v-if="blog.badge"><span class="text-white text-xs">{{ blog.badge }}</span></div>
                        </div>
                        <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                            <div class="break-all text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight truncate">
                                {{ blog.title }}
                            </div>
                            <div class="text-gray-600 text-xs">{{ blog.created_on }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div v-else>
            <div class="flex justify-center border border-primary rounded-md text-gray-700 text-md">No {{data.type}}s found</div>
        </div>
        <Pagination v-if="blogs.meta && blogs.meta.links" :meta="blogs" @pagechange="index"/>
    </div>        
</template>
<script> 
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
import Pagination from "@/Components/Pagination.vue";

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components:{
        MagnifyingGlassIcon,
        Pagination
    },
    data() {
        return {
            options: [],
            filters: {
                perpage: this.data.perpage,
                category: 0,
                type: this.data.type,
                search: ''
            },
            blogs: {
                data: [],
                meta: []
            },
            current: 0,
            test : false
        }
    },
    methods: {
        create(){
            let vm = this;
            axios.get(route('website.components.create', {component: 'blogs', type: vm.data.type})).then( (response) => {
                vm.options = response.data;
            }).catch(error => {

            });
        },
        index(page=1){
            let vm = this;
            axios.post(route('website.components.index', {component: 'blogs', page: page}), vm.filters).then((response) => {
               vm.blogs = response.data;
            }).catch(error => {

            });
        },
        filter_postings(category){
            this.current = category;
            this.filters.category = category;
            this.index();
        },
        view_more(){
            this.index(this.postings.meta.current_page + 1);
        },
        test(){
            console.log('djsd')
        }
    },
    computed:{
        can_show_more(){
            return (this.postings.meta.last_page <= this.postings.meta.current_page) ? false : true;
        }
    },
    mounted() {
        this.create();
        this.index();
    }
}
</script>


