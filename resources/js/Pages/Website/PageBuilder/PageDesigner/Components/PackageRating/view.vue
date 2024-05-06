<template>
    <PackageRating :package="data.package"/>
</template>
<script>
import PackageRating from '@/Modules/PackageRating/index.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        },
    },
    components: {
        PackageRating
    },
    data() {
        return {

        }
    },
    methods: {
        
    },
    mounted() {

    }
}
</script>
