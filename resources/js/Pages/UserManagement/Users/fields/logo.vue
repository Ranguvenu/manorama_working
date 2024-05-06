<template>
    <div  class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="category"><span>Logo</span></label>
        <MediaButton class="mt-2" component="image" name="Choose file" :multiple="false" return_type="url" v-model="image"/>
    </div>
</template>
<script>
import MediaButton from '@/Components/MediaButton.vue';

export default{
    props:{
        value: {
            type: Object,
            required: true,
        }
    },
    components:{
        MediaButton
    },
    data(){
        return{
            image: '',
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
        image(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted(){
        if(this.value){
            this.image = this.value;
        }
    }
}
</script>
