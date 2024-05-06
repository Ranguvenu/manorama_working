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
        <div class="max-w-screen-2xl mx-auto px-16 pt-12 pb-12">
            <div class="flex flex-col justify-center py-12">
                <div class="mb-4"><img class="mx-auto" src="/images/404.png" alt="Couldn't Find this page" /></div>
                <div class="flex justify-center text-black text-[25px] font-semibold mb-4">Oops! Couldn't find this page</div>
                <div class="flex justify-center text-black text-base mb-4">Let's get you back on track</div>
                <div class="text-blue-800 text-md font-medium flex justify-center mb-6"><a href="#">Home page <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
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