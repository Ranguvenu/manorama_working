<template>
    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-8">{{data.title}}</div>
    <div class="flex flex-row flex-wrap">
        <div class="md:w-1/3 sm:w-1/2 media_xs:w-1/2 sm:pr-8 pr-4 mb-4 mentors_list" v-for="(mentor, index) in data.mentors">
            <div class="flex flex-col">
                <div class="mb-4 w-full h-[300px]" ><img class="rounded-[11px] w-full h-[300px] object-cover" :src="mentor.profile"/></div>
                <div class="text-zinc-800 text-base font-medium mb-2">{{ mentor.name }}</div>
                <div><a :href="mentor.linkedin"><img class="w-6 h-6" src="/images/abroad/linkedin-blue.png"/></a></div>
            </div>
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
