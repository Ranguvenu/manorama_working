<template>
    <div class="mt-4">
        <label class="flex items-center">
            <Checkbox name="isfeatured" v-model:checked="isfeatured" />
            <span class="ml-2 text-sm text-gray-600">Is Featured</span>
        </label>
    </div>
</template>
<script>
import Checkbox from '@/Components/Checkbox.vue';

export default{
    props:{
        value: {
            type: Object,
            required: true,
        }
    },
    components:{
        Checkbox
    },  
    data(){
        return{
            isfeatured: this.value,
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
        isfeatured(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted(){

    }
}
</script>
