<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { ChevronRightIcon } from "@heroicons/vue/24/solid";
    import Button from '@/Components/Button.vue';

    export default{
    components:{
        MagnifyingGlassIcon,
        ChevronRightIcon,
        Button
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
    <Head title="About Us" />
    <!-- <header class="max-w-screen-2xl mx-auto bg-white shadow px-4 md:px-16 siteheader w-full md:fixed sm:h-[90px] top-0">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="pr-4 hidden md:block"><img  src="/images/homepage/homelogo.png" alt="Logo" /></div>
                <div class="pr-4 block md:hidden"><img  src="/images/homepage/homelogo.png" alt="Logo" /></div>
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
                </div>-->
                <!-- <div class="pl-17"><Button class="px-6 font-medium m-0" size="sm" color="primary">Login</Button></div> -->
            <!-- </div>
        </div>
    </header>
 -->    <div class="content-wrap mt-[90px]">
        <div class="max-w-screen-2xl mx-auto px-16 pt-4 bg_gray_to_pink">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <ul class="flex nav_list flex-wrap mb-4">
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm">Home</a>
                        </li>
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm active">About Us</a>
                        </li>
                    </ul>
                    <div class="pr-8 mt-4">
                        <div class="text-zinc-800 text-[32px] font-semibold pb-3">About Us</div>
                        <div class="w-[510px] text-gray-600 text-[15px]">Learn how we're working to expand the possibilities of content and technology to support learning in a connected world</div>
                    </div>
                </div>
                <div class="md:flex hidden">
                    <img  src="/images/aboutus/aboutus-img.png" />
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12">
            <div class="flex flex-col">
                <div class="text-zinc-800 text-[22px] font-semibold mb-3">Why Manorama Horizon?</div>
                <div class="text-zinc-800 text-base mb-12">Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.</div>
            </div>
            <div class="text-zinc-800 text-[22px] font-semibold mb-3">Who are we?</div>
            <div class="flex">
                <div class="text-zinc-800 text-base sm:w-2/3 sm:pr-8">
                    <p class="mb-3">Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.</p>

                    <p class="mb-3">We reinforce our commitment to the field of knowledge by presenting top-class content in a universal and comprehensive manner. The website, managed by an efficient and experienced bunch of professionals, equips users with digital augmentation and smart learning tools. We promote effective learning and give an opportunity to students to learn as per their own timetable. We provide a better understanding of concepts through applicable real-life examples at affordable pricing.</p>
                </div>
                <div class="sm:w-1/3">
                    <img  src="/images/aboutus/videoscrnshot.png" class="rounded-xl"/>
                    <!-- <video class="w-full" autoplay muted controls>
                        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
                    </video> -->
                </div>
            </div>
        </div>

       <!--  <div class="max-w-screen-2xl mx-auto w-full px-16 py-12 mb-4">
            
        </div> -->

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-12">
            <div class="text-zinc-800 text-[22px] font-semibold mb-4">Our Products</div>
            <div class="flex flex-col bg-red-50 rounded-[11px]">
                <div class="flex items-center py-8 px-6">
                    <div class="sm:w-1/2 sm:pr-8">
                        <img  src="/images/aboutus/school_exams.png" alt="School Exams" class="rounded-xl"/>
                    </div>
                    <div class="sm:w-1/2">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-xl font-semibold mb-3">School Exams</div>
                            <div class="text-zinc-800 text-base"><p class="mb-1">Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.</p></div>
                            <div class="text-blue-800 text-md font-medium flex mb-2"><a href="#">View All Courses <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" alt="View All Courses" /></span></a></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center py-8 px-6">
                    <div class="sm:w-1/2 sm:pr-12">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-xl font-semibold mb-3">Competitive Exams</div>
                            <div class="text-zinc-800 text-base pr-4"><p class="mb-1">Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.</p></div>
                            <div class="text-blue-800 text-md font-medium flex mb-2"><a href="#">View All Courses <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" alt="View All Courses" /></span></a></div>
                        </div>
                    </div>
                    <div class="sm:w-1/2">
                        <img  src="/images/aboutus/comp_exams.png" alt="Competitive Exams" class="rounded-xl"/>
                    </div>
                </div>
                <div class="flex items-center py-8 px-6">
                    <div class="sm:w-1/2 sm:pr-8">
                        <img  src="/images/aboutus/cert_courses.png" alt="Certificate Courses" class="rounded-xl"/>
                    </div>
                    <div class="sm:w-1/2">
                        <div class="flex flex-col">
                            <div class="text-zinc-800 text-xl font-semibold mb-3">Certificate Courses</div>
                            <div class="text-zinc-800 text-base"><p class="mb-1">Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.</p></div>
                            <div class="text-blue-800 text-md font-medium flex mb-2"><a href="#">View All Courses <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" alt="View All Courses" /></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-12">
            <div class="text-zinc-800 text-[22px] font-semibold mb-4">Our Instructors</div>
            <div class="flex flex-row flex-wrap">
                <div class="sm:w-1/4 pr-4 mb-4">
                    <div class="flex flex-col rounded-[22px] border border-zinc-200 p-4">
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor1.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor2.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor3.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor4.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor1.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor2.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor3.png" alt="Instructor Profile Picture" /></div>
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
                        <div class="mb-4"><img class="rounded-[14px]" src="/images/aboutus/instructor4.png" alt="Instructor Profile Picture" /></div>
                        <div class="text-center text-zinc-800 text-base font-semibold">Rachita Sachdeva</div>
                        <div class="text-center mb-2">
                            <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">5+ Years Exp</span>
                        </div>
                        <div class="text-center text-gray-600 text-[13px]mb-2">Chemistry master teacher</div>
                        <div class="text-center text-gray-600 text-[13px] font-semibold">IIS University</div>
                    </div>
                </div>
            </div>
            <div class="text-blue-800 text-md font-medium flex my-3"><a href="#">View All instructors <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 pt-3 mb-4">
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
    </div>
    <footer>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-6 bg-neutral-700">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <div class="text-white text-lg font-medium my-4 relative">Manorama Horizon<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] left-0"></span></div>
                    <ul class="text-white text-sm font-medium py-6">
                        <li class="mb-3">
                            <a href="#" class=" hover:underline">About</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Tearm & Conditions</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Careers</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">Downloadable Resources</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">Articles</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Webinars</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Study Materials</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <div class="text-white text-lg font-medium my-4 relative">School Students<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] left-0"></span></div>
                    <ul class="text-white text-sm font-medium py-6">
                        <li class="mb-3">
                            <a href="#" class=" hover:underline">CBSE Class 8</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">CBSE Class 9</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">CBSE Class 10</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">CBSE Class 11</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">CBSE Class 12</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">Kerala State Class 8</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Kerala State Class 9</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Kerala State Class 10</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Kerala State Class 11</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Kerala State Class 12</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <div class="text-white text-lg font-medium my-4 relative">Upskilling<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] left-0"></span></div>
                    <ul class="text-white text-sm font-medium py-6">
                        <li class="mb-3">
                            <a href="#" class=" hover:underline">Professional English</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Data Science Programming</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Learn French</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Embedded Product Design <br/>and development</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">Learn Germen</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">Mushroom Farming</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Public Speaking</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <div class="text-white text-lg font-medium my-4 relative">Undergraduates<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] left-0"></span></div>
                    <ul class="text-white text-sm font-medium py-6">
                        <li class="mb-3">
                            <a href="#" class=" hover:underline">KPSC test series</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">Degree Level Prelims</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">KAS</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">UPSC</a>
                        </li>
                         <li class="mb-3">
                            <a href="#" class="hover:underline">SSC CGL and CHSL</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <div class="text-white text-lg font-medium my-4 relative">Contact Us<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] left-0"></span></div>
                    <ul class="text-white text-sm font-medium py-6">
                        <li class="mb-3">
                            <a href="#" class=" hover:underline">support@manoramahorizon.com</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="hover:underline">+91 90489 91111</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <div class="text-white text-base font-medium mr-4">Follow us on</div>
                <div class="mr-3"><img  src="/images/socialicon/facebook.png" alt="Facebook" /></div>
                <div class="mr-3"><img  src="/images/socialicon/instagram.png" alt="Instagram" /></div>
                <div class="mr-3"><img  src="/images/socialicon/youtube.png" alt="YouTube" /></div>
                <div class="mr-3"><img  src="/images/socialicon/linkedin.png" alt="LinkedIn" /></div>
                <div class="mr-3"><img  src="/images/socialicon/pinterest.png" alt="Pinterest" /></div>
            </div>
        </div>
        <div class="flex justify-center py-8 bg-zinc-800">
            <div class="text-white text-sm"><span>© 2023 Manorama Horizon. All Rights Reserved | </span><span class="underline">Sitemap</span></div>
        </div>
    </footer>
</template>
