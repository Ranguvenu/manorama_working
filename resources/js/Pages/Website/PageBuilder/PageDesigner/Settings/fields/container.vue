<template>
    <div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-margins">Container Id</label>
            </div>
            <div class="md:w-2/3">
                <TextInput type="text" class="mt-1 block w-full" v-model="container.id"
                        placeholder="Container Id" autofocus/>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-800 md:text-left mb-1 md:mb-0 pr-4" for="inline-margins">Container Class</label>
            </div>
            <div class="md:w-2/3">
                <TextInput type="text" class="mt-1 block w-full" v-model="container.class"
                        placeholder="Container Class" autofocus/>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    export default{
        props:{
            modelValue: {
                type: [Object],
                required: true
            },
        },
        components:{
            TextInput
        },
        data(){
            return{
                container: {
                    id: '',
                    class: '' 
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
            this.container = this.modelValue
        }   
    }
</script>