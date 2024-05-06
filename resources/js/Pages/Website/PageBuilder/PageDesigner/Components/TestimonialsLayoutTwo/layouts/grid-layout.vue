<template>
    <div class="text-black text-[22px] sm:text-[25px] font-semibold mb-2">{{data.title}}</div>
    <div class="text-black text-[22px] mb-4">{{ data.caption }}</div>
    <div class="flex flex-wrap justify-between my-6">
        <div v-for="(testimonial, index) in data.testimonials" class="md:w-1/2 mb-4 w-full flex justify-between">
            <div class="w-full flex custom_md:flex-wrap media_md:flex-wrap bg-neutral-100 rounded-[11px] px-6 py-6 md:mr-12">
                <div class="md:w-1/3 custom_md:w-full w-full items-center flex flex-wrap md:flex-col md:mr-8">
                    <img :src="testimonial.profile" class="flex justify-center rounded-full mb-2 w-[95px] h-[95px]"/>
                    <div class="flex flex-col flex-wrap media_md:ml-3">
                        <div class="text-black text-[15px] font-semibold mb-1">{{testimonial.name}}</div>
                        <div class="text-black text-[11px] mb-2">{{testimonial.university}}</div>
                        <img :src="testimonial.logo" class="w-[130px]"/>
                    </div>
                </div>
                <div class="md:w-2/3 custom_md:w-full w-full"><div class="text-black text-[15px] leading-[29px]">{{testimonial.description}}</div></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    computed:{

    },
    mounted(){

    }
}
</script>
