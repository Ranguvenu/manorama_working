<template>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-margins">Margins</label>
        </div>
        <div class="md:w-2/3">
            <div class="flex">
                <div>
                    <input v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm w-20" v-model="margins.value.top" type="number"/>
                    <div class="text-xs text-gray-600 mx-2 mt-1">Top</div>
                </div>
                <div>
                    <input v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm w-20" v-model="margins.value.right" type="number"/>
                    <div class="text-xs text-gray-600 mx-2 mt-1">Right</div>
                </div>
                <div>
                    <input v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm w-20" v-model="margins.value.bottom" type="number"/>
                    <div class="text-xs text-gray-600 mx-2 mt-1">Bottom</div>
                </div>
                <div>
                    <input v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm w-20" v-model="margins.value.left" type="number"/>
                    <div class="text-xs text-gray-600 mx-2 mt-1">Left</div>
                </div>
                <div>
                    <select v-on:change="update" class="text-gray-800 border-gray-300 focus:border-gray-400 focus:ring-gray-400 shadow-sm bg-gray-200" v-model="margins.unit">
                        <option value="px">px</option>
                        <option value="%">%</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            modelValue: {
                type: [Object],
                required: true
            },
        },
        data(){
            return{
                margins: {
                    value: {
                        top: 0,
                        right: 0,
                        bottom: 20,
                        left: 0,
                    },
                    unit: 'px' 
                }
            }
        },
        emits: ['update:modelValue'],
        methods: {
            update(){
                this.$emit('update:modelValue', this.margins);
            }
        },
        mounted(){
            this.margins = this.modelValue
        }   
    }
</script>