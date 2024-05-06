<template>
    <div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Background Type</label>
            </div>
            <div class="md:w-2/3">
                <select v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm" v-model="background.type">
                    <option value="color">Color</option>
                    <option value="image">Image</option>
                    <option value="gradient">Gradient</option>
                    <option value="theme">Theme</option>
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6" v-if="background.type == 'color'">
            <div class="md:w-1/3">
                <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Background Color</label>
            </div>
            <div class="md:w-2/3">
                <color-picker class="h-10 w-20" v-model:pureColor="background.value" useType="pure"/>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6" v-if="background.type == 'image'">
            <div class="md:w-1/3">
                <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Background Image</label>
            </div>
            <div class="md:w-2/3">
                <MediaButton class="mt-2" component="website" name="Select Background Image" :multiple="false" return_type="url" v-model="background.value"/>
            </div>
        </div>
        <div v-if="background.type == 'gradient'">
            <div class="md:flex md:items-center mb-6" >
                <div class="md:w-1/3">
                    <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Gradient</label>
                </div>
                <div class="md:w-2/3">
                    <color-picker class="h-10 w-20" v-model:gradientColor="background.gradient" lang="En" useType="gradient"/>
                </div>
            </div>
        </div>
        <div v-if="background.type == 'theme'">
            <div class="md:flex md:items-center mb-6" >
                <div class="md:w-1/3">
                    <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-paddings">Predefined  Backgrounds</label>
                </div>
                <div class="md:w-2/3">
                    <select v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm" v-model="background.class">
                        <option value="bg_gray_to_pink">Gray to Pink</option>
                        <option value="bg_pink_to_gray">Pink to Gray</option>
                        <option value="bg_radial_white_pink">Radial White Pink</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import MediaButton from '@/Components/MediaButton.vue';
    export default{
        props:{
            modelValue: {
                type: [Object],
                required: true
            },
        },
        components:{
            MediaButton,
        },
        data(){
            return{
                background: {
                    type: 'color',
                    value: '',
                    gradient: '',
                    class: ''
                }
            }
        },
        emits: ['update:modelValue'],
        methods: {
            update(){
                this.$emit('update:modelValue', this.background);
            }
        },
        watch: {
            "background.type": function(){
                this.$emit('update:modelValue', this.background);
            },
            "background.value": function(){
                this.$emit('update:modelValue', this.background);
            }
        },
        mounted(){
            this.background = this.modelValue
        }
    }
</script>
