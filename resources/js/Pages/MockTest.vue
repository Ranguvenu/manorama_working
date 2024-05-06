<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { CheckIcon } from "@heroicons/vue/24/solid";

    export default{
    components:{
        MagnifyingGlassIcon,
        CheckIcon
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
    <Head title="Mock Test" />
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
        <div class="max-w-screen-2xl mx-auto px-16 py-8 mb-8 bg_gray_to_pink">
            <ul class="flex nav_list mb-1">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Mock Test</a>
                </li>
            </ul>
            <div class="flex items-center justify-between">
                <div class="flex flex-col sm:w-1/2">
                    <div class="text-zinc-800 text-[29px] font-semibold leading-[35px] mb-4">Manorama Yearbook Online - Manorama Horizon FREE Civil Services Prelims Mock Test Series</div>

                    <div class="text-blue-800 text-base leading-relaxed">MANORAMA</div>
                    <div class="text-blue-800 text-base font-bold leading-relaxed tracking-wider">YEARBOOK</div>

                </div>
                <div class="flex sm:w-1/2 items-center px-6 justify-end">
                   <img  src="/images/mocktest-banner.png" alt="Mock Test Services" />
                </div> 
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-3">
            <div class="text-zinc-800 text-[25px] font-semibold mb-4">Get Ready for UPSC Prelims 2023</div>
            <div class="text-gray-600 text-base leading-relaxed mb-6">Attempting the UPSC Civil Services Prelims Exams 2023? Here's what you should be doing now. Read. Prioritize. Finalize your last lap strategy. REVISE. It goes without saying that the best way to revise is by attempting as many mock tests as possible. They help you evaluate your level of preparation as well as your mental readiness for the exam. Register for the Manorama Yearbook Online - Horizon Free Open Mock Test Series today. We offer you a set of TEN TESTS covering all subjects, aligned with the UPSC exam pattern. Keep working hard. Stay motivated. We hope you find the best version of yourself in this journey!</div>

            <div class="text-zinc-800 text-[25px] font-semibold mb-4">Exam Details</div>
            <div class="text-zinc-800 text-sm font-medium mb-6">20 Questions | 01:15:00 | 100 Marks</div>
            <div class="bg-white rounded-[11px] border border-rose-500">
                <table class="w-full" id="exam-details">
                    <thead class="bg-rose-50">
                        <tr class="text-zinc-800 text-base font-medium leading-loose">
                            <th scope="col" class="px-6 py-2">
                                Test Name
                            </th>
                            <th scope="col" class="px-6 py-2">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-2">
                                To Attend
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-200 text-gray-600 text-base">
                            <td scope="row" class="px-6 py-4">
                                Year Book Test 7/4/23
                            </td>
                            <td class="px-6 py-4">
                                Apr 13, 2023
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-rose-500 font-medium">Go to dashboard</a>
                            </td>
                        </tr>
                        <tr class="bg-neutral-50 border-b border-gray-200 text-gray-600 text-base">
                            <td scope="row" class="px-6 py-4">
                                Year Book Test 7/4/23
                            </td>
                            <td class="px-6 py-4">
                                Apr 13, 2023
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-rose-500 font-medium">Go to dashboard</a>
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-200 text-gray-600 text-base">
                            <td scope="row" class="px-6 py-4">
                                Year Book Test 7/4/23
                            </td>
                            <td class="px-6 py-4">
                                Apr 13, 2023
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-rose-500 font-medium">Go to dashboard</a>
                            </td>
                        </tr>
                        <tr class="bg-neutral-50 border-b border-gray-200 text-gray-600 text-base">
                            <td scope="row" class="px-6 py-4">
                                Year Book Test 7/4/23
                            </td>
                            <td class="px-6 py-4">
                                Apr 13, 2023
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-rose-500 font-medium">Go to dashboard</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full px-16 py-12">
            <div class="flex flex-col">
                <div class="mb-8">
                    <div class="text-zinc-800 text-[25px] font-semibold mb-6">Instructions</div>
                    <ul>
                        <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">The timer starts as soon as you click on 'Take the Test' button. You can resume the test but you have to complete the test within the specified time. No extra time is allowed.</div>
                        </li>
                       <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">Each question has four options. You can select only one.</div>
                        </li>
                    </ul>
                </div>

                <div class="mb-8">
                    <div class="text-zinc-800 text-[25px] font-semibold mb-6">Disclaimer</div>
                    <ul>
                        <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">Test will be conducted in ONLINE mode only. Admit card is NOT needed.</div>
                        </li>
                        <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">After registration students can directly log in to the site and attempt the test in the scheduled time frame.</div>
                        </li>
                        <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">If, in any case, you are not able to attempt a test on the scheduled date, you can attempt it after the declaration of its result.</div>
                        </li>
                        <li class="flex text-gray-600 text-base leading-relaxed mb-3 items-center">
                            <div class="mr-4 flex"><span class="w-[9px] h-[9px] bg-gray-600 rounded-full"></span></div>
                            <div class="flex flex-grow">The tests are free of cost.</div>
                        </li>
                    </ul>
                </div>

                <div class="bg-pink-50 rounded-[11px] px-4 py-6">
                    <div class="text-black text-[25px] font-semibold mb-4">Unique Features</div>
                    <ul>
                        <li class="flex text-base leading-relaxed mb-3">
                            <div class="mr-4 flex text-rose-500"><CheckIcon class="mx-auto h-6 w-6 text-rose-600" aria-hidden="true"/></div>
                            <div class="flex flex-grow flex-col text-black">Answer key can be obtained after the test.</div>
                        </li>
                        <li class="flex text-base leading-relaxed mb-3">
                            <div class="mr-4 flex text-rose-500"><CheckIcon class="mx-auto h-6 w-6 text-rose-600" aria-hidden="true"/></div>
                            <div class="flex flex-grow flex-col text-black">Closely aligned with the UPSC exam pattern.</div>
                        </li>
                        <li class="flex text-base leading-relaxed mb-3">
                            <div class="mr-4 flex text-rose-500"><CheckIcon class="mx-auto h-6 w-6 text-rose-600" aria-hidden="true"/></div>
                            <div class="flex flex-grow flex-col text-black">Complete coverage of the UPSC Prelims Syllabus.</div>
                        </li>
                    </ul>
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