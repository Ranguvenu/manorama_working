<template>
        <div class="text-zinc-800 text-base font-medium md:mb-12 mb-4">{{ data.caption }}</div>
            <div class="flex justify-between items-center">
                <div class="w-1/2 mr-2 md:w-auto md:min-w-72 mb-4">
                    <select id="examdownload" v-model="filters.category"
                        class="bg-neutral-50 w-full block rounded-md border border-stone-200 text-black text-[13px] h-10 focus:border-stone-300"
                        v-on:change="index">
                        <option value="0">Select</option>
                        <option  v-for="(option, index) in options.categories" :value="option.id">{{ option.name }}</option>
                    </select>
                </div>
                <div class="w-1/2 md:w-auto mb-4">
                    <div
                        class="relative w-full flex items-center h-10 bg-neutral-50 shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-md  border border-stone-200 overflow-hidden px-3">
                        <MagnifyingGlassIcon class="mx-auto w-[19px] h-[19px] text-black" aria-hidden="true" />
                        <input class="h-full w-full bg-neutral-50 border-none shadow-none text-black text-base focus:shadow-none" type="text"
                            v-model="filters.search" v-on:keyup="index" id="searchexam" placeholder="Search" />
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div v-if="resources.data && resources.data.length">
                    <div class="flex flex-wrap items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200" v-for="(resource, index) in resources.data">
                        <div class="flex flex-wrap flex-col w-full md:w-4/5 mb-3 md:mb-0">
                            <div class="text-black text-base font-semibold mb-2">{{ resource.title }}
                            </div>
                            <div class="text-gray-600 text-base leading-relaxed mb-3">
                                <div v-html="resource.description"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-gray-600 text-[14px] mr-6">{{ resource.publish_from }}</div>
                                <div class="text-indigo-800 text-[14px] mr-6">{{ resource.resource_type }}</div>
                            </div>
                        </div>
                        <div class="flex w-full md:w-1/5">
                            <a v-if="$page.props.auth.user" href="javascript:void(0)" v-on:click="download(resource)"
                                class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium cursor-pointer">Download</a>
                            <a v-else :href="route('register')"
                                class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium cursor-pointer">Register To Download</a>    
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="border border-gray-300 p-3 text-gray-600">No Data Available</div>
                </div>
            </div>
            <Pagination v-if="resources.meta && resources.meta.links" :meta="resources" @pagechange="index" />
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
    components: {
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
            resources: {
                data: [],
                meta: []
            },
            current: 0
        }
    },
    methods: {
        create() {
            let vm = this;
            axios.get(route('website.components.create', { component: 'downloadableresources', type: vm.data.type })).then((response) => {
                vm.options = response.data;
            }).catch(error => {

            });
        },
        index(page = 1) {
            let vm = this;
            axios.post(route('website.components.index', { component: 'downloadableresources', page: page }), vm.filters).then((response) => {
                vm.resources = response.data;
            }).catch(error => {

            });
        },
        filter_postings(category) {
            this.current = category;
            this.filters.category = category;
            this.index();
        },
        view_more() {
            this.index(this.postings.meta.current_page + 1);
        },
        download(resource){
            let vm = this;
            let payload = {
                resource: resource.id
            }
            axios.post(route('website.components.download', {component: 'downloadableresources'}), payload).then(response => {
                if(response && response.data.success){
                    const link = document.createElement('a');
                    link.href = response.data.url;
                    link.download = response.data.title || 'downloaded_file';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    // window.download(response.data.url, "_blank");
                }
            }).catch(error => {

            });
        },
        downloadFile() {
            const fileUrl = 'your-file-download-url';
            const fileName = 'desired-filename.ext';

            const link = document.createElement('a');
            link.href = fileUrl;
            link.download = fileName || 'downloaded_file';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            }
    },
    computed: {
        can_show_more() {
            return (this.postings.meta.last_page <= this.postings.meta.current_page) ? false : true;
        }
    },
    mounted() {
        this.create();
        this.index();
    }
}
</script>


