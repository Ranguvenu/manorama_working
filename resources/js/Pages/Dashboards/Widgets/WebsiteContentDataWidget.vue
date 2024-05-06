<template lang="">
    <div class="m-2 flex items-center flex-col rounded shadow-md bg-white">
        <div class="heading py-3 mx-6 mt-4 mb-2 px-10 flex-grow-1 w-72 justify-center flex rounded-full bg-secondary/[0.1] ">
            <span class="text-xs font-medium">Website Content (Total/Active)</span>
        </div>
        <div class="content_container w-full mt-2">
            <div class="flex mb-2 justify-start items-center  w-full p-3">
                <div class="icon rounded-md bg-primary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/website_content/Articles.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Articles
                </div>
                <div class="w-fit text-primary me-2 text-sm font-semibold">
                    {{ data.articles.total }}/{{ data.articles.active }}
                </div>
            </div>
            <div class="flex mb-2 bg-secondary/10 justify-start  items-center w-full p-3">
                <div class="icon rounded-md bg-secondary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/website_content/Blog.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Current Affairs
                </div>
                <div class="w-fit text-secondary me-2 text-sm font-semibold">
                    {{ data.currentaffairs.total }}/{{ data.currentaffairs.active }}
                </div>
            </div>
            <div class="flex  justify-start items-center w-full  p-3">
                <div class="icon rounded-md bg-primary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/website_content/Resources.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Resources
                </div>
                <div class="w-fit text-primary me-2 text-sm font-semibold">
                    {{ data.resources.total }}/{{ data.resources.active }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            data: {
                articles: {},
                currentaffairs: {},
                resources: {},
            }
        }
    },
    methods:{
        index(){
            let vm = this;
            axios.get(route('reports.website_content')).then( (response) => {
                vm.data = response.data;
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.index();
    }
}
</script>
<style lang="">

</style>
