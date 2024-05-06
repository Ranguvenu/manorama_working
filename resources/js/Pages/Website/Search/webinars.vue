<template>
    <div v-if="response && response.data && response.data.length">
        <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3">Webinars</div>
        <div class="flex flex-wrap md:w-1/4 sm:w-1/2 w-full sm:pr-6 mb-4" v-for="(resource, index) in response.data">
            <div class="flex flex-col w-full bg-white rounded-[11px] border border-stone-300">
                <div><img :src="resource.thumbnail" class="w-full h-[200px] rounded-[11px] object-cover" /></div>
                <div class="py-4 px-3">
                    <div class="text-zinc-800 text-sm font-medium truncate break-all">
                        <a :title="resource.title" :href="route('webinar.show', {webinar: resource.slug})">{{ resource.title }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            response: {
                type: Array,
                required: true
            }
        },
        data(){
            return {

            }
        },
        methods:{

        },
        mounted(){

        }
    }
</script>
