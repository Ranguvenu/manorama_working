<template>
    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-6">{{ data.title }}</div>
    <template v-if="isinitialized">
        <div v-for="(course, index) in data.packages"
            class="flex w-full flex-row flex-wrap bg-white rounded-[7px] border border-dashed border-rose-600 p-3 items-center justify-between mb-4">
            <div class="flex media_md:mb-3 md:w-3/4 w-full">
                <div class="hidden md:block w-full md:w-[180px]"><img class="rounded-[14px] md:h-[150px] md:w-[180px] object-fill" :src="course.thumbnail" /></div>
                <div class="flex flex-col flex-grow px-4">
                    <div class="flex self-start mb-2 items-center">
                        <img class="mr-1" src="/images/product/hand-indicator.png" />
                        <div class="text-zinc-800 text-xl font-semibold">{{ get_title(course.package) }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="text-black-1000 text-[13px] mr-6">{{ course.instructor }}</div>
                        <div><span class="text-gray-600 text-[13px] mr-2">Batch start from</span>
                            <span class="text-black-1000 text-sm">{{ course.start_date }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex md:w-1/4 w-full justify-center md:justify-end">
                <a :href="get_url(course.package)"
                    class="px-[18px] my-2 py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">{{ course.button_title }}</a>
            </div>
        </div>
    </template>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {

    },
    data() {
        return {
            packages: 0,
            isinitialized: false
        }
    },
    methods: {
        index() {
            let vm = this;
            let payload = {
                packages: vm.data?.packages
            };
            axios.post(route('website.components.index', { component: 'other-courses' }), payload).then(response => {
                vm.packages = response.data;
                vm.isinitialized = true;
            }).catch(error => {

            });
        },
        get_url(id) {
            let index = this.packages.findIndex(x => x.id == id);
            if (index > -1) {
                let packages = this.packages[index];
                return route('frontend.package', { type: packages.page.type, page: packages.page.slug });
            }
            return '';
        },
        get_title(id) {
            let index = this.packages.findIndex(x => x.id == id);
            if (index > -1) {
                let packages = this.packages[index];
                return packages.title;
            }
            return '';
        }
    },
    mounted() {
        this.index();
    },
    watch: {
      data: {
        handler() {
            this.index();
        },
      },
    },
    computed: {

    }
}
</script>
