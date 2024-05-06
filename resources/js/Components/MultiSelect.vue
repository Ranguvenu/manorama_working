<template>
    <div>
        <VueMultiselect @input="update" :disabled="disabled" :placeholder="placeholder" @select="update" v-model="selected" :label="label" :track-by="label" :multiple="multiple" :options="options" @remove="update">
            <template v-slot:noResult><span>No results found for your search</span></template>
        </VueMultiselect>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css';
export default{
    components:{
        VueMultiselect
    },
    props:{
        modelValue: {
            type: [Number, Array, String, Object],
            required: true
        },
        options: {
            type: Array,
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        },
        label:{
            type: String,
            required: false
        },
        returns: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Select Option'
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    data(){
        return{
            selected: this.generate_selected(this.modelValue),
        }
    },
    methods:{
        extract_value(selected){
            if(this.multiple){
                return selected.map(data => data[this.returns]);
            }else{
                return selected ? selected[this.returns] : 0;
            }
        },
        generate_selected(selected){
            let data = [];
            if(this.multiple){
                if(selected && (typeof selected == 'object' || typeof selected == 'array')){                    
                    selected.forEach((value, key) => {
                        let index = this.options.findIndex(data => data[this.returns] == value);
                        if(index > -1){
                            data.push(this.options[index]);
                        }
                    });
                }
                return data;
            }else{
                if(this.options){
                    let index = this.options.findIndex(data => data[this.returns] == selected);
                    return (index > -1) ? this.options[index] : [];
                }
            }
        },
        update(){
            let selected = this.extract_value(this.selected);
            this.$emit('update:modelValue', selected);
        }
    },
    watch: {
        modelValue: function(){
            this.selected = this.generate_selected(this.modelValue);
        }
    },
    mounted(){  
        
    }
}
</script>
