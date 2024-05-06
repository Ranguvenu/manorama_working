<template>
    <div>
        <div class="border border-gray-300 px-2 py-2 flex justify-between items-center mb-3">
            <div class="text-sm text-gray-700">
                <span v-if="value.length" class="mx-2" v-for="(media, index) in selected_items(value)">{{ media.title }}.{{ media.extension }}</span>
                <span v-else class="mx-2">No File Selected</span>
            </div>
            <div class="flex">
                <button class="border border-secondary px-3 text-secondary py-1 text-sm font-normal me-2" v-on:click="remove" v-if="value && value.length">Remove</button>
                <button class="border border-primary px-3 text-primary py-1 text-sm font-normal" v-on:click="open">{{ name }}</button>
            </div>
        </div>
        <MediaModal :accepts="accepts" :show="show" :multiple="multiple" :component="component" :items="value" @hide="show = false" @insert-media="insert_media" @file-uploaded="uploaded"/>
    </div>
</template>
<script>
import MediaModal from '@/Modules/MediaManager/index.vue';
export default{
    components:{
        MediaModal
    },
    props:{
        modelValue:{
            type: [Number, String, Array],
            required: false
        },
        component: {
            type: String,
            required: true
        },
        name: {
            type: String,
            default: 'Add Media'
        },
        multiple:{
            type: [Boolean, Number],
            default: 1
        },
        return_type: {
            type: String,
            default: 'id'
        },
        accepts: {
            type: String,
            required: false
        }
    },
    data(){
        return{
            show: false,
            value: []
        }
    },
    methods:{
        open(e){
            e.preventDefault();
            this.show = true
        },
        insert_media(media){
            this.value = media;
            this.show = false;
            this.$emit('update:modelValue', this.extract_data());
        },
        extract_data(){
            let data = [];
            if(this.multiple){
                return this.value.map(a => a[this.return_type]);
            }
            return (this.value && this.value.length) ? this.value[0][this.return_type] : 0;
        },
        uploaded(media){
            if(!this.multiple){
                this.value = [];
            }
            this.value.push(media);
        },
        edit(ids){
            let vm = this;
            let payload = {};
            payload['ids'] = ids;
            payload['return_type'] = vm.return_type;
            axios.post(route('media.edit'), payload).then(response => {
                if(response && response.data && response.data.data){
                    vm.value.push(response.data.data);
                }
            }).catch(error => {

            });
        },
        remove(){
            this.value = [];
            this.$emit('update:modelValue', this.extract_data());
        },
        selected_items(value) {
            return Object.values(
                value.reduce((accumulator, element) => {
                    accumulator[element.id] = element;
                    return accumulator;
                }, {})
            );
        }
    },
    watch: {
        value() {
            this.$emit('update:modelValue', this.extract_data());
        },
        modelValue(){
            this.edit(this.modelValue);
        }
    },
    mounted(){
        if(this.modelValue){
            this.edit(this.modelValue);
        }
    }
}
</script>
