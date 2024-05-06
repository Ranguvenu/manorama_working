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
    <Head title="Sitemap" />
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
        <div class="max-w-screen-2xl mx-auto px-16 py-3 mb-6">
            <ul class="flex nav_list mb-6">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Sitemap</a>
                </li>
            </ul>
            <div class="text-black text-[25px] font-semibold">Manorama Horizon Sitemap</div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 my-6">
            <div class="inline-block lg:columns-3 custom_md:lg:columns-2">
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Our Products</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">School Board</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Comparative Exams</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Certificate Courses</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Comparative Exams</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base ">Civil Services Examination (UPSC)</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Articles</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">CBSE</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">CBSE Class 8</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">CBSE Class 9</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">CBSE Class 10</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">CBSE Class 11</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">CBSE Class 12</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Certificate Courses</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management Professional (PMP)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management Professional (PMP)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management Professional (PMP)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management Professional (PMP)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Project Management</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Webinar</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Kerala State</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">Kerala State Class 8</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Kerala State Class 9</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Kerala State Class 10</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Kerala State Class 11</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Kerala State Class 12</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Blogs</div></div>
                        <div class="flex flex-col py-8 px-4">
                           <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Civil Services Examination (UPSC)</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Xavier Admisiion Test</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Staff selection commision</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base ">Civil Services Examination (UPSC)</a></div>
                        </div>
                    </div>
                </div>
                <div class="w-full inline-block">
                    <div class="flex flex-col bg-white rounded-[11px] border border-gray-200 mr-3 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4"><div class="text-black text-base font-semibold">Others</div></div>
                        <div class="flex flex-col py-8 px-4">
                            <div class="mb-4"><a href="#" class="text-black text-base">About</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Terms and conditions</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Privacy Policy</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Careers</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Downloadable Resources</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Articles</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">About</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Webinars</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Study Material</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Exam Calander</a></div>
                            <div class="mb-4"><a href="#" class="text-black text-base">Contact us</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-700 h-[250px]"></div>
    </div>
</template>
