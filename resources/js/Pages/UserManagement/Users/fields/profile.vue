<template>
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="profile">Profile</label>
        <CkEditor v-model="profile" />
    </div>
</template>

<script>
import CkEditor from '@/Components/CkEditor.vue';
export default {
    props:{
        value: {
            type: Object,
            required: true,
        }
    },
    components:{
        CkEditor
    },  
    data() {
        return {
            profile: this.value,
            editor: CkEditor,
            editorConfig: {

            },
        };
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
        profile(value) {
            this.$emit("update:modelValue", value);
        },
    },
    mounted() {

    }
};
</script>
