<template>
    <div class="flex flex-wrap lg:w-1/4 md:w-1/3 sm:w-1/2 w-full sm:pr-6 mb-4" v-for="(resource, index) in response">
        <div class="flex flex-col w-full bg-white rounded-[11px] border border-stone-300">
            <div><img :src="resource.thumbnail" class="w-full h-[200px] rounded-t-[11px] object-cover" /></div>
            <div class="py-4 px-3">
                <div class="text-zinc-800 text-sm font-medium truncate break-all">
                    <a title="{{ resource.title }}" :href="route('studymaterial.show', {material: resource.slug})">{{ resource.title }}</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: {
        response: {
            type: Array,
            required: true
        }
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
