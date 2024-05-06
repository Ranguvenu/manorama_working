<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { ChevronDownIcon } from "@heroicons/vue/24/solid";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MultiSelect from '@/Components/MultiSelect.vue';
    import { StarIcon } from "@heroicons/vue/24/solid";
    import { CheckCircleIcon } from "@heroicons/vue/24/solid";
    export default{
    components:{
        InputError,
        InputLabel,
        TextInput,
        MagnifyingGlassIcon,
        ChevronDownIcon,
        MultiSelect,
        StarIcon,
        CheckCircleIcon
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
        <div class="max-w-screen-2xl mx-auto px-16 pt-8 pb-4 bg_gray_to_pink">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Course Listing</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Fundamentals Of Artificial Intelligence And Data Science</a>
                </li>
                
            </ul>
            <div class="flex items-center justify-between mcviewbanner">
                <div class="flex flex-col sm:w-1/2 mt-12 px-6">
                    <div class="mb-4 text-4xl font-semibold leading-[44px]">Fundamentals Of Artificial Intelligence And Data Science</div>

                    <div class="text-gray-600 text-base leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</div>

                    <div class="flex items-center my-3">
                        <div class="text-zinc-800 text-[13px]">Fee</div>
                        <div class="mx-3">
                            <span class="mr-1">₹</span>
                            <span class="text-gray-600 text-zinc-800 text-xl font-semibold ">449</span>
                        </div>
                        <div class="mx-3 text-xl text-neutral-400 font-semibold">
                            <span class="mr-1">₹</span>
                            <span class="line-through">3,199</span>
                        </div>
                        <div class="mx-3 text-green-600 text-base font-semibold">82%off</div>

                        <div class="mx-3 flex items-center">
                            <div class="text-zinc-800 text-base font-medium mr-2">4.6</div>
                            <StarIcon class="h-4 w-4 mr-1 text-yellow-400" fill="currentColor" aria-hidden="true"/>
                            <StarIcon class="h-4 w-4 mr-1 text-yellow-400" fill="currentColor" aria-hidden="true"/>
                            <StarIcon class="h-4 w-4 mr-1 text-yellow-400" fill="currentColor" aria-hidden="true"/>
                            <StarIcon class="h-4 w-4 mr-1 text-yellow-400" fill="currentColor" aria-hidden="true"/>
                            <StarIcon class="h-4 w-4 mr-1 text-stone-200" fill="currentColor" aria-hidden="true"/>
                        </div>
                    </div>
                    <div class="mb-4 inline-flex">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium mr-3">Enrol Course</a>
                    </div>
                    <div class="flex mb-6">
                        <img class="mr-4" src="/images/bimtech.png" alt="BimTech">
                        <img class="mr-4" src="/images/uniqueworld.png" alt="Unique World">
                    </div>
                </div>
                <div class="flex sm:w-1/2 items-center px-6 justify-end">
                    <div class="flex justify-end items-center bg-gradient-to-l from-rose-100 via-purple-100 to-violet-50 rounded-[15px] p-6">
                        <div class="flex flex-col mr-2">
                            <div class="text-zinc-800 text-[29px] font-bold uppercase leading-[34px]">Artificial Intelligence And Data Science</div>
                            <div class="text-black text-lg mb-6">For Aspiring AI PMs</div>
                            <div class="text-black mb-6">
                                <div class="text-sm mb-1">By</div>
                                <div class="text-xs font-semibold mb-1">Mr. Akarsh K Nair</div>
                                <div class="text-xs font-semibold">Rich Mironov</div>
                            </div>
                            <div class="text-zinc-800 text-xs leading-loose">Class Timing</div> 
                            <div class="flex items-center text-zinc-800 text-xs leading-loose">
                                <span class="mr-3">25th March 2023</span>
                                <span class="mr-3">to</span>
                                <span class="mr-3">27th March 2023</span>
                                <span class="mr-3">8:00PM to 9:30 PM IST</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center"><div>
                            <img src="/images/ai-ds.png" alt="Artificial Intelligence And Data Science"></div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 shadow-[0_4px_14px_rgba(0,0,0,0.04)]">
            <div class="flex">
                <a href="highlights" class="text-rose-500 text-base font-semibold mr-8">Highlights</a>
                <a href="courseinfo" class="text-zinc-800 text-base mx-8">Course Info</a>
                <a href="curriculum" class="text-zinc-800 text-base mx-8">Curriculum</a>
                <a href="requirements" class="text-zinc-800 text-base mx-8">Requirements</a>
                <a href="reviews" class="text-zinc-800 text-base mx-8">Reviews</a>
            </div>
        </div>
        
        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3" id="courses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-6">Course Highlights</div>
            <div class="flex flex-row flex-wrap">
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
                <div class="md:w-1/3 sm:w-1/4 flex w-full pr-8 mb-4">
                    <div class="flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-rose-500 flex items-center justify-between py-6 px-6">
                        <div class="mr-4"><img class="min-w-[20px] h-5" src="/images/check-circle.png" alt="Check-Circle"></div>
                        <div class="text-red-950 text-[15px] font-medium leading-[21px]">Helps to develop a strong theoretical understanding on the basics of AI</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-12 bg_gray_to_pink" id="courseinfo">
            <div class="flex flex-wrap justify-between items-center">
                <div class="lg:w-2/3 custom_md:w-1/2 w-full flex flex-col lg:pr-12 custom_md:pr-3 media_md:mb-4">
                    <div class="text-zinc-800 text-[25px] font-semibold mb-4">Course Info</div>
                    <div class="text-zinc-800 text-base leading-relaxed">n the current scenario, every industry is facing a boom as part of the Aartificial Iintelligence (AI) revolution. AI has found its applicability in several tasks, which has resulted in process automation in many industries. Most of the laborlabour-intensive tasks related to object detection, manufacturing, and production have gradually been taken over by machines as part of the AI revolution. Even though we refer to every single procedure that applies cognitive skills as AI, it can be classified into several subcategories. Various technologies, such as machine learning, deep learning, computer vision, and so on, cumulatively come under the general term AI. This course provides users with a basic introduction to AI, including both theoretical concepts and applications. It also provides an overview of various subcategories of AI and their use cases in real-life scenarios. We conclude the course by presenting some of the recent advancements in AI and the possibilities of AI integration with other technologies, such as IoT. The classes will be conducted live, and subscribers can access the recorded video classes of the live sessions for a duration of three months. After the successful completion of classes, e-certificates will be issued by Manorama Horizon.</div>
                </div>
                <div class="lg:w-1/3 custom_md:w-1/2 w-full w-full flex flex-col lg:pl-8 custom_md:pl-3">
                    <div class="bg-white rounded-[11px] border border-rose-500 px-4 py-6">
                        <div class="text-zinc-800 text-[19px] font-semibold border-b border-gray-600 pb-4 mb-4">Fundamentals Of Artificial Intelligence And Data Science</div>
                        <div class="pb-4 mb-4 border-b-2 border-dashed border-gray-600">
                            <div class="text-gray-600 text-[13px] font-medium">Course Fee</div>
                            <div class="flex items-center">
                                <div class="text-neutral-400 text-[29px] font-semibold mr-3">
                                    <span class="mr-1">₹</span>
                                    <span>449</span>
                                </div>
                                <div class="text-stone-300 text-[29px] font-semibold mr-3">
                                    <span class="mr-1">₹</span>
                                    <span class="line-through">3,199</span>
                                </div>
                            </div>
                        </div>
                        <div class="pb-8 mb-4 border-b-2 border-dashed border-gray-600">
                            <div class="text-zinc-800 text-base font-semibold mb-2">Class Timing</div>
                            <div class="flex items-center text-gray-600 text-base">
                                <span class="mr-2">25th March 2023</span>
                                <span class="mr-2">to</span>
                                <span class="mr-2">27th March 2023</span>
                            </div>
                            <div class="text-gray-600 text-base">8:00PM to 9:30 PM IST</div>
                        </div>
                        <div class="mt-6 mb-4">
                            <a href="#" class="w-full block bg-rose-500 rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center">Enrol Now</a>
                        </div>
                        <div class="text-indigo-800 text-[13px] leading-snug">You can access recorded class calls on your dashboard after each session</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 bg-pink-50" id="curriculum">
            <div class="text-center text-zinc-800 text-[25px] font-semibold mb-8">Course Curriculum</div>
            <div class="sm:w-3/4 mx-auto">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex text-zinc-800 text-base font-medium ">
                        <div class="mr-6">4 Days</div>
                        <div class="mr-6">8hr Total class</div>
                    </div>
                    <div><a href="#" class="text-rose-500 text-base font-medium">Expand all</a></div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day1collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day1collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 1 - Basics of AI</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day1collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 1 - Basics of AI content goes here.
                      </div>
                    </div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day2collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day2collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 2 - Introduction into classification, regression and clustering approaches.</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day2collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 2 - Introduction into classification, regression and clustering approaches content goes here
                      </div>
                    </div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day3collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day3collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 3 - Introduction into emerging learning Paradigms</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day3collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 3 - Introduction into emerging learning Paradigms content goes here.
                      </div>
                    </div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day4collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day4collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 4 - Introduction into classification, regression and clustering approaches.</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day4collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 4 - Introduction into classification, regression and clustering approaches content goes here.
                      </div>
                    </div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day5collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day5collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 5 - ntroduction to Neural Networks</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day5collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 5 - ntroduction to Neural Networks content goes here.
                      </div>
                    </div>
                </div>
                <div class="bg-white rounded-[5px] border border-zinc-200 px-4 mb-2">
                    <div class="flex justify-between items-center py-6 transition duration-150 ease-in-out"
                    data-te-collapse-init
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    href="#day6collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="day6collapse">
                        <div class="text-zinc-700 text-sm font-semibold">DAY 6 - Introduction into emerging learning Paradigms</div>
                        <div><ChevronDownIcon class="h-6 w-6 text-zinc-700" aria-hidden="true"/></div>
                    </div>

                    <div class="!visible hidden" id="day6collapse" data-te-collapse-item>
                      <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                        DAY 6 - Introduction into emerging learning Paradigms content goes here.
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3" id="requirements">
            <div class="flex flex-col">
                <div class="mb-6">
                    <div class="text-zinc-800 text-[25px] font-semibold mb-1">Eligibility</div>
                    <div class="text-gray-600 text-base leading-relaxed">Candidates joining Cisco Certified Support Technician (CCST) Cybersecurity training and certification program needs Computer Proficiency for hassle-free learning.</div>
                </div>
                <div class="mb-6 border-b border-dashed border-zinc-400">
                    <div class="text-zinc-800 text-[25px] font-semibold">Requirements</div>
                    <ul class="py-4">
                        <li class="flex text-base leading-loose mb-3">
                            <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div class="flex flex-grow flex-col text-gray-600 text-base leading-relaxed">There is no specific eligibility for this course.Anyone who would like to know more about artificial</div>
                        </li>
                    </ul>
                </div>
                <div class="mb-6 border-b border-dashed border-zinc-400">
                    <div class="text-zinc-800 text-xl font-semibold">System Requirements</div>
                    <ul class="py-4">
                        <li class="flex text-base leading-loose mb-3">
                            <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div class="flex flex-grow flex-col text-gray-600 text-base leading-relaxed">This course requires a system with a steady internet connection</div>
                        </li>
                    </ul>
                </div>
                <div class="mb-1">
                    <div class="text-zinc-800 text-xl font-semibold">Course Prerequisites</div>
                    <ul class="py-4">
                        <li class="flex text-base leading-loose mb-3">
                            <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div class="flex flex-grow flex-col text-gray-600 text-base leading-relaxed">Create an AWS Account and a Linux Machine in the Cloud. Watch this video</div>
                        </li>
                        <li class="flex text-base leading-loose mb-3">
                            <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div class="flex flex-grow flex-col text-gray-600 text-base leading-relaxed">After creating the account login, watch the video to understand the SSH key concepts

                                <ul class="my-4">
                                    <li class="flex text-base leading-loose mb-3 items-center">
                                        <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" /></svg></div>
                                        <div class="flex flex-grow flex-col"><a href="#" class="text-blue-800 text-base font-semibold leading-[35px]">AWS Account Creation</a></div>
                                    </li>
                                    <li class="flex text-base leading-loose tnclist_item mb-3 items-center">
                                        <div class="mr-4 flex text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" /></svg></div>
                                        <div class="flex flex-grow flex-col"><a href="#" class="text-blue-800 text-base font-semibold leading-[35px]">AWS Account Creation</a></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 bg-pink-50">
            <div class="flex items-center justify-between">
                <div class="sm:w-1/2 w-full flex flex-col">
                   <div class="text-zinc-800 text-[25px] font-semibold mb-6">Earn a career certificate</div> 
                   <div class="text-gray-600 text-base leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a typ</div>
                </div>
                <div><img src="/images/cert-sample.png" alt="Career Certificate Sample" /></div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-6">
            <div class="text-zinc-800 text-[25px] font-semibold mb-12">Resource Person</div>
            <div class="flex flex-col">
                <div class="flex items-center mb-8">
                    <div class="pr-8"><img class="min-w-[275px] h-[275px] rouned-lg" src="/images/resource-profile1.png" alt="Akarsh K Nair Picture" /></div>
                    <div class="flex flex-col flex-grow">
                        <div class="text-base leading-relaxed mb-4"><span class="text-zinc-800 ">Akarsh K Nair is a doctoral researcher at the Indian Institute of Information Technology (IIIT), Kottayam, specializing in distributed learning, machine learning, federated learning, and Edge Intelligence. Previously, he worked as an assistant professor in the Department of Computer Science at TEC College, Palakkad, India. In addition to being selected for the prestigious ACM Anveshan Setu mentorship program in 2021 and 2023, he is also associated with the iHub HCI foundation at IIT  doctoral fellow. Akarsh has already published several research </span><a href="#" class="text-blue-800">Read More</a></div>
                        <div class="text-zinc-800 text-[19px] font-semibold mb-1">Mr. Akarsh K Nair</div>
                        <div class="text-zinc-800 text-[19px] font-semibold">AI Product Management Leader / ex Amazon, Elsevier / MIT</div>
                    </div>
                </div>
               <div class="flex items-center mb-8">
                    <div class="pr-8"><img class="min-w-[275px] h-[275px] rouned-lg" src="/images/resource-profile2.png" alt="Rich Mironov Picture" /></div>
                    <div class="flex flex-col flex-grow">
                        <div class="text-base leading-relaxed mb-4"><span class="text-zinc-800 ">Akarsh K Nair is a doctoral researcher at the Indian Institute of Information Technology (IIIT), Kottayam, specializing in distributed learning, machine learning, federated learning, and Edge Intelligence. Previously, he worked as an assistant professor in the Department of Computer Science at TEC College, Palakkad, India. In addition to being selected for the prestigious ACM Anveshan Setu mentorship program in 2021 and 2023, he is also associated with the iHub HCI foundation at IIT  doctoral fellow. Akarsh has already published several research </span><a href="#" class="text-blue-800">Read More</a></div>
                        <div class="text-zinc-800 text-[19px] font-semibold mb-1">Rich Mironov</div>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-rose-50 rounded-[13px] px-8 py-12">
                    <div class="sm:w-1/2 w-full text-zinc-800 text-xl font-medium leading-[35px] mr-4">Your Comprehensive Guide to Fundamentals Of Artificial Intelligence And Data Science</div>
                    <div><a class="bg-rose-600 rounded-[5px] text-zinc-100 text-base font-semibold px-[18px] py-2.5">Download File</a></div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-6">
            <div class="flex items-center justify-between pb-6">
                <div class="flex items-center">
                    <StarIcon class="h-6 w-6 mr-2 text-yellow-400" fill="currentColor" aria-hidden="true"/>
                    <div class="text-zinc-800 text-2xl font-semibold">4.6 course rating</div>
                </div>
                <div><a href="#" class="text-rose-500 text-lg font-semibold">Write a review</a></div>
            </div>
            <div class="flex flex-wrap flex-row">
                <div class="md:w-1/2 w-full md:pr-8 py-8 md:border-t md:border-zinc-300">
                    <div class="flex items-center mb-6">
                        <div class="mr-4"><img class="w-[70px] h-[70px] rounded-full" src="/images/review-profile1.png" alt="Wasiu R Picture"/></div>
                        <div class="flex flex-col">
                            <div class="text-black text-lg font-semibold">Wasiu R.</div>
                            <div class="flex flex-wrap items-center">
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-zinc-300 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <div class="ml-2 text-gray-600 text-base">a month ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-zinc-800 text-base leading-relaxed">It's a great and amazing lecture, I feel like some is mentoring me to success. He opened my eyes to dozens of mistakes and misconceptions have made in previously. Thanks</div>
                </div>
                <div class="md:w-1/2 w-full md:pr-8 py-8 md:border-t md:border-zinc-300">
                    <div class="flex items-center mb-6">
                        <div class="mr-4"><img class="w-[70px] h-[70px] rounded-full" src="/images/review-profile2.png" alt="Andrew F. Picture"/></div>
                        <div class="flex flex-col">
                            <div class="text-black text-lg font-semibold">Andrew F.</div>
                            <div class="flex flex-wrap items-center">
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-zinc-300 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <div class="ml-2 text-gray-600 text-base">a month ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-zinc-800 text-base leading-relaxed">The initial lectures were more on theory. Would have loved if there was more of case study discussion or realistic examples based explanations.</div>
                </div>
                <div class="md:w-1/2 w-full md:pr-8 py-8 md:border-t md:border-zinc-300">
                    <div class="flex items-center mb-6">
                        <div class="mr-4"><img class="w-[70px] h-[70px] rounded-full" src="/images/review-profile1.png" alt="Szymon A. Picture"/></div>
                        <div class="flex flex-col">
                            <div class="text-black text-lg font-semibold">Szymon A.</div>
                            <div class="flex flex-wrap items-center">
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-zinc-300 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <div class="ml-2 text-gray-600 text-base">a month ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-zinc-800 text-base leading-relaxed">It's a great and amazing lecture, I feel like some is mentoring me to success. He opened my eyes to dozens of mistakes and misconceptions have made in previously. Thanks</div>
                </div>
                <div class="md:w-1/2 w-full md:pr-8 py-8 md:border-t md:border-zinc-300">
                    <div class="flex items-center mb-6">
                        <div class="mr-4"><img class="w-[70px] h-[70px] rounded-full" src="/images/review-profile2.png" alt="Nguyen Thi Ngoc P. Picture"/></div>
                        <div class="flex flex-col">
                            <div class="text-black text-lg font-semibold">Nguyen Thi Ngoc P.</div>
                            <div class="flex flex-wrap items-center">
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-yellow-400 font-semibold" fill="yello-400" aria-hidden="true"/>
                                <StarIcon class="h-6 w-6 mr-1 text-zinc-300 font-semibold" fill="currentColor" aria-hidden="true"/>
                                <div class="ml-2 text-gray-600 text-base">a month ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-zinc-800 text-base leading-relaxed">The initial lectures were more on theory. Would have loved if there was more of case study discussion or realistic examples based explanations.</div>
                </div>
            </div>
            <div class="py-3"><a href="#" class="text-blue-800 text-lg font-medium">View all reviews</a></div>
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
