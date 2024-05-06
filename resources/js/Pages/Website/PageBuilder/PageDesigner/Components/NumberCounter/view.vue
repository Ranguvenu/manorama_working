<template>
    <div class="text-3xl font-bold pb-10" v-if="data.title">{{ data.title }}</div>
    <div class="w-full  lg:overflow-x-scroll no-scrollbar rounded-[9px] shadow border py-6 md:px-12 px-4" :style="{backgroundColor: data.background_color, borderColor: data.border_color}">
        <div class="flex items-center gap-4 overflow-x-auto" >
            <div class="w-[200px] flex-shrink-0 items-center" v-for="(item, index) in data.items">
                <div class="flex items-center">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img :src="item.icon"/>
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1">
                            <span class="text-[28px] font-semibold me-1" :style="{color: data.secondary_color}" v-if="(item.display_operator == '1')"> {{ item.operator }}</span>
                            <span class="text-[28px] font-semibold " :style="{color: data.primary_color}"><AnimatedNumber :number="item.count" :edit="edit"/></span>
                            <span class="text-[28px] font-semibold ml-1" :style="{color: data.secondary_color}" v-if="(item.display_operator == '2')"> {{ item.operator }}</span>
                        </div>
                        <div class="text-gray-500 text-sm ">{{ item.description }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AnimatedNumber from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/AnimatedNumber/view.vue';
export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        AnimatedNumber
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
