<template>
    <div>
        <div class="text-zinc-800 text-[25px] font-semibold mb-4" v-if="data.title">{{ data.title }}</div>
        <div class="tab_wrap mb-8">
            <ul class="no-scrollbar flex overflow-y-auto pb-3 text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" role="tablist">
                <li class="mr-2" role="presentation" v-on:click="filter_postings(0)">
                    <a href="javascript:void(0)" class="inline-block px-8 py-1 bg-white border border-gray-200 rounded text-gray-600 text-md font-medium" :class="{'active' : (current == 0)}"
                        id="all" data-tabs-target="#all" type="button" role="tab" aria-controls="all"
                        aria-selected="false">All</a>
                </li>
                <li class="mr-2" v-for="(category, index) in options.categories" v-on:click="filter_postings(category.id)">
                    <a href="javascript:void(0)" class="inline-block px-8 py-1 text-nowrap border border-gray-200 bg-white rounded text-gray-600 text-md font-medium" :class="{'active' : (current == category.id)}" type="button" role="tab"
                        :aria-controls="category.slug" aria-selected="false">{{ category.name }}</a>
                </li>
            </ul>
        </div>
        <template v-if="postings.data && postings.data.length">
            <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200" v-for="(post, index) in postings.data">
                <div class="w-full md:w-3/4 flex flex-col flex-wrap media_md:mb-3">
                    <div class="text-zinc-800 text-base font-semibold mb-2 w-full">{{ post.title }} : {{ post.subject }}</div>
                    <div class="flex flex-wrap items-center w-full" v-if="post.tags && post.tags.length">
                        <div class="flex items-center pr-6" v-for="(tag, index) in post.tags">
                            <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2" v-if="tag"></div>
                            <div class="text-gray-600 text-base">{{ tag }}</div>
                        </div>
                    </div>
                </div>
                <div class="flex md:items-center md:justify-center w-full mt-2 md:mt-0 md:w-1/5">
                    <a v-if="!post.applied" :href="route('careers.job.create', {job: post.slug})" class="px-[18px] py-1 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium leading-[27px]">View Details</a>
                    <div v-if="post.applied" href="javascript:void(0)" class="px-[18px] py-2.5 text-green-800">Applied</div>
                </div>
            </div>
            <div class="flex justify-center" v-if="can_show_more">
                <div class="text-blue-800 text-base font-medium cursor-pointer" v-on:click="view_more">View More Positions</div>
            </div>
        </template>
        <template v-else>
            <div class="border border-gray-300 text-center p-3 text-gray-600" role="button">No Open positions are available at the moment</div>
        </template>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            options: [],
            filters: {
                perpage: this.data.perpage,
                category: 0
            },
            postings: {
                data: [],
                meta: []
            },
            current: 0
        }
    },
    methods: {
        create(){
            let vm = this;
            axios.get(route('website.components.create', {component: 'jobpostings'})).then( (response) => {
                vm.options = response.data;
            }).catch(error => {

            });
        },
        index(page=1){
            let vm = this;
            axios.post(route('website.components.index', {component: 'jobpostings', page: page}), vm.filters).then((response) => {
                if(page == 1){
                    vm.postings = response.data;
                }else{
                    if(response.data.data.length){
                        response.data.data.forEach((value, index) => {
                            vm.postings.data.push(value)
                        });
                        vm.postings.meta = response.data.meta;
                    }
                }
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


