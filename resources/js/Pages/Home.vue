<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { ChevronDoubleRightIcon } from "@heroicons/vue/24/solid";
    import { StarIcon } from "@heroicons/vue/24/solid";
    import { PlayIcon } from "@heroicons/vue/24/solid";
    import Button from '@/Components/Button.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MultiSelect from '@/Components/MultiSelect.vue';

    export default{
    components:{
        InputError,
        InputLabel,
        TextInput,
        Button,
        ButtonOutline,
        MagnifyingGlassIcon,
        ChevronDoubleRightIcon,
        StarIcon,
        PlayIcon,
        MultiSelect
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
        <div class="max-w-screen-2xl mx-auto bggrid h-[386px] px-16 py-8">
            <div class="flex flex-row flex-wrap items-center justify-between welcome-section">
                <div class="flex-col items-start inline-flex welcome-text">
                    <div class="origin-top-left w-[48.49px] h-[49.68px] relative strokes top-[14px] left-[-25px]">
                    </div>
                    <div class="w-[558px]"><span class="text-zinc-800 text-[35px] font-bold  leading-[45px]">Better Learning.</span><span class="text-primary text-[35px] font-bold leading-[45px]"> Better Results.</span></div>
                    <div class="w-[541px] h-[84px] text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem</div>
                    <div class="h-[47px] px-[18px] py-2.5 bg-primary rounded-[5px] justify-center items-center inline-flex">
                        <div class="text-white text-base font-medium leading-[27px]">Request a Call back</div>
                    </div>
                </div>
                <div class="h-72 bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 rounded-[15px] flex items-center px-8 slider">
                    <div class="flex-col items-start inline-flex mb-4 slider-text">
                        <div class="w-[346px] text-zinc-800 text-[21px] font-semibold leading-[27px] mb-3">Getting Ready for the Kerala Administrative Services Exam?</div>
                        <div class="w-[301px] h-[60px] text-gray-600 text-base font-normal leading-[27px] mb-6">Enroll now in the integrated course for the KAS Exam</div>
                        <div class="w-[86px] h-[30px] text-rose-500 text-[17px] font-semibold leading-[27px]">Enrol Now</div>
                    </div>
                    <div><img  src="/images/homepage/couresimg1.png" /></div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16">
            <div class="flex items-center justify-between bg-pink-50 rounded-[9px] shadow border border-rose-100 py-6 px-12">
                <div class="flex items-center">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/homepage/courses.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">150</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Courses conducted</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/homepage/reg_users.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">1,30,000</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Registered users</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/homepage/tests.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">700</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Test taken</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/homepage/classes.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">1000</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Live classes</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3">
            <div class="flex items-start justify-center mb-2">
                <div class="w-[29px] h-[29px] mr-3">
                    <img  src="/images/homepage/school.png" /> 
                </div>
                <div class="text-center text-zinc-800 text-[25px] font-semibold leading-[35px]">School Exams</div>
            </div>
            <div class="flex items-center justify-center text-gray-600 text-base mb-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>

            <div class="flex items-start justify-center mb-4">
                <!--<ButtonOutline class="text-base font-semibold" size="sm">CBSE</ButtonOutline>
                <ButtonOutline class="text-base font-medium font-semibold" size="sm" color="gray">Kerala State</ButtonOutline>-->
                <div class="w-[90px] h-[30px] bg-white rounded border border-pink-300 text-center mx-1">
                    <a href="#" class="text-rose-500 text-base font-semibold leading-[27px]">CBSE</a>
                </div>
                <div class="w-[126px] h-[30px] bg-white rounded border border-zinc-300 text-center mx-1">
                    <a href="#" class="text-gray-600 text-base font-medium leading-[27px]">Kerala State</a>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-1/4 bg-violet-50 rounded-lg border-b border-indigo-800 flex items-center justify-between px-6 py-8 mr-4">
                    <div><div class="text-black text-sm font-medium">CBSE</div>
                    <div class="text-zinc-800 text-xl font-semibold leading-[27px]">Class 8</div></div>
                    <div>
                        <a href=""><ChevronDoubleRightIcon class="h-8 w-8 text-gray-1000 font-semibold" aria-hidden="true"/></a>
                    </div>
                </div>
                <div class="w-1/4 bg-violet-50 rounded-lg border-b border-indigo-800 flex items-center justify-between px-6 py-8 mr-4">
                    <div><div class="text-black text-sm font-medium">CBSE</div>
                    <div class="text-zinc-800 text-xl font-semibold leading-[27px]">Class 9</div></div>
                    <div>
                        <a href=""><ChevronDoubleRightIcon class="h-8 w-8 text-gray-1000 font-semibold" aria-hidden="true"/></a>
                    </div>
                </div>
                <div class="w-1/4 bg-violet-50 rounded-lg border-b border-indigo-800 flex items-center justify-between px-6 py-8 mr-4">
                    <div><div class="text-black text-sm font-medium">CBSE</div>
                    <div class="text-zinc-800 text-xl font-semibold leading-[27px]">Class 10</div></div>
                    <div>
                        <a href=""><ChevronDoubleRightIcon class="h-8 w-8 text-gray-1000 font-semibold" aria-hidden="true"/></a>
                    </div>
                </div>
                <div class="w-1/4 bg-violet-50 rounded-lg border-b border-indigo-800 flex items-center justify-between px-6 py-8">
                    <div><div class="text-black text-sm font-medium">CBSE</div>
                    <div class="text-zinc-800 text-xl font-semibold leading-[27px]">Class 11</div></div>
                    <div>
                        <a href=""><ChevronDoubleRightIcon class="h-8 w-8 text-gray-1000 font-semibold" aria-hidden="true"/></a>
                    </div>
                </div>
            </div>
            <div class="text-blue-800 text-md font-semibold flex justify-end mb-6"><a href="#">View All Courses <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 cc_courses">
            <div class="flex items-center justify-center mb-2">
                <div class="w-[29px] h-[29px] mr-3">
                    <img  src="/images/homepage/certificate.png" /> 
                </div>
                <div class="text-center text-zinc-800 text-[25px] font-semibold leading-[35px]">Certificate Courses</div>
            </div>
            <div class="flex items-center justify-center text-gray-600 text-base mb-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
            <div class="flex items-center">
                <div class="mr-6 mb-6 shadow border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
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
                    <div class="px-3 pt-4">
                        <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                        <div class="flex items-center pb-4">
                            <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                            <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                            <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                        </div>
                        <div class="border-t border-gray-200 flex items-center justify-between py-2">
                            <div class="text-rose-500 text-base font-semibold">Enroll</div>
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
                <div class="mr-6 mb-6 shadow border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                    <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                        <div class="inline-flex flex-col w-3/4 pr-4">
                            <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                            <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                        </div>
                        <div class="inline-flex items-center flex-col">
                            <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile2.jpg" />
                            <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                        </div>
                        <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Online</div></div>
                    </div>
                    <div class="px-3 pt-4">
                        <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                        <div class="flex items-center pb-4">
                            <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                            <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                            <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                        </div>
                        <div class="border-t border-gray-200 flex items-center justify-between py-2">
                            <div class="text-rose-500 text-base font-semibold">Enroll</div>
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
                <div class="mr-6 mb-6 shadow border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                    <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                        <div class="inline-flex flex-col w-3/4 pr-4">
                            <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                            <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                        </div>
                        <div class="inline-flex items-center flex-col">
                            <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                            <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                        </div>
                        <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Offline</div></div>
                    </div>
                    <div class="px-3 pt-4">
                        <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                        <div class="flex items-center pb-4">
                            <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                            <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                            <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                        </div>
                        <div class="border-t border-gray-200 flex items-center justify-between py-2">
                            <div class="text-rose-500 text-base font-semibold">Enroll</div>
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
                <div class="mb-6 shadow border border-zinc-100 rounded-tl-[12px] rounded-tr-[12px]">
                    <div class="bg-gradient-to-l from-red-200 via-fuchsia-200 to-indigo-50 flex justify-between relative px-3 pt-6 pb-3 rounded-tl-[12px] rounded-tr-[12px] items-end">
                        <div class="inline-flex flex-col w-3/4 pr-4">
                            <div class="text-zinc-800 text-[18px] font-semibold leading-[22px] pb-3 mb-1">Product-led growth in B2B</div>
                            <div class="text-gray-600 text-[11px] pb-6 mb-4">Use ChatGpt to boost your productivity in your Finance job</div>
                        </div>
                        <div class="inline-flex items-center flex-col">
                            <img  class="rounded-full w-[60px] h-[60px]" src="/images/homepage/cc-profile1.jpg" />
                            <span class="text-xs text-gray-1000 font-semibold">by aleena</span>
                        </div>
                        <div class="status-tag bg-rose-100 rounded-tr-xl absolute bottom-0 left-0"><div class="text-black text-sm font-medium leading-[21px]">Offline</div></div>
                    </div>
                    <div class="px-3 pt-4">
                        <div class="text-zinc-800 text-base font-semibold pb-4">Product Led Growth in B2B</div>
                        <div class="flex items-center pb-4">
                            <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white" aria-hidden="true"/>
                            <div class="text-center text-neutral-900 text-xs font-semibold mr-3">4.1</div>
                            <div class="text-gray-600 text-xs mr-3">(1k Review)</div>
                        </div>
                        <div class="border-t border-gray-200 flex items-center justify-between py-2">
                            <div class="text-rose-500 text-base font-semibold">Enroll</div>
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

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3">
            <div class="bg-pink-50 bggrid mb-12">
                <div class="flex items-center px-6 py-12">
                    <div class="pl-3 pr-12 sm:w-1/2">
                        <img src="/images/homepage/comp-exam.png" alt="Competitive Exam"  />

                        <!-- Button 1 - Top -->
                        <!-- <button class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-2 rounded-md">Button 1</button> -->
                        <!-- <div class="absolute top-0 left-1/2 transform -translate-x-1/2 px-4 py-2 w-[74px] h-[30px] bg-orange-200 rounded-md shadow border border-black "><div class="text-center text-black text-lg font-medium">KAS</div></div> -->

                        <!-- Button 2 - Right -->
                        <!-- <button class="absolute top-1/2 transform -translate-y-1/2 right-0 bg-red-500 text-white px-4 py-2 rounded-md">Button 2</button> -->
                        <!-- <div class="absolute top-1/2 transform -translate-y-1/2 right-0 px-4 py-2 w-[74px] h-[30px] bg-orange-200 rounded-md shadow border border-black "><div class="text-center text-black text-lg font-medium">SSC</div></div> -->

                        <!-- Button 3 - Bottom -->
                        <!-- <button class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-md">Button 3</button> -->
                        <!-- <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 px-4 py-2 w-[74px] h-[30px] bg-orange-200 rounded-md shadow border border-black "><div class="text-center text-black text-lg font-medium">LDC</div></div> -->

                        <!-- Button 4 - Left -->
                        <!-- <button class="absolute top-1/2 transform -translate-y-1/2 left-0 bg-yellow-500 text-white px-4 py-2 rounded-md">Button 4</button> -->
                        <!-- <div class="absolute top-1/2 transform -translate-y-1/2 left-0 px-4 py-2 w-[74px] h-[30px] bg-orange-200 rounded-md shadow border border-black "><div class="text-center text-black text-lg font-medium">PSC</div></div> -->

                        <!-- Button 5 - Center -->
                        <!-- <button class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-purple-500 text-white px-4 py-2 rounded-md">Button 5</button> -->
                        <!-- <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 px-4 py-2 w-[74px] h-[30px] bg-orange-200 rounded-md shadow border border-black "><div class="text-center text-black text-lg font-medium">UPSC</div></div> -->
                    </div>
                    <div class="flex flex-col sm:w-1/2 pl-3">
                        <div class="flex mb-1 items-end">
                            <div class="w-8 h-8 mr-2">
                                <img src="/images/homepage/comp-exam-icon.png" alt="Competitive Exam"/>
                            </div>
                            <div class="text-zinc-800 text-[21px] font-semibold leading-[24px]">Competitive Exam</div>
                        </div>
                        <div class="text-gray-600 text-base mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                        <div class="bg-white rounded border-b border-pink-400 px-6 py-6 mb-4">
                            <div class="text-zinc-800 text-[17px] font-semibold">Online Civil Service Foundation Course 2023 - 2024</div>
                            <div class="text-gray-600 text-xs">Your dream of becoming an IAS officer begins here.</div>
                        </div>
                        <div class="bg-white rounded border-b border-pink-400 px-6 py-6 mb-4">
                            <div class="text-zinc-800 text-[17px] font-semibold">Get Ready to Crack the UPSC Civil Services Exam!</div>
                            <div class="w-[487px] h-3.5 text-gray-600 text-xs">Join our Integrated Prelims cum Mains Coaching program designed for aspirants<br/></div>
                        </div>
                        <div class="text-blue-800 text-md font-semibold"><a href="#" >View All Courses</a><span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-pink-50">
            <div class="flex items-center justify-between pt-4 px-2">
                <div class="flex-col flex sm:w-1/2">
                    <div class="flex">
                        <div class="mr-2"><img src="/images/homepage/airplane.png" /></div>
                        <div class="text-black text-[25px] font-semibold leading-[35px]">Lookin for study abroad option</div>
                    </div>
                    <div class="w-[576px] text-gray-600 text-base font-normal leading-[27px]">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="flex items-center">
                        <Button class="text-base leading-[27px]" size="sm:m-0 h-[47px]">Request a call back</Button>
                        <div><img src="/images/homepage/clip-path.png" /></div>
                        <div><img src="/images/homepage/conduira_logo.png" /></div>
                    </div>
                </div>
                <div class="flex items-center sm:w-1/2 justify-center">
                    <div class="relative">
                        <img src="/images/homepage/abroad.png" />
                        <div class="origin-top-left w-[25.61px] h-[27.06px]  strokes-full strokes-top">
                        </div>
                    
                        <div class="origin-bottom-left w-[25.61px] h-[27.06px] strokes-full strokes-btm">
                        </div>
                    </div>
                </div>
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

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-8 my-8 bg-gradient-to-l from-rose-100 via-purple-100 to-violet-50">
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
            <div class="text-zinc-800 text-[26px] font-semibold leading-[35px] mb-6">Free Resources</div>
            <div class="tab_wrap">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" id="resources_tablist" data-tabs-toggle="#resources_tablist" role="tablist">
                    <li class="mr-2" role="presentation">
                        <a href="#" class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium active" id="webinars" data-tabs-target="#webinars" type="button" role="tab" aria-controls="webinars" aria-selected="false">Webinars</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"  class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium" id="blog" data-tabs-target="#blog" type="button" role="tab" aria-controls="blog" aria-selected="false">Blog</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium" id="article" data-tabs-target="#article" type="button" role="tab" aria-controls="article" aria-selected="false">Article</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium" id="current-affairs" data-tabs-target="#current-affairs" type="button" role="tab" aria-controls="current-affairs" aria-selected="false">Current affairs</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium" id="study-materials" data-tabs-target="#study-materials" type="button" role="tab" aria-controls="study-materials" aria-selected="false">Study Materials</a>
                    </li>
                </ul>
            </div>
            <div id="resources_tablist">
                <div class="py-4" id="webinars" role="tabpanel" aria-labelledby="webinars">
                    <div class="flex items-center">
                        <div class="flex flex-col mr-6 mb-4 bg-white rounded-[11px] border border-stone-300">
                            <div><img src="/images/homepage/free_resources1.png" /></div>
                            <div class="py-4 px-3"><div class="text-zinc-800 text-sm font-medium"><p>Chat with Safna Nazarudeen IAS | First</p><p>Attempt-Age 23-AIR 45 | IAS Motivational</p><p>Talk | Manorama Horizon</p></div></div>
                        </div>
                        <div class="flex flex-col mr-6 mb-4 bg-white rounded-[11px] border border-stone-300">
                            <div><img src="/images/homepage/free_resources2.png" /></div>
                            <div class="py-4 px-3"><div class="text-zinc-800 text-sm font-medium"><p>Are you ready to crack Kerala </p><p>Administrative Exam ? | Jayan T, </p><p>KAS Officer Trainee | Manorama Horizon</p></div></div>
                        </div>
                        <div class="flex flex-col mr-6 mb-4 bg-white rounded-[11px] border border-stone-300">
                            <div><img src="/images/homepage/free_resources3.png" /></div>
                            <div class="py-4 px-3"><div class="text-zinc-800 text-sm font-medium"><p>Artificial Intelligence and Data Science | </p><p>Dr. Ebin Deni Raj | IIIT Kottayam | </p><p>Manorama Horizon</p></div></div>
                        </div>
                        <div class="flex flex-col mb-4 bg-white rounded-[11px] border border-stone-300">
                            <div><img src="/images/homepage/free_resources4.png" /></div>
                            <div class="py-4 px-3"><div class="text-zinc-800 text-sm font-medium"><p>Artificial Intelligence and Data Science | </p><p>Dr. Ebin Deni Raj | IIIT Kottayam | </p><p>Manorama Horizon</p></div></div>
                        </div>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="blog" role="tabpanel" aria-labelledby="blog">
                   
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="article" role="tabpanel" aria-labelledby="article">
                
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="current-affairs" role="tabpanel" aria-labelledby="current-affairs">
                    
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="study-materials" role="tabpanel" aria-labelledby="study-materials">
                    
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-8">
            <div class="flex flex-col justify-center mb-12">
                <div class="text-center text-zinc-800 text-[26px] font-semibold">Learn why people choose us </div>
                <div class="text-center text-gray-600 text-base">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
            </div>
            <div class="inline-block columns-3">
                <div class="inline-block">
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
                </div>
                <div class="inline-block">
                    <div class="flex flex-col bg-rose-50 rounded-[9px] mr-8 mb-12">
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
                <div class="inline-block">
                    <div class="flex flex-col bg-amber-50 rounded-[9px] mr-8 mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-orange-200 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div> 

                            <div class="text-gray-600 text-base mb-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen bookLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</div> 
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
                </div>
                <div class="inline-block">
                    <div class="flex flex-col bg-rose-50 rounded-[9px] mr-8 mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
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
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">Kerala State Class 10</div>
                        </div>
                    </div>
                </div>
                <div class="inline-block">
                    <div class="flex flex-col bg-orange-50 rounded-[9px] mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
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
                        <div class="px-4 py-3"><div class="text-black text-sm font-medium">CBSE Class 12</div>
                        </div>
                    </div>
                </div>
                <div class="inline-block">
                    <div class="flex flex-col bg-orange-50 rounded-[9px] mb-12">
                        <div class="bg-white rounded-[9px] border border-zinc-200 relative px-4 py-8">
                            <div class="w-[42px] h-[42px] bg-orange-200 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                                <img src="/images/homepage/left-quotes.png" />
                            </div>
                            <div class="relative flex items-center justify-center mb-8"><img src="/images/homepage/testimonial-play.png" class="w-full" />
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

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 bg-gradient-to-r from-white via-pink-50 to-white">
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
                <div class="flex flex-col border-t border-gray-200 py-6 mx-4">
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
