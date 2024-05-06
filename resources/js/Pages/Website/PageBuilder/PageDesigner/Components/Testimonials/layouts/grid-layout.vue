<template>
    <div class="flex flex-col justify-center mb-12">
        <div class="text-center text-zinc-800 text-[26px] font-semibold">{{data.title}}</div>
        <div class="text-center text-gray-600 text-base">{{data.caption}}</div>
    </div>
    <!-- gap-8 grid grid-cols-1 grid-flow-row-dense custom_md:colums-2 custom_md:grid-cols-2 lg:columns-3 lg:grid-cols-3 columns-1 -->
    <div class="inline-block w-full columns-1 md:columns-2 lg:columns-3">
        <div class="inline-block w-full" v-for="(testimonial, index) in testimonials.data">
            <div class="flex flex-col  rounded-[9px] md:mr-3 mb-8 border " :class="{'bg-rose-100': index % 2 === 0, 'bg-yellow-50': index % 2 !== 0 }">
                <div class="bg-white rounded-[9px] border -mx-[1px]flex-1 flex flex-col-reverse items-center md:items-start md:flex-col border-zinc-200 relative px-4 py-6">
                    <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                        <img src="/images/homepage/left-quotes.png"/>
                    </div>
                    <div class="text-gray-600 text-base mb-7 text-center md:text-start mt-2" v-if="testimonial.testimonial_type == 1">
                        <div class="ck_content" v-html="testimonial.testimonial"></div>
                    </div>
                    <div class="text-gray-600 text-base mb-7 text-center md:text-start mt-2 " v-if="testimonial.testimonial_type == 2">
                        <video height="240" class="rounded-lg" controls>
                            <source :src="testimonial.testimonial" type="video/mp4">
                        </video>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center md:justify-start">
                        <div  v-if = "testimonial.profileimage" class="md:mr-4"><img class="w-[59px] h-[59px] rounded-full" :src=testimonial.profileimage /></div>
                        <div  v-else class="md:mr-4"> <div class="w-[59px] h-[59px] rounded-full bg-rose-100 text-blue-800 text-center p-3 text-2xl">{{ testimonial.profile[0] }}</div> </div>
                        <div class="flex flex-col mt-3 md:mt-0">
                            <div class="text-zinc-800 text-base text-center md:text-left font-semibold">{{ testimonial.name }}</div>
                            <div class="text-gray-600 text-sm text-center md:text-left">{{ testimonial.profile }}</div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 hidden md:block" v-if="testimonial.package"><div class="text-black text-sm font-medium">{{ testimonial.package }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-blue-800 text-md font-medium flex justify-center mt-8 mb-6" v-if="data.view_all"><a :href="data.view_all">View all testimonials <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
        testimonials: {
            type: Object,
            required: false
        },
    },
}
</script>
