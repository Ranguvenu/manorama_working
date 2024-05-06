<template>
    <div class="lg:overflow-hidden max-w-screen-2xl mx-auto px-4 md:px-16">
        <div class="flex media_lg:flex-wrap items-center justify-between media_lg:flex-col-reverse">
            <div class="flex flex-col w-full md:justify-center md:items-center lg:justify-normal lg:items-start lg:w-1/2 lg:pr-3 py-4 ">
                <div class="text-zinc-800 text-[26px] font-semibold text-center md:text-left">{{data.title}}</div>
                <div class="text-zinc-800 text-md mb-4 text-center lg:text-left md:text-center">{{data.caption}}</div>
                <div class="flex justify-center md:justify-normal -mx-4">
                    <ActionButtonsView :buttons="data.buttons"/>
                </div>
            </div>
            <!-- <div class="flex custom_md:w-1/2 hidden lg:min-w-[724px] media_lg:w-full mobileview_wrap media_lg:mb-4 h-[409px]">
                <div class="relative mobileview_container flex-auto">
                    <div class="lg:w-[724px] lg:h-[733px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c1">
                        <div class="lg:w-[602px] lg:h-[609px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c2">
                            <div class="lg:w-[493px] lg:h-[499px] w-full rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c3">
                                <div class="w-[388px] media_xs:w-[360px] lg:h-[399px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c4">
                                    <div class="relative top-[9px] mobileview-imgwrap">
                                        <div class="absolute top-[46px] left-0 z-[1] mobileview_imgleft"><img :src="data.images.image_1" /></div>
                                        <div class="absolute top-0 left-[85px] z-[2] media_lg:left-[75px] mobileview_imgmiddle"><img :src="data.images.image_2" /></div>
                                        <div class="absolute top-[46px] right-0 z-[1] mobileview_imgright"><img :src="data.images.image_3" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="flex w-full md:w-3/4 lg:w-1/2 mobile_xs:h-[400px] md:min-h-[500px]">
                <div class="relative">
                    <img src="/images/ctathreelayoutbg.svg" alt="" class="w-full h-full">
                    <div class="absolute top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center mobile_xs:h-[300px] sm:h-[400px]">
                            <div class="mobileview_imgleft absolute left-[15%] xs:left-[20%] md:left-[18%] top-[10%] h-full"><img :src="data.images.image_1"  class="object-contains p-4 h-[80%] max-h-100%"  /></div>
                            <div class="mobileview_imgmiddle absolute left-auto right-auto z-30 h-full"><img :src="data.images.image_2" class="object-contains p-4 h-[100%] max-h-100%" /></div>
                            <div class="mobileview_imgright absolute right-[15%] md:right-[20%] top-[10%] z-0 h-full"><img :src="data.images.image_3" class="object-contains p-4 h-[80%] max-h-100%" /></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {
        ActionButtonsView

    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {
    },
    computed: {

    }
}
</script>
