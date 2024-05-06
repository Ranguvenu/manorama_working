<template>
        <div class="text-zinc-800 text-[25px] font-semibold mb-6">{{data.title}}</div>
        <div v-for="(item, index) in data.packages" class="flex items-center flex-wrap justify-between p-4 bg-fuchsia-50 rounded-[11px] border border-gray-200 mb-4">
            <div class="flex w-full md:w-3/4 flex-col">
                <div class="w-full mb-2"><span class="bg-green-600 rounded-[3px] text-white text-sm font-semibold px-3 py-1">FREE</span></div>
                <div class="text-zinc-800 text-lg font-medium leading-[27px] mb-4">{{ get_title(item.package) }}</div>
                <div class="flex flex-col md:flex-row md:items-center">
                    <div class="flex items-center pr-6">
                        <div class="mr-2 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg></div>
                        <div class="text-gray-600 text-[16px]">{{item.questions}}</div>
                    </div>
                    <div class="flex items-center pr-6">
                        <div class="mr-2 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" /></svg></div>
                        <div class="text-gray-600 text-[16px]">{{item.marks}}</div>
                    </div>
                    <div class="flex items-center pr-6">
                        <div class="mr-2 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                        <div class="text-gray-600 text-[16px]">{{item.duration}}</div>
                    </div>
                </div>
            </div>
            <div class="w-full flex item-center md:justify-center py-2 md:w-1/4">
                <a :href="get_url(item.package)" class="px-[18px] py-2.5 bg-rose-500 rounded-[5px] border-rose-500 text-white text-base font-medium leading-[27px]">View Details</a>
            </div>
        </div>
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
            packages: [],
            isinitialized: false
        }
    },
    methods: {
        index() {
            let vm = this;
            let payload = {
                packages: vm.data?.packages
            };
            axios.post(route('website.components.index', { component: 'free-test' }), payload).then(response => {
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
    
