<template>
    <color-picker v-model="color" v-model:pureColor="pureColor" v-model:gradientColor="gradientColor"/>
</template>

<script>
import { ColorPicker } from "vue3-colorpicker";
import "vue3-colorpicker/style.css";

export default {
    components:{
        ColorPicker
    },
    props: {
        value: {},
    },
    data() {
        return {
            pureColor: "",
            gradientColor: "",
            color: ""
        };
    },
    watch: {
        value:{
            inmediate: true,
            handler(value){
                this.color = value;
            }
        },
        color(color) {
            console.log(color);
            this.$emit("input", color);
        },
    },
};
</script>