<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { PlayIcon } from "@heroicons/vue/24/solid";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MultiSelect from '@/Components/MultiSelect.vue';

    export default{
    components:{
        InputError,
        InputLabel,
        TextInput,
        MagnifyingGlassIcon,
        MultiSelect,
        PlayIcon
    },
    data(){
        return{
            
        }
    },
    methods:{
        
    },
    watch: {
        
    },
    mounted(){
        
    }
}
</script>
<template>
    <Head title="Home" />
    <header class="max-w-screen-2xl mx-auto bg-white shadow px-16 siteheader w-full sm:fixed sm:h-[90px] top-0 z-[10]">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="pr-4"><img  src="/images/homepage/homelogo.png" alt="Logo" /></div>
                <div class="flex items-center px-4 py-2 rounded-md justify-between searh_wrap ml-8">
                    <span class="search_label">What do you want to learn</span>
                    <span class="search_icon"><MagnifyingGlassIcon class="mx-auto h-4 w-4 text-gray-1000" aria-hidden="true"/></span>
                </div>
            </div>
            <div class="items-center flex">
                <div class="w-28 h-[34px] relative ml-2">
                    <div class="w-28 h-[34px] left-0 top-0 absolute bg-primary-50 rounded border border-primary"></div>
                    <div class="left-[8px] top-[6px] absolute text-center text-rose-500 text-sm font-medium">View Courses </div>
                </div>
                <span class="pl-17"><img  src="/images/homepage/whatsapp_rounded.png" alt="Logo" /></span>
                <span class="pl-17"><img  src="/images/homepage/call_rouned.png" alt="Logo" /></span>
                <div class="pl-17 flex-col items-start inline-flex">
                    <div class="text-center text-stone-300 text-xs font-medium">Talk to our experts</div>
                    <div class="text-center text-black text-sm font-medium">1800-120-456-456</div>
                </div>
                <div class="pl-17"><Button class="px-6 font-medium m-0" size="sm" color="primary">Login</Button></div>
            </div>
        </div>
    </header>
    <div class="content-wrap mt-[90px]">
        <div class="max-w-screen-2xl mx-auto px-16 pt-8 pb-12 bg_gray_to_pink">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Course Listing</a>
                </li>
            </ul>
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2 mt-12 px-6">
                    <div class="mb-4 text-4xl font-semibold leading-[44px]"><span class="text-zinc-800 ">Manorama Horizon empowers you to </span><span class="text-rose-500">upgrade your skills</span></div>

                    <div class="text-zinc-800 text-base leading-relaxed mb-4">Develop critical tech skills. Cut cycle times. Build happier, healthier tech teams.</div>

                    <div class="mb-4 inline-flex">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium mr-3">Select Course</a>
                    </div>
                </div>
                <div class="flex sm:w-1/2 items-center px-6 justify-end">
                    <div class="flex justify-end items-center bg-gradient-to-l from-rose-100 via-purple-100 to-violet-50 rounded-[15px] px-12 py-8">
                        <div class="flex flex-col mr-12">
                            <div class="text-black text-[32px] font-semibold leading-[46px]">BUILDING <br/> AI PRODUCTS</div>
                            <div class="text-black text-xl mb-6">For Aspiring AI PMs</div>
                            <div class="flex mb-1"><img class="w-12 h-12 mr-4" src="/images/google48.png" alt="google"><img class="w-12 h-12 mr-4" src="/images/metaverse48.png" alt="metaverse"></div>
                        </div>
                        <div class="flex flex-col items-center justify-center"><div>
                            <img class="w-48 h-48 mr-4" src="/images/ai_profilelg.png"></div>
                            <div class="text-black text-xs font-medium mb-2"> By Alex </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 shadow-[0_4px_14px_rgba(0,0,0,0.04)]">
            <div class="flex">
                <a href="courses" class="text-rose-500 text-base font-semibold mr-8">Courses</a>
                <a href="instructors" class="text-zinc-800 text-base mx-8">Past Courses</a>
                <a href="testimonials" class="text-zinc-800 text-base mx-8">Testimonials</a>
                <a href="faq" class="text-zinc-800 text-base mx-8">FAQ</a>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3" id="courses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] ">What we offer</div>
            <div class="tab_wrap py-6">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" id="resources_tablist" data-tabs-toggle="#resources_tablist" role="tablist">
                    <li class="mr-2" role="presentation">
                        <a href="#" class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-base font-semibold active" id="all" data-tabs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">All</a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="inline-block px-4 py-1 rounded text-gray-600 text-base font-medium" id="technical" data-tabs-target="#technical" type="button" role="tab" aria-controls="technical" aria-selected="false">Technical</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"  class="inline-block px-4 py-1 rounded text-gray-600 text-base font-medium" id="nontech" data-tabs-target="#nontech" type="button" role="tab" aria-controls="nontech" aria-selected="false">Non Technical</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap flex-row items-center">
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-blue-800 text-md font-semibold flex justify-end mb-6"><a href="#">View All Courses <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3 bg-pink-50" id="pastcourses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px]">Past Courses</div>
            <div class="tab_wrap py-6">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" id="resources_tablist" data-tabs-toggle="#resources_tablist" role="tablist">
                    <li class="mr-2" role="presentation">
                        <a href="#" class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-base font-semibold active" id="all" data-tabs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">All</a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="inline-block px-4 py-1 rounded text-gray-600 text-base font-medium" id="technical" data-tabs-target="#technical" type="button" role="tab" aria-controls="technical" aria-selected="false">Technical</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"  class="inline-block px-4 py-1 rounded text-gray-600 text-base font-medium" id="nontech" data-tabs-target="#nontech" type="button" role="tab" aria-controls="nontech" aria-selected="false">Non Technical</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap flex-row items-center">
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/4 pr-6 mb-6">
                    <div class="shadow-[0_4px_14px_rgba(0,0,0,0.04)] border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                        <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                            <div class="inline-flex flex-col w-3/4 pr-4">
                                <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                                <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                            </div>
                            <div class="inline-flex items-center flex-col">
                                <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                                <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                            </div>
                            <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                        </div>
                        <div class="px-3 pt-4 rounded-bl-[12px] rounded-br-[12px]">
                            <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                            <!-- <div class="flex items-center pb-4">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                                <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                            </div> -->
                            <div class="border-t border-gray-200 flex items-center justify-between py-2">
                                <a href="#" class="text-rose-500 text-base font-semibold">Enroll</a>
                                <div class="flex">
                                    <div class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">1500</span>
                                    </div>
                                    <div>
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-blue-800 text-md font-semibold flex justify-end mb-6"><a href="#">View All Courses <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-8">
            <div class="w-[293px] h-[31px] text-zinc-900 text-2xl font-semibold leading-[35px] mb-4">Knowledge Partner</div>
            <div class="flex items-center justify-between py-8">
                <img src="/images/homepage/iiit-kottayam.png" />
                <img src="/images/homepage/learning-hub.png" />
                <img src="/images/homepage/cox-logo.png" />
                <img src="/images/homepage/duke-logo.png" />
                <img src="/images/homepage/bimtech-logo.png" />
                <img src="/images/homepage/stem-logo.png" />
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-8 bg-gradient-to-l from-rose-100 via-purple-100 to-violet-50">
            <div class="flex flex-col justify-center">
                <div class="flex justify-center mb-2"><img src="/images/homepage/emoji-happy.png" /></div>
                <div class="text-center text-black text-[26px] font-semibold leading-[35px] mb-3">Still confused about choosing? </div>
                <div class="flex justify-center mb-6">
                    <div class="w-[544px] text-center text-neutral-900 text-base text-[14px]">Just leave us your contact details. Our representatives will get back to you with everything you need to know </div>
                </div>
                <div class="flex justify-center mb-6">
                    <div class="mr-6 mb-2">
                        <InputLabel for="name" class="text-zinc-950 text-base font-semibold">Name</InputLabel>
                        <TextInput
                            id="name"
                            type="text"
                            class="bg-neutral-50 bg-opacity-90 rounded border border-neutral-300 block w-full"
                            required
                            autofocus
                            autocomplete="name"
                            />
                        <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                    </div>
                    <div class="mr-6 mb-2">
                        <InputLabel for="phnumber" class="text-zinc-950 text-base font-semibold">Phone Number</InputLabel>
                        <TextInput
                            id="phnumber"
                            type="text"
                            class="bg-neutral-50 bg-opacity-90 rounded border border-neutral-300 block w-full"
                            required
                            autofocus
                            autocomplete="phnumber"
                            />
                        <InputError class="mt-2" v-if="errors && errors.phnumber" :message="errors.phnumber[0]" />
                    </div>
                    <div class="mr-6 mb-2">
                        <InputLabel for="email" class="text-zinc-950 text-base font-semibold">Email </InputLabel>
                        <TextInput
                            id="email"
                            type="text"
                            class="bg-neutral-50 bg-opacity-90 rounded border border-neutral-300 block w-full"
                            required
                            autofocus
                            autocomplete="email"
                            />
                        <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
                    </div>
                </div>
                <div class="flex justify-center"><Button class="text-base leading-[27px]" size="sm:m-0 h-[47px]">Enquire Now</Button></div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-8">
            <div class="flex flex-col justify-center mb-12">
                <div class="text-center text-zinc-800 text-[26px] font-semibold">Learn why people choose us </div>
                <div class="text-center text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
            </div>
            <div class="flex mb-6">
                <div class="sm:w-1/3 float-left">
                    <div class="flex flex-col bg-rose-100 rounded-[9px] mr-8 mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-6">
                            <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div> 
                            <div class="text-gray-600 text-base mb-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</div>
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 12</div>
                        </div>
                    </div>

                    <div class="flex flex-col bg-rose-50 rounded-[9px] mr-8">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-6">
                            <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div> 
                            <div class="text-gray-600 text-base mb-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</div>
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 10</div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/3 float-left">
                    <div class="flex flex-col bg-amber-50 rounded-[9px] mr-8 mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-orange-200 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div> 

                            <div class="text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen bookLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</div> 
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 9</div>
                        </div>
                    </div>

                    <div class="flex flex-col bg-rose-50 rounded-[9px] mr-8">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div>
                            <div class="text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</div> 
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">Kerala State Class 10</div>
                        </div>
                    </div>
                </div>
                <div class="sm:w-1/3 float-left">
                    <div class="flex flex-col bg-orange-50 rounded-[9px] mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div>

                            <div class="text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</div> 
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 12</div>
                        </div>
                    </div>

                    <div class="flex flex-col bg-orange-50 rounded-[9px]">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-orange-200 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div>
                            <div class="relative flex items-center justify-center"><img src="/images/homepage/testimonial-play.png" />
                                <div class="w-[49px] h-[49px] bg-white rounded-full absolute flex items-center justify-center"><PlayIcon class="font-semibold w-7 h-7 playicon" aria-hidden="true"/></div></div> 
                            <div class="flex items-center">
                                <div class="mr-4"><img class="w-[59px] h-[59px] rounded-full" src="/images/homepage/testnominal-profile1.png" /></div>
                                <div class="flex flex-col">
                                    <div class="text-zinc-800 text-base font-semibold">Starvon Washington</div>
                                    <div class="text-gray-600 text-sm">Software Engineer at Walmart</div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 12</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-blue-800 text-md font-medium flex justify-center mb-6"><a href="#">View all testimonials <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
        </div>

        <div class="max-w-screen-2xl overflow-hidden mx-auto w-full px-16 py-12 my-8 bg-violet-100">
            <div class="flex items-center justify-between h-[409px]">
                <div class="flex flex-col">
                    <div class="text-zinc-800 text-[26px] font-semibold">The best place to learn?</div>
                    <div class="text-zinc-800 text-[26px] font-semibold mb-6">Wherever you are</div>
                    <div class="text-zinc-800 text-md mb-4">With the MH App, you can learn no matter where you are.<br/>Download now to learn anything, anytime</div>
                    <div class="flex">
                        <div class="mr-2"><img src="/images/homepage/appstore.png" /></div>
                        <div class="mr-2"><img src="/images/homepage/playstore.png" /></div>
                    </div>
                </div>
                <div class="flex w-[724px]">
                    <div class="relative">
                        <div class="w-[724px] h-[733px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c1">
                            <div class="w-[602px] h-[609px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c2">
                                <div class="w-[493px] h-[499px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c3">
                                    <div class="w-[388px] h-[399px] rounded-full absolute top-0 bottom-0 left-0 right-0 m-auto mobileview-c4">
                                        <div class="relative top-[9px]mobileview-imgwrap">
                                            <div class="absolute top-[46px] left-0 z-[1]"><img src="/images/homepage/mbl-screen-left.png" /></div>
                                            <div class="absolute top-0 left-[85px] z-[2]"><img src="/images/homepage/mbl-screen-middle.png" /></div>
                                            <div class="absolute top-[46px] right-0 z-[1]"><img src="/images/homepage/mbl-screen-right.png" /></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-12 my-8">
            <div class="flex items-center">
                <div class="sm:w-1/2 pr-12"><img src="/images/homepage/whyus-img.png" /></div>
                <div class="sm:w-1/2">
                    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px]">Why choose us?</div>
                    <div class="text-zinc-800 text-base leading-relaxed">Manorama Horizon is the allied digital wing pioneers of print media the Malayala Manorama daily. We have been providing reliable high-quality news content to over 1.44 crore readers every day for over a century now. At Horizon, we aspire to be a one-stop destination for all your learning needs.  </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 bg_radial_white_pink">
            <div class="flex flex-col items-center mb-12">
                <div class="text-zinc-800 text-[26px] font-semibold leading-[35px] mb-8">Frequently Asked Questions</div>
                <div class="sm:w-3/4 mx-auto">
                    <div class="generalfaq mb-4">
                        <div class="text-zinc-800 text-xl font-medium leading-tight mb-4">General</div>
                        <div class="w-full">
                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>What is MasterClass?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>

                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>What is included in a MasterClass membership?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>

                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>Where can I watch?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>

                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>Which classes are right for me?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>
                        </div>
                    </div>

                    <div class="paymentfaq mb-4">
                        <div class="text-zinc-800 text-xl font-medium leading-tight mb-4">Pricing & Payment</div>
                        <div class="w-full">
                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>How much does MasterClass cost?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>

                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>Will I be charged taxes?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>

                            <select id="countries" class=" block w-full mt-2 bg-white rounded-md shadow border border-neutral-200 p-4">
                              <option class="text-zinc-800 text-base" selected>How does the 30-day guarantee wor?</option>
                              <option class="text-zinc-800 text-base" value="US">United States</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col border-gray-200 py-6 mx-4">
                    <div class="text-zinc-800 text-base font-semibold mb-2">Best Online Learning Platforms for K1 to K12, CBSE, ICSE, JEE & NEET</div>
                    <div class="text-gray-600 text-sm leading-[25px]">MH is India's one of the best education platforms, known for creating one of the most sought after learning apps. With our unique learning platform called WAVE and immensely talented best teachers, MH offers a highly personalised learning experience for 1st to 12th grades across CBSE and ICSE Boards. Our hands-on teaching methodology has made MH  the primary </div>
                    <div class="text-blue-800 text-base font-medium"><a href="#">See More</a></div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-3 bg-gradient-to-r from-white via-pink-50 to-white mb-4">
            <div class="flex flex-col items-center justify-center bg-zinc-800 rounded-[17px] p-6"> 
                <div class="text-white text-2xl font-semibold leading-[35px] mb-4">Subscribe Newsletter</div>
                <div class="flex items-center mb-3"> 
                    <div class="mr-3">
                        <input id="email" class="w-[383px] bg-white rounded-[3px] text-zinc-800 text-[15px] leading-[35px]" aria-label="Email Address" placeholder="Your email address" required="" type="email">
                    </div>
                    <div class="">
                        <button class="px-6 font-medium m-0 rounded-0 bg-primary text-white subscribe_btn">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-100 h-[250px]"></div>
    </div>
</template>
