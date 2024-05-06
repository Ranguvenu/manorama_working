<template>
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="address">Address</label>
        <CkEditor v-model="address" />
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
            address: this.value,
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
        address(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted(){

    }
}
</script>
