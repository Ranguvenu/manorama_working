<template>
    <div>
        <div class="flex">
            <img src="/images/profile/profile.png" alt="Profile Picture of {{ lead.name }}" class="rounded-md object-contain h-32 w-32 ">
            <div class="py-3 px-5">             
                <span class="inline-flex items-center mb-3 font-medium text-gray-900"> 
                    <span>{{ lead.name }}</span>
                    <!--<PencilSquareIcon  class="h-5 w-5 mx-3 text-gray-1000 cursor-pointer" aria-hidden="true"/> -->      
                </span>
                <span class="flex items-center mb-3 font-medium text-gray-900">
                    <PhoneIcon class="h-4 w-4 text-gray-500 mr-3"/>
                    <span>{{ lead.phone }}</span>
                </span>
                <span class="flex items-center mb-3 font-medium text-gray-900">
                    <EnvelopeIcon class="h-4 w-4 text-gray-500 mr-3"/>
                    <span>{{ lead.email }}</span>
                </span>                       
            </div> 
        </div>
    </div>
</template>
<script>
import{ PhoneIcon, EnvelopeIcon, PencilSquareIcon }from '@heroicons/vue/24/outline';
export default{
    components:{
        PhoneIcon,
        EnvelopeIcon,
        PencilSquareIcon
    },
    props:{
        lead: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>