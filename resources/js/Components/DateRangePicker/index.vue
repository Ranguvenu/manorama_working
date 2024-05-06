<template>
    <div class="flex">
        <input type="date" v-model="date.start" class="w-full text-gray-700 border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm">
        <input type="date" :min="date.start" v-model="date.end" class="w-full mx-2 text-gray-700 border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm">
    </div>
</template>
<script>
export default{
    props:{
        modelValue:{
            type: [Object],
            required: false
        }
    },
    data(){
        return {
            date: {
                start: '',
                end: ''
            }
        }
    },
    methods:{

    },
    watch: {
        "date.start": function(){
            this.date.end = '';
            this.$emit('update:modelValue', this.date);
        },
        "date.end": function(){
            this.$emit('update:modelValue', this.date);
        },
        modelValue: function(){
            this.date = this.modelValue;
        }
    },
    mounted(){
        this.date = this.modelValue;
    }
}
</script>
