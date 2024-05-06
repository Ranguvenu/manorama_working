<template>
    <div class="flex flex-wrap lg:w-1/4 md:w-1/3 sm:w-1/2 w-full sm:pr-6 mb-4" v-for="(resource, index) in response">
        <div class="flex flex-col w-full bg-white rounded-[11px] border border-stone-300">
            <div><img :src="resource.thumbnail" class="w-full h-[200px] rounded-[11px] object-cover" /></div>
            <div class="py-4 px-3">
                <div class="text-zinc-800 text-sm font-medium truncate break-all">
                    <a class="text-rose-500 text-base font-semibold"
                      :href="route('frontend.package', { type: resource.page.type, page: resource.page.slug })">{{ resource.title }}</a>
                </div>
            </div>
            <div class="flex items-center pb-4" v-if="resource.rating && resource.rating.total">
                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white"
                    aria-hidden="true" />
                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">{{ resource.rating?.average}}</div>
                <div class="text-gray-600 text-xs mr-3">({{ resource.rating?.total}})</div>
            </div>
            <div v-if="resource && resource.pricing" class="border-t border-gray-200 flex items-center justify-between py-2">
                <a v-if="resource.accepting_enrolments" class="text-rose-500 text-base font-semibold" :href="route('frontend.package', { type: resource.page.type, page: resource.page.slug })">Enroll</a>
                <RequestCallbackButton v-else label="Notify" css_class="text-rose-500 text-base font-semibold"/>
                <!-- <h1 v-else>'dskdsdsdsdsd</h1> -->
            
                <div class="flex">
                    <div v-if="resource.pricing.actual_price" class="mr-3">
                        <span class="mr-1">₹</span>
                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">{{ resource.pricing.actual_price }}</span>
                    </div>
                    <div v-if="resource.pricing.selling_price">
                        <span class="mr-1">₹</span>
                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">{{ resource.pricing.selling_price }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import { StarIcon } from "@heroicons/vue/24/solid";
import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';
export default{
    props: {
        response: {
            type: Array,
            required: true
        }
    },
    components:{
        RequestCallbackButton,
        StarIcon
    },
    data(){
        return{

        }
    },
    methods: {

    },
    mounted(){

    }
}
</script>
