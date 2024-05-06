<template>
    <div v-if="data && data.id">
        <div class="text-sm font-semibold">ATTACHMENT DETAILS</div>
        <div class="flex my-2">
            <div>
                <img v-if="data.media_type == 'images'" :src="data.url" width="150"/>
            </div>
            <div class="ms-2">
                <div class="text-sm font-semibold text-slate-700">{{ data.title }}.{{ data.extension }}</div>
                <div class="text-sm mt-1">{{ data.date_created }}</div>
                <div class="text-sm mt-1 mb-2">{{ data.size }}</div>
                <a href="javascript:void(0)" v-on:click="destroy(data.id)" class="text-sm cursor-pointer text-red-600">Delete Permanently</a>
            </div>
        </div>
        <div class="border-b-2"></div>
        <div class="max-h-60 overflow-y-auto">
            <div class="mt-3">
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    autofocus
                    autocomplete="title"
                />
            </div>

            <div class="mt-3">
                <InputLabel for="alttext" value="Alt Text" />
                <TextArea
                    id="alttext"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.alttext"
                    autofocus
                    autocomplete="title"
                />
            </div>
            <div class="mt-3">
                <InputLabel for="caption" value="Caption" />
                <TextArea
                    id="caption"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.caption"
                    autofocus
                    autocomplete="caption"
                />
            </div>
            <div class="mt-3">
                <InputLabel for="description" value="Description" />
                <TextArea
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    autofocus
                    autocomplete="description"
                />
            </div>
            <div class="mt-3">
                <InputLabel for="fileurl" value="File URL" />
                <TextInput
                    id="fileurl"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="data.fileurl"
                    autofocus
                    autocomplete="fileurl"
                    :disabled="true"
                />
            </div>
        </div>
        <div class="mt-3 mb-2 text-right">
            <a href="javascript:void(0)" v-on:click="update" class=" text-sm cursor-pointer text-secondary border border-secondary py-1 px-3 rounded">Update</a>
        </div>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';

export default{
    components:{
        InputLabel,
        TextInput,
        TextArea
    }, 
    props:{
        data: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            form: this.initialize()
        }
    },
    methods:{
        destroy(id){
            let vm = this;
            axios.delete('/media/'+id+'/destroy').then(response => {
                if(response.data.success){
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }else{
                    this.$toast.error(response.data.message, {
                        position: 'bottom-right'
                    });
                }
                vm.$emit('refresh');
            }).catch(error =>{

            });
        },
        initialize(){
            return {
                title: this.data.title ? this.data.title : '',
                alttext: this.data.alttext ? this.data.alttext : '',
                caption: this.data.caption ? this.data.caption : '',
                description: this.data.description ? this.data.description : '',
                fileurl: this.data.fileurl
            }
        }, 
        update(){
            let vm = this;
            axios.put('/media/'+vm.data.id+'/update', vm.form).then(response => {
                if(response.data.success){
                    
                }
            }).catch(error => {

            });
        }
    },
    watch:{
        data: function(){
            this.form = this.initialize();
        }
    },
    mounted(){
        
    }
}
</script>
