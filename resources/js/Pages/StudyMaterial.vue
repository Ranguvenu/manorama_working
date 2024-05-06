<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";

    export default{
    components:{
        MagnifyingGlassIcon,
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
    <Head title="Study Material" />
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
        <div class="max-w-screen-2xl mx-auto px-16 pt-4 bg_radial_white_pink">
             <ul class="flex nav_list flex-wrap mb-4">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Study Material</a>
                </li>
            </ul>
            <div class="w-full my-8">
                <div class="flex justify-center text-black text-[26px] font-semibold leading-[35px] my-6">Study Materials</div>
                <!--<div class="w-[603px] h-12 bg-white rounded-[7px] shadow">
                    <div class="w-[19px] h-[19px] relative"></div>
                    <div class="text-gray-600 text-base font-normal font-['Poppins'] leading-[35px]">Search article</div>
                </div>-->
                <div class="flex flex-row flex-wrap mt-6 mb-12">
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="goals" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Goal</label>
                        <select id="goals" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                            <option selected>Select</option>
                            <option value="1">Goal1</option>
                            <option value="2">Goal2</option>
                            <option value="3">Goal3</option>
                            <option value="4">Goal4</option>
                        </select>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="boards" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Board</label>
                        <select id="boards" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                            <option selected>Select</option>
                            <option value="1">Board1</option>
                            <option value="2">Board2</option>
                            <option value="3">Board3</option>
                            <option value="4">Board4</option>
                        </select>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="classes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Class</label>
                        <select id="classes" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                            <option selected>Select</option>
                            <option value="1">Class1</option>
                            <option value="2">Class2</option>
                            <option value="3">Class3</option>
                            <option value="4">Class4</option>
                        </select>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="subjects" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Subject</label>
                        <select id="subjects" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                            <option selected>Select</option>
                            <option value="1">Subject1</option>
                            <option value="2">Subject2</option>
                            <option value="3">Subject3</option>
                            <option value="4">Subject4</option>
                        </select>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Chapter</label>
                        <select id="chapters" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5">
                            <option selected>Select</option>
                            <option value="1">Chapter1</option>
                            <option value="2">Chapter2</option>
                            <option value="3">Chapter3</option>
                            <option value="4">Chapter4</option>
                        </select>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <label for="search_topics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search Topic</label>
                        <input id="search_topics" class="bg-white rounded-[5px] border border-stone-300 text-sm block w-full p-2.5" placeholder="Search">
                    </div>
                    <button type="submit" class="inline-flex items-center self-end py-2.5 px-[18px] mb-4 text-sm font-medium text-white bg-rose-600 rounded-[5px] hover:bg-rose-700">Search</button>
                </div>
                <div class="flex flex-row flex-wrap">
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <!-- <div class="w-[317px] h-[100px] bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100"></div> -->

                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-1/4 pr-4 mb-4">
                        <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                            <div class="relative"><img class="rounded-tl-lg rounded-tr-lg w-full" src="/images/article/article1.png" alt="Kingdom Animalia Invertebrate" />
                                <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]"><span class="text-white text-xs">CBSE > Class IX</span></div>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                                <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">Kingdom Animalia Invertebrate</div>
                                <div class="text-gray-600 text-xs"> September 14, 2023</div>
                            </div>
                        </div>
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
    </div>
    <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 bg-neutral-100 h-[250px]">
    </div>
</template>
