<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Content Type</label>
        </div>
        <div class="md:w-2/3">
            <select v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm" v-model="type">
                <option value="container">In Container</option>
                <option value="fwbg">Full Width Background</option>
                <option value="fwcontent">Full Width Content</option>
            </select>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            modelValue: {
                type: [Object, String],
                required: true
            },
        },
        data(){
            return{
                type: 'container'
            }
        },
        emits: ['update:modelValue'],
        methods: {
            update(){
                this.$emit('update:modelValue', this.type);
            }
        },
        mounted(){
            this.type = this.modelValue
        }
    }
</script>