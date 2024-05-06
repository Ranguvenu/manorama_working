<template>
    <ckeditor class="text-gray-700" :editor="editor" v-model="text" :config="editorConfig"></ckeditor>
</template>

<script>
// import CKEditor from '@ckeditor/ckeditor5-vue';
//import Editor from 'ckeditor5-custom-build/src/ckeditor.ts';
// import Editor from 'ckeditor5-custom-build';
// import Editor from './ckeditor.ts';
import Editor from "@ckeditor/ckeditor5-build-classic";
// import Editor from "@/libraries/ckeditor5-custom-build/src/ckeditor";
// import MathType from '@wiris/mathtype-ckeditor5';

// import ClasicEditor from '@ckeditor/ckeditor5-editor-classic';
// import { Essentials } from '@ckeditor/ckeditor5-essentials';
// import { Bold, Italic } from '@ckeditor/ckeditor5-basic-styles';
// import { Link } from '@ckeditor/ckeditor5-link';
// import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
export default {
    props: {
        value: {},
    },
    // components:{
    //     ckeditor:CKEditor.component
    // },
    data() {
        return {
            text: "",
            editor: Editor,
            editorConfig: {
               
    
            },
        };
    },
    watch: {
        value:{
            inmediate: true,
            handler(value){
                this.text = value;
            }
        },
        text(text) {
            this.$emit("input", text);
        },
    },
};
</script>
