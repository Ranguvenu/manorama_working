<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import Button from '@/Components/Button.vue';
    import { ChevronDownIcon } from "@heroicons/vue/24/solid";
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
        ChevronDownIcon,
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
        <div class="max-w-screen-2xl mx-auto px-16 py-8 bg_gray_to_pink">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">K12 Listing</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">CBSE Class 8</a>
                </li>
            </ul>
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2">
                    <div class="text-gray-600 text-base mb-3">CBSE</div>
                    <div class="text-zinc-800 text-4xl font-semibold leading-[44px] mb-4">Class 8</div>
                    <div class="text-zinc-800 text-base leading-relaxed mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry</div>

                    <div class="mb-4 inline-flex">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium mr-3">Enrol Now</a>
                        <a href="#" class="px-[18px] py-2.5 bg-white text-rose-500 rounded-[5px] border border-rose-600 text-base font-medium mr-3">Enquire Now</a>
                    </div>
                    <div class="flex items-center">
                        <div class="mr-2"><img src="/images/product/youtube.png" alt="View us on youtube" /></div>
                        <div class="text-black text-base font-medium leading-[25px]">View us on youtube</div>
                    </div>
                </div>
                <div class="flex flex-col sm:w-1/2 justify-center items-center">
                    <img src="/images/product/classimg.png" alt="CBSE Class 8" />
                </div> 
            </div>
            <div class="flex items-center justify-between mt-12">
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/webinarclass.png" alt="Live master classes" />
                    </div>
                    <div class="text-black text-sm leading-tight">Live master classes</div>
                </div>
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/pqtarget.png" alt="Practice questions" />
                    </div>
                    <div class="text-black text-sm leading-tight">Practice questions</div>
                </div>
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/classnotes.png" alt="Flash cards and class notes" />
                    </div>
                    <div class="text-black text-sm leading-tight">Flash cards and <br/>class notes</div>
                </div>
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/tests-reports.png" alt="Tests and reports" />
                    </div>
                    <div class="text-black text-sm leading-tight">Tests and reports</div>
                </div>
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/mentership-icon.png" alt="Mentorship and PTMs" />
                    </div>
                    <div class="text-black text-sm leading-tight">Mentorship and PTMs</div>
                </div>
                <div class="flex items-center flex-col mr-2">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/concept-videos.png" alt="Concept videos" />
                    </div>
                    <div class="text-black text-sm leading-tight">Concept videos</div>
                </div>
                <div class="flex items-center flex-col">
                    <div class="w-[50px] h-[50px] mb-4">
                        <img  src="/images/product/doubt-solve.png" alt="Doubt solving" />
                    </div>
                    <div class="text-black text-sm leading-tight">Doubt solving</div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 product-tabs">
            <div class="flex">
                <a href="courses" class="text-rose-500 text-base font-semibold mr-8">Courses</a>
                <a href="instructors" class="text-zinc-800 text-base mx-8">Instructors</a>
                <a href="features" class="text-zinc-800 text-base mx-8">Features</a>
                <a href="testimonials" class="text-zinc-800 text-base mx-8">Testimonials</a>
                <a href="faq" class="text-zinc-800 text-base mx-8">FAQ</a>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-3 bg_gray_to_pink" id="courses">
            <div class="text-zinc-800 text-[25px] font-semibold leading-[35px]">Courses</div>
            <div class="flex flex-wrap bg-white rounded-[15px] border border-zinc-200">
                <div class="md:w-3/4 custom_md:w-3/5 w-full flex flex-wrap flex-col">
                    <div class="flex flex-wrap justify-between py-3 lg:px-8 px-4 bg-white rounded-tl-2xl media_md:rounded-tr-2xl">
                        <div class="text-black text-xl font-semibold mb-2">CBSE Class 08</div>
                        <div class="bg-pink-100 rounded border border-dashed border-rose-500 px-4 py-1 inline-flex mb-2">
                            <div class="text-black text-base">Batch start date </div>
                            <div class="text-black text-base">:</div>
                            <div class="text-rose-500 text-base">13 Aug 2023</div>
                        </div>
                    </div>
                    <div class="bg-pink-50 py-1 px-8"><span class="text-emerald-950 text-sm font-semibold leading-[21px]">Subjects</span></div>
                    <div class="flex flex-row flex-wrap p-8">
                        <div class="sm:w-1/2 custom_md:w-full w-full flex items-center mb-5">
                            <input checked id="science-checkbox" type="checkbox" value="" class="w-5 h-5 text-rose-500 bg-rose-500 border-rose-500 rounded-[3px] focus:ring-rose-500 dark:focus:ring-rose-500 dark:ring-offset-rose-800 focus:ring-2 dark:bg-rose-700 dark:border-rose-600">
                            <label for="mathematics-checkbox" class="ml-2 text-emerald-950 text-sm font-medium">Science</label>
                        </div>
                        <div class="sm:w-1/2 custom_md:w-full w-full flex items-center mb-5">
                            <input checked id="socialscience-checkbox" type="checkbox" value="" class="w-5 h-5 text-rose-500 bg-rose-500 border-rose-500 rounded-[3px] focus:ring-rose-500 dark:focus:ring-rose-500 dark:ring-offset-rose-800 focus:ring-2 dark:bg-rose-700 dark:border-rose-600">
                            <label for="mathematics-checkbox" class="ml-2 text-emerald-950 text-sm font-medium">Social Science (e-learning content)</label>
                        </div>
                        <div class="sm:w-1/2 custom_md:w-full w-full flex items-center mb-5">
                            <input checked id="mathematics-checkbox" type="checkbox" value="" class="w-5 h-5 text-rose-500 bg-rose-500 border-rose-500 rounded-[3px] focus:ring-rose-500 dark:focus:ring-rose-500 dark:ring-offset-rose-800 focus:ring-2 dark:bg-rose-700 dark:border-rose-600">
                            <label for="mathematics-checkbox" class="ml-2 text-emerald-950 text-sm font-medium">Mathematics</label>
                        </div>
                        <div class="sm:w-1/2 custom_md:w-full w-full flex items-center mb-5">
                            <input id="physics-checkbox" type="checkbox" value="" class="w-5 h-5 text-rose-500 bg-white border-rose-500 rounded-[3px] focus:ring-rose-500 dark:focus:ring-rose-500 dark:ring-offset-rose-500 focus:ring-2 dark:bg-white dark:border-rose-500">
                            <label for="science-checkbox" class="ml-2 text-emerald-950 text-sm font-medium">Physics</label>
                        </div>
                    </div>
                    <div class="h-1 bg-slate-50"></div>
                    <div class="flex justify-between rounded-bl-[11px] px-8 py-5">
                        <div><a href="#" class="text-center text-rose-500 text-sm font-medium leading-[21px]">Download Study Plan</a></div>
                        <div class="flex items-center">
                            <a class="text-center text-rose-500 text-sm font-medium leading-[21px] mr-1" data-te-collapse-init
                            data-te-ripple-init
                            data-te-ripple-color="light"
                            href="#viewsyllabus"
                            role="button"
                            aria-expanded="false"
                            aria-controls="viewsyllabus">View Syllabus</a><ChevronDownIcon class="h-5 w-5 text-rose-500 font-semibold" aria-hidden="true"/>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4 custom_md:w-2/5 w-full flex flex-wrap flex-col bg-purple-50 md:rounded-tr-2xl rounded-br-[11px] media_md:rounded-bl-2xl px-3 py-5">
                    <div class="text-indigo-800 text-lg font-semibold leading-[27px] py-2 mb-3">CBSE Class 8</div>
                    <div class="flex items-center mb-1">
                        <div class="text-gray-600 text-base line-through leading-[21px] mr-2">₹10,000</div>
                        <div class="text-green-600 text-base font-semibold mr-2">(50% OFF)</div>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="text-zinc-800 text-[32px] font-bold mr-1">₹5,000/-</div>
                        <div class="text-black text-xl font-medium">Only</div>
                    </div>
                    <div class="w-full flex justify-center bg-rose-600 rounded-md mb-3"><a href="#" class="px-[18px] py-2.5 text-center text-white text-sm font-medium leading-[21px]">Enrol Now</a></div>
                    <div class="w-full flex justify-center bg-white rounded-md border-b-[4px] border-pink-600"><a href="#" class="px-[18px] py-2.5 text-center text-rose-500 text-sm font-medium leading-[21px]">Get Your Free Trial</a></div>
                </div>
                <div class="!visible hidden" id="viewsyllabus" data-te-collapse-item aria-labelledby="viewsyllabus">
                  <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 dark:text-neutral-50">
                    Some placeholder content for the collapse component. This panel is
                    hidden by default but revealed when the user activates the relevant
                    trigger.
                  </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 bg_gray_to_pink">
            <div class="flex flex-col">
                <div class="flex justify-between items-center my-6">
                    <div class="text-zinc-800 text-[22px] font-semibold">Instructors</div>
                    <div class="text-blue-800 text-md font-medium pr-4"><a href="#">View All instructors <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
                </div>
                <div class="flex flex-row flex-wrap">
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col rounded-[22px] border border-zinc-200 p-4">
                            <div class="mb-4"><img class="rounded-[14px] w-full" src="/images/aboutus/instructor1.png" alt="Instructor Profile Picture" /></div>
                            <div class="text-center text-zinc-800 text-base font-semibold">Rachita Sachdeva</div>
                            <div class="text-center mb-2">
                                <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">5+ Years Exp</span>
                            </div>
                            <div class="text-center text-gray-600 text-[13px]mb-2">Chemistry master teacher</div>
                            <div class="text-center text-gray-600 text-[13px] font-semibold">IIS University</div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col rounded-[22px] border border-zinc-200 p-4">
                            <div class="mb-4"><img class="rounded-[14px] w-full" src="/images/aboutus/instructor2.png" alt="Instructor Profile Picture" /></div>
                            <div class="text-center text-zinc-800 text-base font-semibold">Rachita Sachdeva</div>
                            <div class="text-center mb-2">
                                <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">5+ Years Exp</span>
                            </div>
                            <div class="text-center text-gray-600 text-[13px]mb-2">Chemistry master teacher</div>
                            <div class="text-center text-gray-600 text-[13px] font-semibold">IIS University</div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col rounded-[22px] border border-zinc-200 p-4">
                            <div class="mb-4"><img class="rounded-[14px] w-full" src="/images/aboutus/instructor3.png" alt="Instructor Profile Picture" /></div>
                            <div class="text-center text-zinc-800 text-base font-semibold">Rachita Sachdeva</div>
                            <div class="text-center mb-2">
                                <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">5+ Years Exp</span>
                            </div>
                            <div class="text-center text-gray-600 text-[13px]mb-2">Chemistry master teacher</div>
                            <div class="text-center text-gray-600 text-[13px] font-semibold">IIS University</div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col rounded-[22px] border border-zinc-200 p-4">
                            <div class="mb-4"><img class="rounded-[14px] w-full" src="/images/aboutus/instructor4.png" alt="Instructor Profile Picture" /></div>
                            <div class="text-center text-zinc-800 text-base font-semibold">Rachita Sachdeva</div>
                            <div class="text-center mb-2">
                                <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">5+ Years Exp</span>
                            </div>
                            <div class="text-center text-gray-600 text-[13px]mb-2">Chemistry master teacher</div>
                            <div class="text-center text-gray-600 text-[13px] font-semibold">IIS University</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-4 bg_gray_to_pink">
            <div class="text-zinc-800 text-[26px] font-semibold mb-6">Results</div>
            <div class="flex items-center gradient-glitter-img px-16 py-12">
                <div class="sm:w-1/2 flex flex-col">
                    <div class="text-white text-[22px] font-normal leading-[35px] mb-3">Manorama Horizon stars shine supreme in</div>
                    <div class="text-white text-4xl font-semibold mb-8">Class 8 CBSE Science , 2023</div>
                    <div class="flex self-start rounded-[10px] border border-zinc-100 px-4 py-2">
                        <div class="text-amber-300 text-6xl font-semibold mr-8">236</div>
                        <div class="text-amber-300 text-[22px] font-normal">Student Score<br/>Above 90%</div>
                    </div>
                </div>
                <div class="sm:w-1/2 flex justify-center items-center">
                    <div class="flex flex-col items-center justify-center mr-12 relative">
                        <div class="relative">
                            <img  src="/images/product/star.png" alt="Star"/>
                        
                            <img class="absolute top-[15px] left-[-2px]" src="/images/product/results-profile1.png" alt="Profile Picture of Angel"/>
                            <div class="absolute bottom-[-49px] left-[12px] bg-gradient-to-l from-yellow-600 to-rose-500 rounded-xl px-2 py-2 mb-2">
                                <div class="text-white text-[17px]">Angel Mathew</div>
                                <div class="text-white text-[11px]">Class X, 2022-23</div>
                            </div>
                        </div>
                        <div class="text-white text-[22px] font-bold mt-12">91% marks</div>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="relative">
                            <img  src="/images/product/star.png" alt="Star"/>
                        
                            <img class="absolute top-[10px] left-[7px]" src="/images/product/results-profile2.png" alt="Profile Picture of Angel"/>
                            <div class="absolute bottom-[-49px] left-[12px] bg-gradient-to-l from-yellow-600 to-rose-500 rounded-xl px-2 py-2 mb-2">
                                <div class="text-white text-[17px]">Angel Mathew</div>
                                <div class="text-white text-[11px]">Class X, 2022-23</div>
                            </div>
                        </div>
                        <div class="text-white text-[22px] font-bold mt-12">91% marks</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 pb-6 bg_gray_to_pink">
            <div class="flex flex-col justify-center items-center">
                <div class="text-zinc-800 text-[26px] font-semibold mb-2">Exploring Our Impressive Range of Features</div>
                <div class="text-center text-gray-600 text-[15px]">Unveiling a Suite of Capabilities Designed to Elevate Your Experience</div>
            </div>
            <div class="flex flex-col rounded-[11px] mt-2">
                <div class="flex items-center py-8 px-6">
                    <div class="sm:w-1/2 sm:pr-12">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-[22px] font-semibold mb-3">Live class and Concept Videos</div>
                            <div class="text-gray-600 text-base"><p class="mb-1">Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives,</p></div>
                        </div>
                    </div>
                    <div class="sm:w-1/2">
                        <img  src="/images/product/liveclass-img.png" alt="Live class and Concept Videos" class="rounded-xl"/>
                    </div>
                </div>
                <div class="flex items-center py-1 px-6">
                    <div class="sm:w-1/2 sm:pr-12">
                         <div class="img_wrap relative"><img  src="/images/product/practiceqa-img1.png" alt="Practice question and study materials" class="rounded-xl"/>
                         <img  src="/images/product/practiceqa-img3.png" alt="Practice question and study materials" class="rounded-xl absolute top-[60px] right-0"/>
                         <img  src="/images/product/practiceqa-img2.png" alt="Practice question and study materials" class="rounded-xl absolute bottom-[12px] right-0"/></div>
                    </div>
                    <div class="sm:w-1/2">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-[22px] font-semibold mb-3">Practice question and study materials</div>
                            <div class="text-gray-600 text-base"><p class="mb-1">Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives,</p></div>
                        </div>
                    </div>
                </div>
                 <div class="flex items-center py-8 px-6">
                    <div class="sm:w-1/2 sm:pr-12">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-[22px] font-semibold mb-3">Mentorship and doubt solving</div>
                            <div class="text-gray-600 text-base"><p class="mb-1">Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives,</p></div>
                        </div>
                    </div>
                    <div class="sm:w-1/2">
                        <img  src="/images/product/mentorship.png" alt="Mentorship and doubt solving" class="rounded-xl"/>
                    </div>
                </div>
                <div class="flex items-center py-1 px-6">
                    <div class="sm:w-1/2 sm:pr-12">
                        <img  src="/images/product/ptms.png" alt="PTMs and Reporting" class="rounded-xl"/>
                    </div>
                    <div class="sm:w-1/2">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-[22px] font-semibold mb-3">PTMs and Reporting</div>
                            <div class="text-gray-600 text-base"><p class="mb-1">Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives,</p></div>
                        </div>
                    </div>
                </div>
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

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-12 bg_gray_to_pink">
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

        <div class="max-w-screen-2xl overflow-hidden mx-auto w-full px-16 py-12 bg-violet-100">
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

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12 bg-gradient-to-r from-white via-pink-50 to-white">
            <div class="flex flex-col items-center pb-12">
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
