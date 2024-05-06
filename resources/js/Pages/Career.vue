<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";

    export default{
    components:{
        MagnifyingGlassIcon
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
    <Head title="Career" />
    <header class="max-w-screen-2xl mx-auto bg-white shadow px-16 siteheader w-full sm:fixed sm:h-[90px] top-0">
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
                <!-- <div class="pl-17"><Button class="px-6 font-medium m-0" size="sm" color="primary">Login</Button></div> -->
            </div>
        </div>
    </header>
    <div class="content-wrap mt-[90px]">

        <div class="max-w-screen-2xl mx-auto px-16 py-8 mb-8 bg_pink_to_gray">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Career</a>
                </li>
            </ul>
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2">
                    <div class="text-zinc-800 text-[32px] font-semibold mb-4">Join us to create an impact</div>
                    <div class="text-zinc-800 text-[15px] leading-relaxed mb-4">Learn how we're working to expand the possibilities of content and technology to support learning in a connected world</div>
                    <div class="mb-4 inline-flex">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">View All Jobs</a>
                    </div>
                </div>
                <div>
                    <img  src="/images/career.png" />
                </div> 
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3">
            <div class="flex flex-col">
                <div class="bg-white rounded-[11px] border border-zinc-100 p-6 mb-4">
                    <div class="text-zinc-800 text-xl font-semibold pb-2">Who we are?</div>
                    <div class="text-gray-600 text-[15px]">Manorama Horizon is an educational portal from the house of Malayala Manorama that reinforces its commitment to education by making it universal and comprehensive.</div>
                </div>
                <div class="bg-white rounded-[11px] border border-zinc-100 p-6 mb-4">
                    <div class="text-zinc-800 text-xl font-semibold pb-2">Why Manorama Horizon?</div>
                    <div class="text-gray-600 text-[15px]">At Manorama Horizon, we thrive to make learning a wonderful experience for our learners and optimise their learning outcome in a fun way. Be a part of a community that is passionate about education and determined to deliver learning in the best way possible.</div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-8 ">
            <div class="text-zinc-800 text-[25px] font-semibold mb-4">Open Positions</div>
            <div class="tab_wrap mb-8">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 tablist" id="positions_tablist" data-tabs-toggle="#positions_tablist" role="tablist">
                    <li class="mr-2" role="presentation">
                        <a href="#" class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium active" id="all" data-tabs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">All</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"  class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium" id="learning_content" data-tabs-target="#learning_content" type="button" role="tab" aria-controls="learning_content" aria-selected="false">Learning Content</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium" id="marketing" data-tabs-target="#marketing" type="button" role="tab" aria-controls="marketing" aria-selected="false">Marketing</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium" id="academics" data-tabs-target="#academics" type="button" role="tab" aria-controls="academics" aria-selected="false">Academics</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium" id="academics-youtube" data-tabs-target="#academics-youtube" type="button" role="tab" aria-controls="academics-youtube" aria-selected="false">Academics - Youtube</a>
                    </li>
                    <li class="mr-2">
                         <a href="#"  class="inline-block px-8 py-1 bg-white rounded text-gray-600 text-md font-medium" id="digital" data-tabs-target="#digital" type="button" role="tab" aria-controls="digital" aria-selected="false">Digital</a>
                    </li>
                </ul>
            </div>
            <div id="positions_tablist">
                <div class="py-4" id="webinars" role="tabpanel" aria-labelledby="webinars">
                    <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">Freelance Educator: Bank Exams Freelance Educator: Bank ExamsFreelance Educator: Bank ExamsFreelance Educator: Bank ExamsFreelance Educator: Bank ExamsFreelance Educator: Bank ExamsFreelance Educator: Bank Exams Freelance Educator: Bank Exams</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium leading-[27px]">View Details</a>
                        </div>
                    </div>
                    <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">UX Analyst UX AnalystUX AnalystUX AnalystUX AnalystUX AnalystUX Analyst UX AnalystUX AnalystUX Analyst UX AnalystUX Analyst UX AnalystUX AnalystUX Analyst UX AnalystUX Analyst UX Analyst UX Analyst UX Analyst UX Analyst UX Analyst UX Analyst UX AnalystUX AnalystUX AnalystUX Analyst UX AnalystUX AnalystUX Analyst UX AnalystUX Analyst UX AnalystUX Analyst</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium">View Details</a>
                        </div>
                    </div>
                   <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">Freelance Educator: UPSC</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium">View Details</a>
                        </div>
                    </div>
                    <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">Freelance Educator: KPSC</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium">View Details</a>
                        </div>
                    </div>
                    <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">Freelance Educator: Bank Exams</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium">View Details</a>
                        </div>
                    </div>
                    <div class="flex w-full flex-row flex-wrap items-center justify-between p-4 mb-4 bg-white rounded-[11px] border border-neutral-200">
                        <div class="flex flex-col w-[calc(100%-150px)]">
                            <div class="text-zinc-800 text-base font-semibold mb-2 w-full">Freelance Educator: Bank Exams</div>
                            <div class="flex flex-wrap items-center w-full">
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Remote</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">Full Time</div>
                                </div>
                                <div class="flex items-center pr-6">
                                    <div class="w-[5px] h-[5px] bg-zinc-300 rounded-full mr-2"></div>
                                    <div class="text-gray-600 text-base">2-3 Year</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[135px] ml-3 flex-grow">
                            <a href="#" class="px-[18px] py-2.5 bg-white rounded-[5px] border border-rose-600 text-rose-500 text-base font-medium">View Details</a>
                        </div>
                    </div>
                    <div class="flex justify-center"><a href="#" class="text-blue-800 text-base font-medium">View All Positions</a></div>
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

    </div>
    <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-700 h-[250px]">
    </div>
</template>
