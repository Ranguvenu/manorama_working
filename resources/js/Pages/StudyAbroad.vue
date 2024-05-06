<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { ChevronRightIcon } from "@heroicons/vue/24/solid";
    import { ChevronLeftIcon } from "@heroicons/vue/24/solid";
    import { ChevronDownIcon } from "@heroicons/vue/24/solid";

    export default{
    components:{
        MagnifyingGlassIcon,
        ChevronRightIcon,
        ChevronLeftIcon,
        ChevronDownIcon
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
    <Head title="Study Abroad" />
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
        <div class="max-w-screen-2xl mx-auto px-16 pt-8 mb-8 bg_gray_to_pink">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Study Abroad</a>
                </li>
            </ul>
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2">
                    <div class="text-zinc-800 text-4xl font-semibold leading-[44px] mb-4">Apply to the best international institutes and programs</div>
                    <div class="text-gray-600 text-base leading-relaxed mb-4">We give wings to your dreams of Studying Abroad</div>
                    <div class="mb-6 inline-flex">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Request Call Back</a>
                    </div>
                    <div class="text-gray-600 text-base mb-1 ml-1">Our Service Partner</div>
                    <div><img src="/images/homepage/conduira_logo.png" /></div>
                </div>
                <div class="flex flex-col sm:w-1/2 justify-center items-center">
                   <img src="/images/homepage/abroad.png" />
                </div> 
            </div>
            <div class="flex items-center justify-between rounded-tl-[11px] rounded-tr-[11px] border border-zinc-200 px-12 mt-12">
                <div class="flex items-center border-r border-zinc-200 mx-6 py-6 sm:w-1/4">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/abroad/exp.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">15</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Years of experience</div>
                    </div>
                </div>
                <div class="flex items-center border-r border-zinc-200 mx-6 py-6 sm:w-1/4">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/abroad/counseled-users.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">5L</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Students Counseled</div>
                    </div>
                </div>
                <div class="flex items-center border-r border-zinc-200 mx-6 py-6 sm:w-1/4">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/abroad/university.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">1600</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">University options</div>
                    </div>
                </div>
                <div class="flex items-center px-2 py-6 sm:w-1/4">
                    <div class="w-[46px] h-[46px] mr-2">
                        <img  src="/images/abroad/program.png" />
                    </div>
                    <div class="flex-col items-start inline-flex pl-3">
                        <div class="mb-1"><span class="text-zinc-800 text-[28px] font-semibold">10000</span>
                        <span class="text-rose-500 text-[28px] font-semibold">+</span></div>
                        <div class="text-neutral-500 text-base">Program options</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3">
            <div class="flex items-center">
                <div class="flex flex-col sm:w-2/5">
                    <img class="country-grpusersimg" src="/images/abroad/country-usersgrp.png" alt="International Education Consulting" />     
                </div>
                <div class="flex flex-col sm:w-3/5 items-center pr-12">
                    <div class="text-black text-[25px] font-semibold leading-[35px] mb-4">We are India’s biggest and most trusted International Education Consulting Company.</div>
                    <div class="text-gray-600 text-base leading-relaxed mb-4">We understand the significance of money and how a lack of sufficient funds can sometimes obstruct a student’s study abroad dreams. Therefore, we help deserving candidates apply for scholarships, bursaries, application fee waivers, and more.</div>
                </div> 
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-8">
            <div class="flex items-center justify-between mb-6">
                <div class="text-zinc-800 text-[25px] font-semibold">More than 90,000 programs offered in 9+ countries.</div>
                <div class="flex">
                    <a class="icon p-2 mr-4 flex-shrink-0 rounded-full flex items-center justify-center w-11 h-11 bg-neutral-100 font-semibold"><ChevronLeftIcon class="h-6 w-6 text-rose-500" aria-hidden="true"/></a>
                    <a class="icon p-2 flex-shrink-0 rounded-full flex items-center justify-center w-11 h-11 bg-neutral-100 font-semibold"><ChevronRightIcon class="h-6 w-6 text-rose-500" aria-hidden="true"/></a>
                </div>
            </div>
            <div class="flex flex-wrap overflow-hidden">
                <div class="md:w-1/5 sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[17px]" src="/images/abroad/usa.png" alt="USA"/></div>
                        <div class="flex items-center">
                            <img class="mr-2" src="/images/abroad/usa-logo.png" alt="USA Logo"/>
                            <div class="text-zinc-800 text-base font-medium leading-relaxed">USA</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/5 sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[17px]" src="/images/abroad/canada.png" alt="Canada"/></div>
                        <div class="flex items-center">
                            <img class="mr-2" src="/images/abroad/canada-logo.png" alt="Canada Logo"/>
                            <div class="text-zinc-800 text-base font-medium leading-relaxed">Canada</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/5 sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[17px]" src="/images/abroad/uk.png" alt="UK"/></div>
                        <div class="flex items-center">
                            <img class="mr-2" src="/images/abroad/uk-logo.png" alt="UK Logo"/>
                            <div class="text-zinc-800 text-base font-medium leading-relaxed">UK</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/5 sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[17px]" src="/images/abroad/ireland.png" alt="Ireland"/></div>
                        <div class="flex items-center">
                            <img class="mr-2" src="/images/abroad/ireland-logo.png" alt="Ireland Logo"/>
                            <div class="text-zinc-800 text-base font-medium leading-relaxed">Ireland</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/5 sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[17px]" src="/images/abroad/germany.png" alt="Germany"/></div>
                        <div class="flex items-center">
                            <img class="mr-2" src="/images/abroad/germany-logo.png" alt="Germany Logo"/>
                            <div class="text-zinc-800 text-base font-medium leading-relaxed">Germany</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3" id="courses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-4">Popular Courses that our students pursue</div>
            <div class="flex flex-row flex-wrap">
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">Computer Science & IT</div>
                    </div>
                </div>
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">Data Science, Analytics</div>
                    </div>
                </div>
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">AI & ML</div>
                    </div>
                </div>
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">Core Engineering (Mechanical, Civil, Electrical)</div>
                    </div>
                </div>
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">Management</div>
                    </div>
                </div>
                <div class="sm:w-1/3 md:w-1/4 pr-6 mb-4">
                    <div class="bg-rose-50 rounded-[5px] border border-rose-500 flex items-center py-6 px-6"><div class="text-stone-950 text-md font-medium">Nursing and Allied Health Science</div>
                    </div>
                </div>
            </div>
        </div>
         <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3" id="courses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-4">Services we provide</div>
            <div class="flex justify-between">
                <div class="sm:w-1/2 w-full mt-8">
                    <div id="services_wrap">
                        <div class="bg-neutral-50 rounded-md px-6 mb-6">
                            <h2 class="mb-0" id="testprep">
                                <button class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition [overflow-anchor:none]"
                                type="button"
                                data-te-collapse-init
                                data-te-target="#testprepcollapse"
                                aria-expanded="true"
                                aria-controls="testprepcollapse">
                                    <div>Test Prep</div>
                                    <div class="text-black font-semibold"><ChevronDownIcon class="h-6 w-6 text-black" aria-hidden="true"/></div>
                                </button>
                            </h2>
                            <div id="testprepcollapse" 
                                class="!visible"
                                data-te-collapse-item
                                data-te-collapse-show
                                aria-labelledby="testprep"
                                data-te-parent="#services_wrap">
                                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.
                                </div>
                            </div>
                        </div>
                        <div class="bg-neutral-50 rounded-md px-6 mb-6">
                            <h2 class="mb-0" id="profileevaluation">
                                <button class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition [overflow-anchor:none]"
                                type="button"
                                data-te-collapse-init
                                data-te-target="#profileevaluationcollapse"
                                aria-expanded="false"
                                aria-controls="profileevaluationcollapse">
                                    <div>Profile Evaluation</div>
                                    <div class="text-black font-semibold"><ChevronDownIcon class="h-6 w-6 text-black" aria-hidden="true"/></div>
                                </button>
                            </h2>
                            <div
                              id="collapseTwo"
                              class="!visible hidden"
                              data-te-collapse-item
                              aria-labelledby="headingTwo"
                              data-te-parent="#accordionExample">
                                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.
                                </div>
                            </div>
                        </div>
                        <div class="bg-neutral-50 rounded-md px-6 mb-6">
                            <h2 class="mb-0" id="profileevaluation">
                                <button class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition [overflow-anchor:none]"
                                type="button"
                                data-te-collapse-init
                                data-te-target="#profileevaluationcollapse"
                                aria-expanded="false"
                                aria-controls="profileevaluationcollapse">
                                    <div>Profile Evaluation</div>
                                    <div class="text-black font-semibold"><ChevronDownIcon class="h-6 w-6 text-black" aria-hidden="true"/></div>
                                </button>
                            </h2>
                            <div
                              id="collapseTwo"
                              class="!visible hidden"
                              data-te-collapse-item
                              aria-labelledby="headingTwo"
                              data-te-parent="#accordionExample">
                                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.
                                </div>
                            </div>
                        </div>
                        <div class="bg-neutral-50 rounded-md px-6 mb-6">
                            <h2 class="mb-0" id="profileevaluation">
                                <button class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition [overflow-anchor:none]"
                                type="button"
                                data-te-collapse-init
                                data-te-target="#profileevaluationcollapse"
                                aria-expanded="false"
                                aria-controls="profileevaluationcollapse">
                                    <div>Profile Evaluation</div>
                                    <div class="text-black font-semibold"><ChevronDownIcon class="h-6 w-6 text-black" aria-hidden="true"/></div>
                                </button>
                            </h2>
                            <div
                              id="collapseTwo"
                              class="!visible hidden"
                              data-te-collapse-item
                              aria-labelledby="headingTwo"
                              data-te-parent="#accordionExample">
                                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.
                                </div>
                            </div>
                        </div>
                        <div class="bg-neutral-50 rounded-md px-6 mb-6">
                            <h2 class="mb-0" id="profileevaluation">
                                <button class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition [overflow-anchor:none]"
                                type="button"
                                data-te-collapse-init
                                data-te-target="#profileevaluationcollapse"
                                aria-expanded="false"
                                aria-controls="profileevaluationcollapse">
                                    <div>Profile Evaluation</div>
                                    <div class="text-black font-semibold"><ChevronDownIcon class="h-6 w-6 text-black" aria-hidden="true"/></div>
                                </button>
                            </h2>
                            <div
                              id="collapseTwo"
                              class="!visible hidden"
                              data-te-collapse-item
                              aria-labelledby="headingTwo"
                              data-te-parent="#accordionExample">
                                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><img src="/images/abroad/services.png" /></div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-8 ">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-8">Our Mentors</div>
            <div class="flex flex-row flex-wrap">
                <div class="sm:w-1/3 pr-8 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[11px] w-full" src="/images/abroad/mentor1.png" alt="Mohamed Abdullah Profile Picture" /></div>
                        <div class="text-zinc-800 text-base font-medium mb-2">Mohamed Abdullah</div>
                        <div><img class="w-6 h-6" src="/images/abroad/linkedin-blue.png" alt="Linkedin Icon" /></div>
                    </div>
                </div>
                <div class="sm:w-1/3 pr-8 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[11px] w-full" src="/images/abroad/mentor2.png" alt="Deepti Abdullah Profile Picture" /></div>
                        <div class="text-zinc-800 text-base font-medium mb-2">Deepti Abdullah</div>
                        <div><img class="w-6 h-6" src="/images/abroad/linkedin-blue.png" alt="Linkedin Icon" /></div>
                    </div>
                </div>
                <div class="sm:w-1/3 pr-8 mb-4">
                    <div class="flex flex-col">
                        <div class="mb-4"><img class="rounded-[11px] w-full" src="/images/abroad/mentor3.png" alt="Lakshmi Manthini Profile Picture" /></div>
                        <div class="text-zinc-800 text-base font-medium mb-2">Lakshmi Manthini</div>
                        <div><img class="w-6 h-6" src="/images/abroad/linkedin-blue.png" alt="Linkedin Icon" /></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12">
            <div class="text-black text-[25px] font-semibold mb-2">Results & Testimonials</div>
            <div class="text-black text-[22px] mb-4">100+ Admits in Fall 2022 and Spring 2023</div>
            <div class="flex justify-between my-6">
                <div class="w-1/2 flex bg-neutral-100 rounded-[11px] px-6 py-6 mr-12 justify-between">
                    <div class="w-1/3 flex flex-col mr-8">
                        <img src="/images/abroad/results-1.png" alt="Vaishnavi Koya Profile Picture" class="flex justify-center rounded-full mb-2 w-[95px] h-[95px]"/>
                        <div class="text-black text-[15px] font-semibold mb-1">Vaishnavi Koya</div>
                        <div class="text-black text-[11px] mb-2">Pace University</div>
                        <img src="/images/abroad/pace-logo.png " alt="Pace University" class="w-[130px]"/>
                    </div>
                    <div class="w-2/3"><div class="text-black text-[15px] leading-[29px]">Conduria consultancy has helped with the whole admission. Lakshmi Mam and Abdullah sir are available when I need them I am very happy with the support received from Conduria. I also took coaching for GRE and IELTS, The way Abdullah sir teaches is amazing. I highly recommend conduria who is planning their study abroad.</div></div>
                </div>
                <div class="w-1/2 flex bg-neutral-100 rounded-[11px] px-6 py-6 mr-12 justify-between">
                    <div class="w-1/3 flex flex-col mr-8">
                        <img src="/images/abroad/results-2.png" alt="Naveen Ravula Profile Picture" class="flex justify-center rounded-full mb-2 w-[95px] h-[95px]"/>
                        <div class="text-black text-[15px] font-semibold mb-1">Naveen Ravula</div>
                        <div class="text-black text-[11px] mb-2">Arizona State University</div>
                        <img src="/images/abroad/asu-logo.png " alt="Pace University" class="w-full"/>
                    </div>
                    <div class="w-2/3"><div class="text-black text-[15px] leading-[29px]">Conduria consultancy has helped with the whole admission. Lakshmi Mam and Abdullah sir are available when I need them I am very happy with the support received from Conduria. I also took coaching for GRE and IELTS, The way Abdullah sir teaches is amazing. I highly recommend conduria who is planning their study abroad.</div></div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-700 h-[250px]"></div>
    </div>
</template>
