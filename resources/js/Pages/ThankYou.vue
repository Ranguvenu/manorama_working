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
    <div class="content-wrap mt-[90px] bg_radial_white_pink">
        <div class="sm:max-w-6xl max-w-screen-2xl mx-auto w-full px-16 py-12 bg_radial_white_pink">
            <div class="flex flex-col justify-center items-center">
                <div class="mx-auto mb-4"><img src="/images/check-success.png" alt="Successfull"/></div>
                <div class="text-center text-zinc-800 text-[29px] font-semibold leading-[35px] mb-6">Congratulations on Your Successful Package Purchase!</div>
                <div class="text-center text-black text-base leading-relaxed mb-6">High five! Your purchase of the package has been successful, and we're thrilled to have you onboard! Get ready for an exciting journey filled with endless possibilities and enriching experiences.</div>
                <div class="sm:max-w-6xl mx-auto w-full">
                    <div class="w-full bg-white rounded border-b-4 border-neutral-200 px-4 pt-6 pb-3">
                        <div class="text-black text-base font-semibold">Package Details</div>
                        <div class="flex flex-wrap flex-row bg-gray-100 rounded-md px-6 py-8">
                            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                                <div class="text-gray-600 text-sm mb-1">Course</div>
                                <div class="text-black text-sm font-medium">Class 8 CBSE</div>
                            </div>
                            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                                <div class="text-gray-600 text-sm mb-1">Subjects</div>
                                <div class="text-black text-sm font-medium">Physcis, Chemistry, Mathematics</div>
                            </div>
                            <div class="sm:w-1/3 w-full flex flex-col mb-3">
                                <div class="text-gray-600 text-sm mb-1">Course</div>
                                <div class="text-black text-sm font-medium">Class 8 CBSE</div>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-gray-200">
                            <div class="text-black text-base font-semibold mb-2 mt-3">Payment Details</div>
                            <div class="flex flex-wrap flex-row rounded-md">
                                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                                    <div class="text-gray-600 text-sm mb-1">Payment Status</div>
                                    <div class="text-green-600 text-sm font-medium">Success</div>
                                </div>
                                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                                    <div class="text-gray-600 text-sm mb-1">Transaction ID</div>
                                    <div class="text-black text-sm font-medium">Class 8 CBSE</div>
                                </div>
                                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                                    <div class="text-gray-600 text-sm mb-1">Transaction Date and Time</div>
                                    <div class="text-black text-sm font-medium">July 25, 2023, 04:00 PM</div>
                                </div>
                                <div class="sm:w-1/3 w-full flex flex-col mb-6">
                                    <div class="text-gray-600 text-sm mb-1">Total Amount</div>
                                    <div class="text-black text-sm font-medium">₹5500</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 flex justify-end">
                        <a href="#" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Proceed</a>
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