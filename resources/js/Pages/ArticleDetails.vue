<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
    import { ChevronRightIcon } from "@heroicons/vue/24/solid";

    export default{
    components:{
        MagnifyingGlassIcon,
        ChevronRightIcon
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
    <Head title="Article Details" />
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
        <div class="max-w-screen-2xl mx-auto animation px-4 md:px-16 py-8">
           <div class="flex flex-col">
                <ul class="flex nav_list flex-wrap mb-4">
                    <li class="flex items-center mr-2 nav_listitem">
                        <a href="#" class="text-sm">Home</a>
                    </li>
                    <li class="flex items-center mr-2 nav_listitem">
                        <a href="#" class="text-sm">Article</a>
                    </li>

                    <li class="flex items-center mr-2 nav_listitem">
                        <a href="#" class="text-sm active">Animation</a>
                    </li>
                </ul>
                <div class="text-zinc-100 text-sm font-normal mb-3">Higher Education</div>
                <div class="text-white text-4xl font-semibold mb-6">What is Animation? What are its <br />subjects and career scope?</div>
                <div class="text-white text-base font-medium">
                    <p>By Sumalata M</p>
                    <p>Updated on: Sep 12, 2023 |</p>
                    </div>
           </div>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full md:px-16 px-4 py-6">
            <div class="flex flex-wrap justify-between ">
                <div class="flex flex-col w-full md:pr-4 md:w-3/5 lg:w-3/4">
                    <div class="mb-6">
                        <div class="text-black text-[23px] font-semibold mb-2">What is Animation?</div>
                        <div class="text-black text-base font-normal leading-relaxed">
                            <p class="mb-3">Animation is the process of forming an illusion of sequential movement through a series of images or frames. It includes combining numerous methods, such as drawing, modelling, or altering digital imagery, to bring static objects or characters to life. There are various types of animation techniques used in different formats created using different tools.</p>

                            <p class="mb-3">Traditional Animation: Traditional Animation was produced by photographing and projecting hand-drawn or painted pictures on celluloid sheets. Although it is occasionally still utilised, digital animation techniques have mostly taken the place of this traditional or cel animation approach.</p>

                            <p class="mb-3">Digital Animation: Digital Animation uses computer software and tools to produce and edit images and form animations. It includes a wide variety of techniques, such as stop-motion animation, computer-generated imagery (CGI), 2D animation, and 3D animation. Each method has its own special features and benefits.</p>

                            <p class="mb-3">2D Animation: The process of 2D animation involves generating movement in a two-dimensional environment. Both conventional hand-drawn techniques and digital tools can be used to create and alter characters and backgrounds.<br/>3D Animation: On the other hand, 3D animation involves producing digital representations of three-dimensional settings and objects. It frequently involves utilising specialist software to model things, define their properties, and animate them. This method is frequently applied to visual effects, video games, and motion pictures.</p>
                        </div>
                    </div>
                    <div>
                        <div class="text-black text-[23px] font-semibold mb-2">What are the Subjects in Animation?</div>
                        <div  class="text-black text-base font-normal leading-relaxed">
                            <p class="mb-3">The students of the Animation and Game Art programme learn basic animation principles, cell animation, digital animation, and visual effects. Students are also taught animation filmmaking both in traditional and digital formats. The coursework trains its students to produce Instructional Design outputs. Our BVA/ B. Design in Animation & Game Art degree programme imparts skills in Visual Effects that can be applied to live-action film production as well. The course provides knowledge of industry terminologies and theoretical concepts of producing animation. All these subjects are coupled with teaching the latest software and tools used in the industry for animation and related productions. The B Design/BVA programme in animation is created to give students a thorough understanding of storytelling, animation, and design concepts. These are some of the subjects studied in the animation course:</p>

                            <p class="mb-3">Animation Foundation: Introduction to the building blocks of animation, including time, space, squash and stretch, and other concepts.<br/>2D Animation: 2D animation is taught using both traditional hand-drawn animation methods and computer animation techniques and technologies.<br/>3D Animation: Training in the basics of 3D modelling, rigging, and animating 3D objects using various software tools are part of the syllabus.<br/>Drawing and Storyboarding: Development of foundational drawing skills and techniques for creating storyboards, which are essential for planning animated sequences.<br/>Digital Animation Tools: Learning how to use industry-standard animation software and tools is part of the degree programme.<br/>Character Design: Creating and developing characters with a focus on their visual appeal and functionality in animation.<br/>Animation Production Stages: Understanding the various stages involved in animation production, from concept to final rendering.<br/>Motion Graphics: Exploring animation for title sequences, advertisements, and other graphic design applications.</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-2/5 lg:w-1/4 md:pl-4">
                    <div class="bg-white rounded-[10px] shadow py-6 px-4 mb-4">
                        <div class="text-black text-base font-semibold mb-4">Certification Courses </div>
                        <div class="flex py-4 px-3 bg-gradient-to-l flex-wrap from-red-200 via-fuchsia-200 to-indigo-50 justify-between rounded-[10px] items-center">
                            <div class="flex flex-col w-[150px]">
                                <div class="text-black text-[18px] font-semibold leading-[20px] mb-1">BUILDING AI PRODUCTUS</div>
                                <div class="text-black text-[11px] font-medium mb-2">
                                    For Aspiring AI PMs
                                </div>
                                <div class="flex mb-1">
                                    <img class="w-[26px] h-[25px] mr-4" src="/images/article/google.png" />
                                    <img class="w-[26px] h-[25px]" src="/images/article/metaverse.png" />
                                </div>
                            </div>
                            <div class="flex flex-col items-center justify-center flex-shrink-0">
                                <div class="text-center"><img class="w-[100px] h-[100px] mr-4" src="/images/article/cc_ai_profile.png" /></div>
                                <div class="text-black text-xs font-medium mb-2">
                                    By Alex
                                </div>
                            </div>
                        </div>

                        <div class="text-blue-800 text-sm font-medium flex my-4"><a href="#">View All Courses <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
                        <div class="flex flex-col border-t border-zinc-100">
                            <div class="text-black text-base font-semibold pt-5">Competitive exam</div>
                            <div class="py-4">
                                <div class="flex items-center justify-between bg-rose-50 rounded-[10px] border border-rose-500 px-3 py-3 mb-2 compexam_toggle_wrap">
                                    <div class="text-red-950 text-sm font-medium  leading-[19px]">Civil Services Foundation<br/>Course</div>
                                    <div><ChevronRightIcon class="h-4 w-3 text-gray-1000 font-semibold" aria-hidden="true"/></div>
                                </div>
                                <div class="flex items-center justify-between bg-rose-50 rounded-[10px] border border-rose-500 px-3 py-3 mb-2 compexam_toggle_wrap">
                                    <div class="text-red-950 text-sm font-medium  leading-[19px]">Civil Services Prelims <br/>cum Mains Online Program</div>
                                    <div><ChevronRightIcon class="h-4 w-3 text-gray-1000 font-semibold" aria-hidden="true"/></div>
                                </div>
                                <div class="flex items-center justify-between bg-rose-50 rounded-[10px] border border-rose-500 px-3 py-3 mb-2 compexam_toggle_wrap">
                                    <div class="text-red-950 text-sm font-medium  leading-[19px]">LDC & LGS</div>
                                    <div><ChevronRightIcon class="h-4 w-3 text-gray-1000 font-semibold" aria-hidden="true"/></div>
                                </div>
                                <div class="flex items-center justify-between bg-rose-50 rounded-[10px] border border-rose-500 px-3 py-3 compexam_toggle_wrap">
                                    <div class="text-red-950 text-sm font-medium  leading-[19px]">UP/LP Assistant</div>
                                    <div><ChevronRightIcon class="h-4 w-3 text-gray-1000 font-semibold" aria-hidden="true"/></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-blue-800 text-sm font-medium flex"><a href="#">View All Courses <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>
                    </div>
                    <div class="flex flex-col bg-white rounded-[10px] shadow mb-4 px-3 py-4">
                        <div class="text-black text-base font-semibold mb-3">About Author</div>
                        <div class="w-[75px] h-[75px] mb-2"><img class="inline-block rounded-full" src="/images/article/authorimg.png" /></div>
                        <div class="text-black text-sm font-medium mb-4">Sumalata M Content Writer,</div>
                        <div class="text-gray-600 text-xs">Acharya Institutes Sumalata works as a writer for Public Relations and Digital Marketing Department. She indulges in poetry and other creative writing in her free time.</div>
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
