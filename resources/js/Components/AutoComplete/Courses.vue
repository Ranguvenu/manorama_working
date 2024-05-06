<template>
    <div>
        <VueMultiselect @input="update" :limit="3" :disabled="disabled" :placeholder="placeholder" @select="update"
            v-model="selected" :label="label" :track-by="label" :multiple="multiple" :options="options" @remove="update"
            :loading="isloading" @search-change="search"></VueMultiselect>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css';
export default {
    components: {
        VueMultiselect
    },
    props: {
        modelValue: {
            type: [Number, Array, String, Object],
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        },
        data: {
            type: Array,
            required: true
        },
        label: {
            type: String,
            required: false
        },
        returns: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Type to search...'
        },
        disabled: {
            type: Boolean,
            default: false
        },
        depends: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            selected: this.generate_selected(this.modelValue),
            isloading: false,
            options: [],
        }
    },
    methods: {
        search(query = "") {
            let vm = this;
            vm.isloading = true;
            let payload = {
                search: query
            };
            axios.post(route('autocomplete.package.courses', {package: vm.depends}), payload).then((response) => {
                vm.options = response.data;
                vm.isloading = false;
            }).catch(error => {

            });
        },
        extract_value(selected) {
            if (this.multiple) {
                return selected.map(data => data[this.returns]);
            } else {
                return selected[this.returns];
            }
        },
        generate_selected(selected) {
            let data = [];
            if(this.options){
                if (this.multiple) {
                    if (selected && (typeof selected == 'object' || typeof selected == 'array')) {
                        selected.forEach((value, key) => {
                            let index = this.options.findIndex(data => data[this.returns] == value);
                            if (index > -1) {
                                data.push(this.options[index]);
                            }
                        });
                    }
                    return data;
                } else {
                    let index = this.options.findIndex(data => data[this.returns] == selected);
                    return this.options[index];
                }
            }
        },
        update() {
            let selected = this.extract_value(this.selected);
            this.$emit('update:modelValue', selected);
        }
    },
    watch: {
        modelValue: function () {
            this.selected = this.generate_selected(this.modelValue);
        },
        depends: function(){
            if(this.depends){
                this.search();
            }
        }
    },
    mounted() {
        this.options = this.data;
    }
}
</script>
