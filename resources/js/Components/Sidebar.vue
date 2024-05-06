<script setup>
import { defineProps } from 'vue';
import { useStore } from 'vuex'
const store = useStore();
const props = defineProps({
    sidebarContent: Array
});

const navigation = store.getters.navigation;

if((navigation && !navigation.length) || (navigation == undefined)){
    store.dispatch('add_navigation', props.sidebarContent);
}
const menuitems = store.getters.navigation;  

const toggleCollapse = (index) => {
    menuitems[index].open = !menuitems[index].open;
    store.dispatch('add_navigation', menuitems);
};
import { ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/24/solid'
</script>

<template>
    <div class="menu-list-wrap">
        <ul class="menu_list mt-2">
            <template v-for="(item, index) in menuitems" :key="index">
                <li class="menu_list_item"
                :class="{ 'has-submenu collapseopen': item.open }" v-if="$can_show_menu_item(item?.capabilities)">
                    <template v-if="item.sublinks">
                        <a @click="toggleCollapse(index)" class="menu-link" :id="item.id">
                            <span class="menu-link-icon"><i class="{{ item.icon }}" aria-hidden="true"></i></span>
                            <span class="menu-link-label">{{ item.title }}</span>
                            <span
                                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none">
                                <ChevronRightIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!item.open"/>
                                <ChevronDownIcon class="mx-auto h-5 w-5 text-primary" aria-hidden="true" v-if="item.open"/>
                            </span>
                        </a>
                        <ul v-if="item.open" class="py-2 has-parent">
                            <template v-for="(sublink, subIndex) in item.sublinks" :key="subIndex">
                                <li v-if="$can_show_menu_item(sublink?.capabilities)" class="submenu-list-item p-2">
                                    <a :href="sublink.url" :class="{ 'active': item.active }" class="submenu-link">
                                        <span class="submenu-link-icon mr-3"></span>
                                        <span class="menu-link-label">{{ sublink.title }}</span>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </template>
                    <template v-else>
                        <a :href="item.url" class="menu-link" :id="item.id" :class="{ 'active': item.active }">
                            <span class="menu-link-icon"><i class="{{ item.icon }}" aria-hidden="true"></i></span>
                            <span class="menu-link-label">{{ item.title }}</span>
                        </a>
                    </template>
                </li>
            </template>
        </ul>
    </div>
</template>
