<template>
    <div>
        <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-6">{{ data.title }}</div>
        <div class="tab_wrap">
            <ul class="flex  no-scrollbar overflow-x-auto text-sm font-medium text-center text-gray-500 tablist" id="resources_tablist"
                data-tabs-toggle="#resources_tablist" role="tablist">
                <template v-for="(category, index) in data.categories">
                    <li class="mr-2" role="presentation" v-if="category.show">
                        <a href="javascript:void(0)" v-on:click="switch_tab(category.slug)"
                            :class="{ 'active': active == category.slug }"
                            class="inline-block text-nowrap text- px-4 py-1 bg-white border border-gray-200 rounded text-gray-600 text-md font-medium" type="button"
                            role="tab" :aria-controls="category.slug" aria-selected="false">{{ category.label }}</a>
                    </li>
                </template>
            </ul>
        </div>
        <div>
            <div class="py-4" role="tabpanel">
                <template v-if="response && response.length && initialized">
                    <div class="flex flex-wrap items-center">
                        <component v-bind:is="active" :response="response"></component>
                    </div>
                    <div v-if="selected && selected.more && selected.more.link">
                        <div class="text-blue-800 text-md font-semibold flex justify-end mb-6">
                            <a :href="selected.more.link">{{ selected.more.label }}<span>
                                <img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-if="response && !response.length">
                    <div class="border border-gray-300 text-center p-3 text-gray-600 w-full" role="button">No Data
                        Available</div>
                </template>
            </div>
        </div>
    </div>
</template>
<script>
import Articles from "./tabs/articles.vue";
import CurrentAffairs from "./tabs/currentaffairs.vue";
import StudyMaterials from "./tabs/studymaterials.vue";
import Webinars from "./tabs/webinars.vue";
export default {
    components: {
        'article': Articles,
        'current-affair': CurrentAffairs,
        'studymaterials': StudyMaterials,
        'webinars': Webinars
    },
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    data() {
        return {
            active: 'webinars',
            response: [],
            initialized: false,
            selected: {}
        }
    },
    methods: {
        index(slug) {
            let vm = this;
            vm.initialized = false;
            axios.post(route('website.components.index', { component: 'free-resources' }), { category: slug }).then((response) => {
                vm.response = response.data.data;
                vm.initialized = true;
            }).catch(error => {

            });
        },
        switch_tab(slug) {
            this.index(slug);
            this.active = slug;
            this.selected = this.data.categories[this.active];
        }
    },
    mounted() {
        this.switch_tab(this.active);
    },
    computed: {

    }
}
</script>
