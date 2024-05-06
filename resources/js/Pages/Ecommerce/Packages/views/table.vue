<template>
    <div>
        <div class="flex flex-row flex-wrap" v-if="results && results.length">
            <div class="lg:w-1/3 md:w-1/2 w-full pr-4 mb-4 flex flex-wrap" v-for="(result, index) in results" :key="index">
                <div class="w-full bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 flex flex-col shadow-[0_4px_14px_rgba(1,1,1,0.2)] rounded-lg">
                    <div class="relative">
                        <img class="rounded-tl-lg rounded-tr-lg w-full min-h-[185px] max-h-[185px] object-cover" :src="result.thumbnail" :alt="result.title" />
                        <div class="absolute  left-[10px] bottom-[15px] ">
                            <span class="text-white rounded-xl px-3 me-2 py-1 text-xs bg-green-800"
                                v-if="result.published">Published</span>
                            <span class="text-white rounded-xl px-3 me-2 py-1 text-xs bg-yellow-800"
                                v-if="!result.published">Draft</span>
                            <span class="text-white rounded-xl px-4 py-1 text-xs bg-primary ">{{ result.payment_type
                            }}</span>
                        </div>
                        <div class="absolute right-[5px] top-[5px] bg-white px-1 rounded-lg packages_actions_wrap">
                            <ActionsDropdown align="right">
                                <template v-slot:content :class="packages_actions_container">
                                    <div class="divide-y border-lightestgrey">
                                        <a :href="route('ecommerce.packages.edit', { package: result.id, slug: 'package' })"
                                        v-if="$has_capability('edit-package')"  class="block py-1 px-4 actions_icon">Edit</a>
                                        <a href="javascript:void(0)" v-on:click="$emit('delete', result)"
                                        v-if="$has_capability('delete-package')" class="block py-1 px-4 actions_icon">Delete</a>
                                        <a href="javascript:void(0)" v-on:click="publish(result)"
                                            class="block py-1 px-4 actions_icon"
                                            v-if="result.published == false">Publish</a>
                                        <a v-if="result.haspage" :href="route('frontend.package', { type: result.package_type, page: result.page.page })"
                                            class="block py-1 px-4 actions_icon" target="__blank">View Marketing Page</a>
                                        <a v-if="$has_capability('design-website-pages') && result.haspage"
                                            :href="route('website.pages.components.index', [result.page_id])"
                                            class="block py-1 px-4 actions_icon" target="__blank">Design Marketing Page</a>
                                    </div>
                                </template>
                            </ActionsDropdown>
                        </div>
                    </div>
                    <div class="rounded-bl-lg rounded-br-lg px-4 pb-6 mt-5">
                        <div class="text-zinc-800 text-base font-semibold mb-3 leading-tight"><a :href="route('ecommerce.packages.show', { package: result.id })">{{ result.title }}</a></div>
                        <div class="bg-gray-300 px-2 py-1 text-sm">
                            <span>Validity: </span><span>{{ result.validity_value }}</span> 
                            <span v-if="(result.validity_type == 'days')"> Days from purchase</span>
                        </div>
                        <div class="border-t border-gray-300 mt-5 pt-2">
                            <span class="text-sm">Courses : {{ result.total_courses }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="border border-gray-300 text-center p-3 text-gray-400 text-center">No Data Available</div>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import ActionsDropdown from '@/Components/ActionsDropdown.vue';

export default {
    components: {
        Link,
        ActionsDropdown
    },
    props: {
        results: {
            type: Array,
            required: true
        },
        type: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            CurrentUrl: window.location.href,
        }
    },
    methods: {
        publish(data) {
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to Publish?`,
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Publish"
            }).then((response) => {
                if (response.value) {
                    axios.put(route("ecommerce.packages.publish", {package: data.id})).then(response => {
                        this.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Publish.', {
                            position: 'bottom-right'
                        });

                    });
                }
            });
        }
    },
    mounted() {

    }
}

</script>
