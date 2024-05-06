<template>
    <div class="flex items-center justify-between pb-6">
        <div class="flex items-center">
            <StarIcon class="h-6 w-6 mr-2 text-yellow-400" fill="currentColor" aria-hidden="true"/>
            <div class="text-zinc-800 text-2xl font-semibold">{{ ratings.average }} course rating</div>
        </div>
        <PackageRating :package="package" :current="current" :allowreview="allowreview" :edit_review="edit_review" @refresh="index" @close="edit_review = false"/>
    </div>
    <div v-if="package">
        <div class="flex flex-wrap flex-row" v-if="ratings.data && ratings.data.length">
            <div v-for="(rating, index) in ratings.data" class="sm:w-1/2 w-full pr-8 py-8 border-t border-zinc-300">
                <div class="flex items-center mb-6">
                    <div class="mr-4">
                        <img v-if="rating.avatar" :src="rating.avatar"
                        alt="Profile Picture of {{ rating.user }}"
                        class="w-[70px] h-[70px] rounded-full">
                        <img v-else src="/images/profile/profile.png" alt="Profile Picture of {{ rating.user }}"
                        class="w-[70px] h-[70px] rounded-full">
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex text-black text-lg font-semibold">
                            {{rating.user}}
                            <PencilSquareIcon v-if="$page.props.auth && $page.props.auth.user && ($page.props.auth.user.id === rating.user_id)" class="h-5 w-5 mx-3 text-gray-800 cursor-pointer" aria-hidden="true" v-on:click="edit(rating.id)"/>
                        </div>
                        <div class="flex items-center">
                            <vue3-star-ratings starSize="16" :disableClick="true" starColor="#FFC107" inactiveColor="#d6d6d6" v-model="rating.rating"/>
                            <div class="ml-2 text-gray-600 text-base">{{ rating.created_at }}</div>
                        </div>
                    </div>
                </div>
                <div class="text-zinc-800 text-base leading-relaxed">{{ rating.review }}</div>
            </div>
        </div>
        <div v-else>
            <div class="bg-rose-100 p-3 text-center text-rose-800 rounded">No Ratings Available</div>
        </div>
    </div>
    <div v-else>
        <div class="bg-rose-100 p-3 text-center text-rose-800 rounded">Please select a package</div>
    </div>
    <!-- <div class="py-3"><a href="#" class="text-blue-800 text-lg font-medium">View all reviews</a></div> -->
</template>
<script>
import PackageRating from '@/Modules/PackageRating/view.vue';
import { StarIcon } from "@heroicons/vue/24/solid";
import vue3StarRatings from "vue3-star-ratings";
import { PencilSquareIcon } from '@heroicons/vue/24/solid';

export default {
    props: {
        package: {
            type: Number,
            required: true
        }
    },
    components: {
        PencilSquareIcon,
        PackageRating,
        StarIcon,
        "vue3-star-ratings": vue3StarRatings
    },
    data() {
        return {
            ratings: {},
            edit_review: false,
            allowreview: false,
            current: 0,
        }
    },
    methods: {
        index() {
            let vm = this;
            if(!vm.package){
                return;
            }
            axios.get(route('package.rating.show', {package: vm.package})).then(response => {
                vm.ratings = response.data;
                vm.allowreview = response.data.allowreview;
            }).catch(error => {
                console.error(error);
            });
        },
        edit(ratings){
            this.current = ratings;
            this.edit_review = true;
        }
    },

    mounted() {
        this.index();
    }
}
</script>
