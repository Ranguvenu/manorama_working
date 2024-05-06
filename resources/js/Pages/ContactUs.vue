<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';

    export default{
    components:{
        MagnifyingGlassIcon,
        InputError,
        InputLabel,
        TextInput,
        TextArea
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
    <Head title="Contact Us" />
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
        <div class="max-w-screen-2xl mx-auto px-16 pt-4 pb-12 border-b border-stone-300 bg-gradient-to-r from-white via-pink-50 to-white">
            <ul class="flex nav_list mb-8">
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm">Home</a>
                </li>
                <li class="flex items-center mr-2 nav_listitem">
                    <a href="#" class="text-sm active">Contact us</a>
                </li>
            </ul>

            <div class="flex justify-between">
                <div class="flex flex-col sm:w-1/2 pr-[95px]">
                    <div><span class="text-black text-[55px] font-semibold">Let’s </span><span class="text-rose-500 text-[55px] font-semibold">Talk</span></div>
                    <div class="text-black text-lg font-semibold mb-3">We’d love to hear from you</div>
                    <div class="text-gray-600 text-base mb-6">Have some big idea or brand to develop and need help? Then reach out we'd love to hear about your project  and provide help</div>
                    <div class="my-6">
                        <div class="text-zinc-800 text-base font-semibold leading-[27px] mb-1">Student helpline</div>
                        <div class="text-gray-600 text-base">support@manoramahorizon.com</div>
                    </div>
                    <div class="my-6">
                        <div class="text-zinc-800 text-base font-semibold mb-1">Phone</div>
                        <div class="text-gray-600 text-base font-normal">+91 9945 344 343</div>
                    </div>
                    <div class="mb-8">
                        <div class="text-zinc-800 text-base font-semibold mb-1">Office address</div>
                        <div class="text-gray-600 text-base">Manorama Junction, Kottayam - <br/>Kumily Rd, Kottayam, Kerala 686001</div>
                    </div>
                    <div class="mb-8">
                        <div class="text-neutral-900 text-base mb-4">Follow us on</div>
                        <div class="flex">
                            <div class="mr-3"><img  src="/images/socialicon/facebook.png" alt="Facebook" /></div>
                            <div class="mr-3"><img  src="/images/socialicon/instagram.png" alt="Instagram" /></div>
                            <div class="mr-3"><img  src="/images/socialicon/youtube.png" alt="YouTube" /></div>
                            <div class="mr-3"><img  src="/images/socialicon/linkedin.png" alt="LinkedIn" /></div>
                            <div class="mr-3"><img  src="/images/socialicon/pinterest.png" alt="Pinterest" /></div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:w-1/2 mt-2">
                    <div class="max-w-[563px]">
                        <div class="text-black text-[22px] font-semibold mb-4">Write To Us</div>
                        <div class="text-black text-base font-medium mb-4">You will typically hear from us within 24 hours</div>
                        <div class="mb-3">
                            <InputLabel for="name" class="text-zinc-950 text-sm font-medium">Name</InputLabel>
                            <TextInput
                                id="name"
                                type="text"
                                class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                                required
                                autofocus
                                autocomplete="name"
                                />
                            <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                        </div>
                        <div class="mb-3">
                            <InputLabel for="email" class="text-zinc-950 text-sm font-medium">Email</InputLabel>
                            <TextInput
                                id="email"
                                type="text"
                                class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                                required
                                autofocus
                                autocomplete="email"
                                />
                            <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
                        </div>
                        <div class="mb-3">
                            <InputLabel for="phnumber" class="text-zinc-950 text-sm font-medium">Phone Number</InputLabel>
                            <TextInput
                                id="phnumber"
                                type="text"
                                class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                                required
                                autofocus
                                autocomplete="phnumber"
                                />
                            <InputError class="mt-2" v-if="errors && errors.phnumber" :message="errors.phnumber[0]" />
                        </div>
                        <div class="mb-3">
                            <InputLabel for="message" class="text-zinc-950 text-sm font-medium">Message</InputLabel>
                            <TextArea
                                id="message"
                                type="text"
                                class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2 min-h-[150px]"
                                required
                                autofocus
                                autocomplete="message"
                                />
                            <InputError class="mt-2" v-if="errors && errors.message" :message="errors.message[0]" />
                        </div>
                        <div class="w-full px-[246px] py-[13px] bg-rose-600 rounded-[9px] justify-start items-start gap-2.5 inline-flex"><a class="text-white text-xl font-medium" size="sm:m-0 h-[47px]">Submit</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-2xl mx-auto w-full px-16 py-3 h-[250px]">
    </div>
</template>