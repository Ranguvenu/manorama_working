<template>
    <div class="flex ml-2">
        <a href="javascript:void(0)" class="bg-red-50 rounded border border-rose-500 px-[10px] py-[7px] text-center text-rose-500 text-sm font-medium" v-on:click="show = true">View Courses </a>
    </div>
    <Modal :show="show" max-width="fw" @close="close">
        <div class="p-4">
            <div class="w-full flex items-center justify-between sm:justify-end sm:pe-5 sm:ps-3 media_sm:border-b border-gray-200 media_sm:pb-3">
                <div class="sm:hidden text-zinc-800 text-base font-semibold">All Courses</div>
                <div class="hidden sm:flex"><a href="javascript:void(0)" class="text-primary float-right" v-on:click="close">Close</a></div>
                <div class="sm:hidden"><a href="javascript:void(0)" class="text-primary float-right" v-on:click="close">Cancel</a></div>
            </div>
            <!-- render for other devices -->
            <div class="media_sm:hidden grid grid-cols-12 lg:gap-x-12 md:gap-x-8 sm:gap-x-4 gap-y-6 mt-2 p-3">
                <div class="lg:col-span-3 md:col-span-4 sm:col-span-6 col-span-12" v-for="(menu, index) in $page.props.menu_settings">
                    <div class="w-full border-b border-gray-300 mb-3">
                        <div class="text-black text-[16px] font-semibold pb-2" v-if="menu.title">
                            <a :href="menu.url">{{ menu.title }}</a>
                        </div>
                    </div>
                    <div class="mb-5" v-for="(category, catindex) in menu.categories">
                        <div class="text-black text-[15px] font-medium my-3" v-if="category.title">
                            <a :href="category.url">{{ category.title }}</a>
                        </div>
                        <div class="text-zinc-700 text-[15px] mb-3" v-for="(item, itemindex) in category.items">
                            <a :href="item.url">{{ item.title }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Conditionally render accordion for mobile devices -->
            <div class="grid grid-cols-12  sm:gap-x-4 gap-y-4 mt-2" v-if="isMobile">
                <div class="lg:col-span-3 md:col-span-4 sm:col-span-6 col-span-12" v-for="(menu, index) in $page.props.menu_settings" :key="index">
                    <div class="w-full border-b border-gray-300 flex justify-between items-center">
                        <div class="text-zinc-800 text-[15px] font-medium" v-if="menu.title">
                            <a :href="menu.url">{{ menu.title }}</a>
                        </div>
                        <div>
                            <span @click="toggleAccordion(index)" :aria-expanded="isOpen[index]" :aria-controls="'accordion-collapse-body-' + index" class="flex items-center justify-between w-full py-3 text-zinc-800 text-base">
                                <!-- <svg :class="{'rotate-180': isOpen[index]}" data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg> -->

                                <svg :class="{'rotate-180': isOpen[index]}" data-accordion-icon class="w-5 h-5 shrink-0" aria-hidden="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-4 gap-y-4">
                        <div class="col-span-6" v-for="(category, catindex) in menu.categories"  v-if="isOpen[index]" :id="'accordion-collapse-body-' + index">
                            <div class="text-black text-base font-medium my-2" v-if="category.title">
                                <a :href="category.url">{{ category.title }}</a>
                            </div>
                            <div class="text-zinc-800 text-base mb-1" v-for="(item, itemindex) in category.items">
                                <a :href="item.url">{{ item.title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t"></div>
            <div class="hidden md:flex flex-wrap items-center ps-3 md:mt-4">
                <div class="text-neutral-900 text-base font-medium mr-4 w-full mb-2">Follow us on</div>
                <div class="mr-3"><a :href = $page.props.theme_settings.facebook ><img  src="/images/socialicon/facebook.png" alt="Facebook" /></a></div>
                <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.instagram"><img  src="/images/socialicon/instagram.png" alt="Instagram" /></a></div>
                <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.youtube"><img  src="/images/socialicon/youtube.png" alt="YouTube" /></a></div>
                <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.linkedin"><img  src="/images/socialicon/linkedin.png" alt="LinkedIn" /></a></div>
                <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.pininterest"><img  src="/images/socialicon/pinterest.png" alt="Pinterest" /></a></div>
            </div>
            <div class="md:hidden flex flex-col sm:ps-3 mt-4">
                <div class="text-black text-base font-semibold mb-3">Contact Us</div>
                <ul class="text-black text-sm font-medium">
                    <li class="mb-3 flex">
                        <img  src="/images/contactus/mail.png" alt="Email Us on" class="mr-2" /><a href="#" class=" hover:underline">{{ $page.props.theme_settings.contactemail}}</a>
                    </li>
                    <li class="mb-3 flex">
                        <img  src="/images/contactus/call.png" alt="Call Us on" class="mr-2" /><a href="#" class="hover:underline">{{ $page.props.theme_settings.contactphone }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
export default {
    components:{
        Modal
    },
    data() {
        const isOpen = this.$page.props.menu_settings.map(menu => false);
        return {
            show: false,
            isMobile: false,
            isOpen

        }
    },
    methods: {
        close(){
            this.show = false;
        },
        checkIsMobile() {
            // Set isMobile based on the device width
            this.isMobile = window.innerWidth <= 639; // Adjust the width as per your requirements
        },
        toggleAccordion(index) {
            this.isOpen[index] = !this.isOpen[index];
        }
    },
    mounted() {
        // Check the device width on component mount and resize
        this.checkIsMobile();
        window.addEventListener('resize', this.checkIsMobile);
    },
    beforeUnmount() {
        // Remove the event listener on component destroy
        window.removeEventListener('resize', this.checkIsMobile);
    }
}
</script>
