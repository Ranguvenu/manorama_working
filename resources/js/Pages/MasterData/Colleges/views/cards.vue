<template>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5" v-if="results && results.length">
            <div class="bg-white rounded shadow mb-4" v-for="(data, index) in results">
                <div class="flex p-4">
                    <div class="me-3 w-16 h-16 rounded-full">
                        <img v-if="data.logo" :src="data.logo" />
                        <PhotoIcon v-if="!data.logo" class="text-primary h-15 w-15" aria-hidden="true"/>
                    </div>
                    <div class="grow">
                        <h4 v-if="data.name.length >= 10" class="mb-3">{{ data.name.slice(0,40)+'...' }}</h4>
                        <h4 v-else class="mb-3">{{ data.name }}</h4>
                        <p class="text-sm text-gray-500">{{ data.address }}</p>
                        <div class="flex mt-2">
                            <InboxArrowDownIcon class="shrink-0 me-2 text-secondary h-5 w-5" aria-hidden="true"/>
                            <p class="text-sm text-gray-500">{{ data.email }}</p>
                        </div>
                        <div class="flex mt-2">
                            <GlobeAltIcon class="shrink-0 me-2 text-secondary h-5 w-5" aria-hidden="true"/>
                            <p class="text-sm text-gray-500">{{ data.website }}</p>
                        </div>
                    </div>
                    <div>
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('view-college')" v-on:click="$emit('view', data.id)" class="block py-1 px-4 actions_icon">View</a>
                                <a href="javascript:void(0)" v-if="$has_capability('edit-college')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-college')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
                            </div>
                          </template>
                        </ActionsDropdown>
                    </div>
                </div>
                <div class="border mb-2"></div>
                <div class="flex items-center justify-between px-2">
                    <div v-if=data.brochure>
                        <a v-bind:href="data.brochure" download>
                            <div class="inline-flex items-center gap-1">
                                <i class="shrink-0 w-7 h-7">
                                    <ArrowDownTrayIcon class="me-1 text-primary" aria-hidden="true"/>
                                </i>
                                <span class="text-secondary text-sm">Brochure</span>
                            </div>
                        </a>
                    </div>
                    <div v-else>
                        <div class="inline-flex items-center gap-1 cursor-default opacity-70">
                            <i class="shrink-0 w-7 h-7">
                                <ArrowDownTrayIcon class="me-1 text-primary" aria-hidden="true"/>
                            </i>
                            <span class="text-secondary text-sm">Brochure</span>
                        </div>
                    </div>
                    <div v-if=data.application_form>
                        <a v-bind:href="data.application_form" download>
                            <div class="inline-flex items-center gap-1">
                                <i class="shrink-0 w-7 h-7">
                                    <ArrowDownTrayIcon class="me-1 text-primary" aria-hidden="true"/>
                                </i>
                                <span class="text-secondary text-sm">Application</span>
                            </div>
                        </a>
                    </div>
                    <div v-else>
                        <div class="inline-flex items-center gap-1 cursor-default opacity-70">
                            <i class="shrink-0 w-7 h-7">
                                <ArrowDownTrayIcon class="me-1 text-primary" aria-hidden="true"/>
                                </i>
                            <span class="text-secondary text-sm">Application</span>
                        </div>
                    </div>
                    <a href="javascript:void(0)">
                        <div class="inline-flex items-center gap-1">
                            <span class="text-secondary text-sm mb-3 cursor-default">Followers</span>
                        </div>
                    </a>
                    <a href="javascript:void(0)">
                        <div class="inline-flex items-center gap-1 cursor-default">
                            <i class="shrink-0 w-7 h-7">
                                <img src="/images/college_card_icons/Favourites.png" alt="">
                            </i>
                            <span class="text-secondary text-sm">Favourites</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="border border-gray-300 text-center p-3 text-gray-400">No Data Available</div>
        </div>
    </div>
</template>
<script>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import ActionsDropdown from '@/Components/ActionsDropdown.vue';
    import { GlobeAltIcon } from "@heroicons/vue/24/solid";
    import { InboxArrowDownIcon } from "@heroicons/vue/24/solid";
    import { PhotoIcon } from "@heroicons/vue/24/outline";
    import { ArrowDownTrayIcon } from "@heroicons/vue/24/outline";
    export default{
        components:{
            PrimaryButton,
            ActionsDropdown,
            GlobeAltIcon,
            InboxArrowDownIcon,
            PhotoIcon,
            ArrowDownTrayIcon,
        },
        props:{
            results: {
                type: Array,
                required: true
            }
        },  
        data(){
            return{

            }
        },
        methods:{
        },
        mounted(){
            
        }
    }
</script>
