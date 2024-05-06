<template>
    <div class="mt-2 text-right">
        <TailwindPagination :data="meta" :limit="2" :keepLength="true"
            :item-classes="['text-primary', 'border', 'border-rose-300']"
            :active-classes="['text-white', 'bg-primary', 'border-0', 'border-rose-300']" @pagination-change-page="change_page">
        </TailwindPagination>
    </div>
</template>
<script>
import { TailwindPagination } from 'laravel-vue-pagination';

export default {
    props: {
        meta: Object
    },
    components: {
        TailwindPagination
    },
    data() {
        
    },
    watch: {
        
    },
    methods: {
        change_page(page) {
            this.$emit('pagechange', page);
        }
    },
    mounted() {

    }
}
</script>
