<template>
    <div  class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="profileimage"><span>Profile Image</span></label>
        <MediaButton accepts="png,jpeg,jpg,svg,webp" class="mt-2" component="profileimage" name="Select Profile Image" :multiple="false" return_type="url" v-model="profileimage"/>
        <small class="text-gray-600">Note: Profile image should be in .png, .jpeg, .jpg, .svg or .webp format.</small>
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
            profileimage: '',
        }
    },
    methods:{

    },
    watch: {
        value:{
            inmediate: true,
            handler(value){
                this.profileimage = value;
            }
        },
        profileimage(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted(){
        if(this.value){
            this.profileimage = this.value;
        }
    }
}
</script>
