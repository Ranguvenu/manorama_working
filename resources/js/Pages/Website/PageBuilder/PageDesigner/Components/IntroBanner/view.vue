<template>
    <div>
        <ul class="flex nav_list mb-1">
            <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
                <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
            </li>
        </ul>
        <div class="flex justify-between" >
            <div class="flex flex-col w-full md:w-1/2">
                <div class="text-zinc-800 text-[32px] font-semibold mb-4" v-if="data.main_heading">{{ data.main_heading }}</div>
                <div class="text-zinc-800 text-[15px] leading-relaxed mb-4" v-if="data.main_caption">{{ data.main_caption }}</div>
                <div class="mb-4 inline-flex mt-5">
                    <ActionButtonsView :buttons="data.buttons"/>
                </div>
            </div>
            <div class="md:flex hidden p-4 max-w-[50%]" :class="get_alignment_class(data.image.alignment)">
                <img :src="data.image.url" v-if="data && data.image && data.image.url" class="w-full"/>
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
        }
    },
    components: {
        ActionButtonsView
    },
    data() {
        return {

        }
    },
    methods: {
        get_alignment_class(position){
            let alignment = '';
            switch(position){
                case 'top':
                    alignment = 'items-start';
                    break;
                case 'bottom':
                    alignment = 'items-end';
                    break;
                case 'center':
                    alignment = 'items-center';
                    break;
                default:
                    alignment = 'items-start';
                    break;
            }
            return alignment;
        }
    },
    mounted() {

    }
}
</script>


