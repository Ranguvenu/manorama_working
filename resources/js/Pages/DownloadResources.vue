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

        <div class="max-w-screen-2xl mx-auto px-16 mb-8 bg_gray_to_pink">
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2">
                    <ul class="flex nav_list flex-wrap mb-4">
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm">Home</a>
                        </li>
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm active">Downloadable Resources</a>
                        </li>
                    </ul>
                    <div class="text-zinc-800 text-[26px] font-semibold mb-4">Download Free Competitive Exam Coaching Materials</div>
                    <div class="text-zinc-800 text-[15px] leading-relaxed mb-4"><img src="/images/other_lang_text.png" alt="Language Text"/></div>
                </div>
                <div>
                    <img  src="/images/dwld_resources_banner.png" />
                </div> 
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3">
            <div class="text-zinc-800 text-base font-medium mb-12">Get access solved questions with solutions from experts. Compare your answers with the given solutions and key. Estimate your score and chances for getting selected.</div>
            <div class="flex justify-between items-center mb-6">
                <div class="w-72">
                    <select id="examdownload" class="bg-neutral-50 w-full block rounded-md border border-stone-200 text-black text-[13px] h-10 focus:ring-gray-500 focus:border-gray-500">
                        <option selected>Select</option>
                        <option value="US">Exam 1</option>
                        <option value="CA">Exam 2</option>
                        <option value="FR">Exam 3</option>
                        <option value="DE">Exam 4</option>
                    </select>
                </div>
                <div>
                    <div class="relative w-full flex items-center h-10 bg-neutral-50 shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-md  border border-stone-200 overflow-hidden px-6">
                        <MagnifyingGlassIcon class="mx-auto w-[19px] h-[19px] text-black" aria-hidden="true"/>

                        <input
                        class="h-full w-full bg-neutral-50 border-none shadow-none text-black text-base"
                        type="text"
                        id="searchexam"
                        placeholder="Search" /> 
                    </div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex flex-col">
                        <div class="text-black text-base font-semibold mb-2">Kochi Naval Ship Repair Yard Apprenticeship</div>
                        <div class="text-gray-600 text-base leading-relaxed mb-3">Enrollment for apprenticeship training in designated trades in naval ship repair yard and naval aircraft yard</div>
                        <div class="flex items-center">
                            <div class="text-gray-600 text-[14px] mr-6">APRIL 28, 2023</div>
                            <div><a href="#" class="text-indigo-800 text-[14px] mr-6">Solved Question Papper</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Download</a>
                    </div>
                </div>
                <div class="flex items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex flex-col">
                        <div class="text-black text-base font-semibold mb-2">Kerala PSC Exam Calendar July 2023</div>
                        <div class="text-gray-600 text-base leading-relaxed mb-3">Enrollment for apprenticeship training in designated trades in naval ship repair yard and naval aircraft yard</div>
                        <div class="flex items-center">
                            <div class="text-gray-600 text-[14px] mr-6">APRIL 28, 2023</div>
                            <div><a href="#" class="text-indigo-800 text-[14px] mr-6">Solved Question Papper</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Download</a>
                    </div>
                </div>
                <div class="flex items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex flex-col">
                        <div class="text-black text-base font-semibold mb-2">Army ASC Centre South Recruitment 2023 Notification</div>
                        <div class="text-gray-600 text-base leading-relaxed mb-3">Enrollment for apprenticeship training in designated trades in naval ship repair yard and naval aircraft yard</div>
                        <div class="flex items-center">
                            <div class="text-gray-600 text-[14px] mr-6">APRIL 28, 2023</div>
                            <div><a href="#" class="text-indigo-800 text-[14px] mr-6">Solved Question Papper</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Download</a>
                    </div>
                </div>
                <div class="flex items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex flex-col">
                        <div class="text-black text-base font-semibold mb-2">Army HQ Southern Command Signals Recruitment 2023</div>
                        <div class="text-gray-600 text-base leading-relaxed mb-3">Enrollment for apprenticeship training in designated trades in naval ship repair yard and naval aircraft yard</div>
                        <div class="flex items-center">
                            <div class="text-gray-600 text-[14px] mr-6">APRIL 28, 2023</div>
                            <div><a href="#" class="text-indigo-800 text-[14px] mr-6">Solved Question Papper</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Download</a>
                    </div>
                </div>
                <div class="flex items-center justify-between px-4 py-6 mb-4 bg-white rounded-lg border border-neutral-200">
                    <div class="flex flex-col">
                        <div class="text-black text-base font-semibold mb-2">Army ASC Centre South Recruitment 2023 Notification</div>
                        <div class="text-gray-600 text-base leading-relaxed mb-3">Enrollment for apprenticeship training in designated trades in naval ship repair yard and naval aircraft yard</div>
                        <div class="flex items-center">
                            <div class="text-gray-600 text-[14px] mr-6">APRIL 28, 2023</div>
                            <div><a href="#" class="text-indigo-800 text-[14px] mr-6">Solved Question Papper</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Download</a>
                    </div>
                </div>
            </div>
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
        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-100 h-[250px]"></div>
    </div>
</template>
