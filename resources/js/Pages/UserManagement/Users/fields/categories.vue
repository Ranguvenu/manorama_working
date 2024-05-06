<template>
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="categories"><span>Available Categories</span></label>
        <div class="grid grid-cols-4 gap-1 mt-2 border border-gray-200 p-3">
            <div class="col-span-1" v-for="option in options" :key="option.id">
                <label class="flex items-center py-1">
                    <input type="checkbox" :value="option.id" @change="toggleCheckbox($event)" :checked="ischecked(option.id)" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                    <span class="ml-2 text-sm text-gray-600">{{ option.name }}</span>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{ 
        options: {
            type: [Object, Array],
            required: false,
        },
        modelValue: {
            type: Array,
            required: true
        }
    },
    data(){
        return{
            selected: [],
            checkedValues: [],
        }
    },
    methods:{
        toggleCheckbox(event){
            console.log(this.selected);
            const { value, checked } = event.target;
			checked ? this.selected.push(parseInt(value)) : ((this.selected.indexOf(parseInt(value)) > -1) ? this.selected.splice(this.selected.indexOf(parseInt(value)), 1) : 0);
            this.$emit('update:modelValue', this.selected);
        },
        ischecked(source){
            return (this.selected && this.selected.indexOf(source) > -1) ? true : false;
        }
    },
    watch: {
        value:{
            inmediate: true,
            handler(value){
                this.data = value;
            }
        },
    },
    mounted(){
        this.selected = this.modelValue;
        console.log("selected", this.selected);
    }
}
</script>
