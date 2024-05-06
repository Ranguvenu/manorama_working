<template>
    <div class="p-3">
        <div class="col-span-full">
            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Add Media</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm leading-6 text-gray-600 text-center mb-3">
                        <label for="file-upload" class="mx-auto relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only" @change="uploadFile">
                        </label>
                    </div>
                    <p class="text-xs leading-5 text-gray-600 "><span class="uppercase">{{ accepts }}</span> up to 10MB</p>
                </div>
            </div>
        </div>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3" role="alert" v-if="error">
            <strong class="font-bold">Invalid File Type</strong>
            <span class="block sm:inline"> Uploader accepts only files with <span class="uppercase">{{ accepts }}</span> extensions</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" v-on:click="error = false">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        component:{
            type: String,
            required: true
        },
        multiple:{
            type: Boolean,
            required: true
        },
        accepts: {
            type: String,
            required: false,
            default: ''
        }
    },
    data(){
        return{
            file: '',
            selected: '',
            error: false
        }
    },
    methods:{
        uploadFile(event){
            this.file = event.target.files[0];
            if(this.validate(this.file.name.split('.').pop())){
                this.submit();
            }else{
                this.error = true;
            }   
        },
        submit(){
            let vm = this;
            let formdata = new FormData();
            formdata.append('file', vm.file);
            formdata.append('component', vm.component)
            axios.post('/media/store', formdata).then(response => {
                if(response.data.success){
                    vm.selected = response.data.media;
                    this.$emit('file-selected', vm.selected);
                }
            }).catch(error => {

            });
        },
        validate(extension){
            let accepts = this.accepts?.split(",");
            if(accepts && accepts.length < 2){
                return true;
            }
            return accepts.includes(extension) ? true : false;
        }
    },
    mounted(){

    }
}
</script>
