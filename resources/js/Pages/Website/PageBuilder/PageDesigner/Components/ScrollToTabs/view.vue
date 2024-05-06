<template>
    <div class="py-6 shadow-[0_4px_14px_rgba(0,0,0,0.04)]  md:shadow-[0_4px_14px_rgba(0,0,0,0.04)] sticky scrolltotabs_container bg-white top-0">
        <div class="max-w-screen-2xl list-container mx-auto w-full">
            <div class="flex overflow-x-auto touch-auto xs:no-scrollbar">
                <a href="javascript:void(0)" v-for="(tab, index) in data.tabs" class=" text-sm mr-8 flex-shrink-0"
                    :class="{ 'font-semibold text-rose-500': (index == active) }" :key="index"
                    v-on:click="scroll_to(index, tab.scroll_to)">{{ tab.name }}</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {

    },
    props: {
        data: {
            type: Object,
            required: true
        },
        edit: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            active: 0
        }
    },
    mounted() {
        if(!this.edit){
            var initial_offset = 0;
            window.onscroll = function () {
                var scrolltotabs_containers = document.getElementsByClassName("scrolltotabs_container");
                var container_offset = scrolltotabs_containers[0].offsetTop;
                if (!initial_offset) {
                    initial_offset = container_offset;
                }
                var header_height = document.getElementsByClassName("siteheader")[0].clientHeight;
                var pagebuilder_header = document.getElementsByClassName("page-designer-toolbar");
                if(pagebuilder_header.length>0){
                    header_height = pagebuilder_header[0].clientHeight+header_height-2;
                }
                // console.log((window.scrollY),initial_offset);
                if ((window.scrollY+20) > initial_offset) {
                    var parentwidth = scrolltotabs_containers[0].parentElement.clientWidth
                    //scrolltotabs_containers[0].style.width = parentwidth+'px';

                    scrolltotabs_containers[0].classList.add("scrolltotab_sticky");
                    if(screen.width>639){
                        scrolltotabs_containers[0].style.top = header_height+'px'
                    }else{
                        scrolltotabs_containers[0].style.top = '0px'
                    }
                } else {
                    //scrolltotabs_containers[0].style.width = 'auto';
                    scrolltotabs_containers[0].classList.remove("scrolltotab_sticky")
                }
            };
        }
    },
    methods: {
        scroll_to(index, tab) {

            this.active = index;
            // if (index) {
                var element = document.getElementById(tab);
                var headerOffset = 100;
                var elementPosition = element.getBoundingClientRect().top;
                var offsetPosition = element.offsetTop-headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
                // document.getElementById(tab).scrollIntoView({ behavior: "smooth" });
            //}
        }
    },
}
</script>


