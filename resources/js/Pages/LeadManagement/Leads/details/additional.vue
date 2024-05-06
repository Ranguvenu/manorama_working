<template>
    <div class="w-full max-w-3xxl text-sm">
        <table class="min-w-full bg-white border-0" v-if="lead && lead.meta">
            <tr v-for="(meta, index) in lead.meta">
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">{{ get_key_name(index) }}</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ meta }}</td>
            </tr>
        </table>
        <div v-else>
            <div class="text-gray-600 p-3 text-center">No Additional Information is associated with this lead</div>
        </div>
    </div>
</template>
<script>
export default{
    components:{

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
        get_key_name(key){
            return key.replace("addl_", "");
        }
    },
    mounted(){

    }
}
</script>
