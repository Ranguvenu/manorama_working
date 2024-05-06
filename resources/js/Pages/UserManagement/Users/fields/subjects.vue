<template>
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="subjects"><span>Available Subjects</span></label>
        <label v-for="x in subjects" :key="x.id">
            <input @change="update" type="checkbox" v-model="checkedValues[x.id]" :value="x.id" :checked="x.selected">{{ x.name }}
        </label>
    </div>
</template>
<script>
import axios from 'axios';

export default{
    props:{
        value: {
            type: [String, Number],
            required: true,
        },
        userid: {
            type: [String, Number],
        }
    },
    data(){
        return{
            subjects: [],
            checkedValues: [],
        }
    },
    methods:{
        get_subjects(){
            let vm = this;
            axios.post('/usermanagement/internalstaff/get_categories?staffid='+this.userid+'&metatype=subjects').then(response => {
                vm.subjects = response.data.data;
            }).catch(error => {console.log("response");

            });
        },
        update(){
            console.log(this.checkedValues);
            this.$emit("update:modelValue", this.checkedValues);
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
        this.get_subjects();
    }
}
</script>