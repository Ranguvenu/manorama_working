<template>
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="biography">Biography</label>
        <CkEditor v-model="biography" />
    </div>
</template>

<script>
import CkEditor from '@/Components/CkEditor.vue';

export default{
    props:{
        value: {
            type: Object,
            required: true,
        }
    },
    components:{
        CkEditor
    },
    data(){
        return{
            biography: this.value,
        }
    },
    methods:{

    },
    watch: {
        value:{
            inmediate: true,
            handler(value){
                this.data = value;
            }
        },
        biography(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted(){

    }
}
</script>
