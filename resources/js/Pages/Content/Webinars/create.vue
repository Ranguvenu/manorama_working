<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-webinar')" v-on:click="open_modal">Add Webinar</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Webinar</div>
            </template>
            <div class="px-3 my-2">
                <div>
                    <InputLabel for="category_id">Category <span class="text-red-600">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.category_id" returns="id" :options="data.categories" label="name" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.category_id" :message="errors.category_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-3" for="thumbnail_id">Thumbnail <span class="text-red-600">*</span></InputLabel>
                    <MediaButton accepts="png,jpeg,jpg,svg,webp" component="webinar" name="Choose file" :multiple="false" return_type="id" v-model="form.thumbnail_id"/>
                    <small class="text-gray-600">Note: Thumbnail should be in .png, .jpeg, .jpg, .svg or .webp format.</small>
                    <InputError class="mt-2" v-if="errors && errors.thumbnail_id" :message="errors.thumbnail_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="title">Title <span class="text-red-600">*</span></InputLabel>
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.title"
                        required
                        autofocus
                        autocomplete="title"
                    />
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="description">Description <span class="text-red-600">*</span></InputLabel>    
                    <CkEditor
                        id="description"
                        type="text"
                        class="block w-full"
                        v-model="form.description"
                        required
                        autofocus
                        autocomplete="description"
                    />
                    <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="date_time">Date & Time <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                        id="date_time"
                        type="datetime-local"
                        class="mt-2 block w-full"
                        v-model="form.date_time"
                        required
                        autofocus
                        autocomplete="date"
                    />
                    <InputError class="mt-2" v-if="errors && errors.date_time" :message="errors.date_time[0]"/>
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="about_presenter">About Presenter <span class="text-red-600">*</span></InputLabel>    
                    <CkEditor
                        id="about_presenter"
                        type="text"
                        class="block w-full"
                        v-model="form.about_presenter"
                        required
                        autofocus
                        autocomplete="about_presenter"
                    />
                    <InputError class="mt-2" v-if="errors && errors.about_presenter" :message="errors.about_presenter[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="recording_url">Recording Link</InputLabel>    
                    <TextInput
                        id="recording_url"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.recording_url"
                        autofocus
                        autocomplete="recording_url"
                    />
                    <InputError class="mt-2" v-if="errors && errors.recording_url" :message="errors.recording_url[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="published_on">Published On <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                        id="published_on"
                        type="date"
                        class="mt-2 block w-full"
                        v-model="form.published_on"
                        required
                        autofocus
                        autocomplete="date"
                    />
                    <InputError class="mt-2" v-if="errors && errors.published_on" :message="errors.published_on[0]"/>
                </div>
                <div class="mt-3">
                    <InputLabel for="status">Status <span class="text-red-600">*</span></InputLabel>
                    <select style="border-radius: 0.4rem; border: 1px solid #d9d9d9;" id="status" class="mt-1 block w-full border-0.5" v-model="form.status" required>
                        <option disabled value="">Select status</option>
                        <option value="0">Draft</option>
                        <option value="1">Published</option>
                    </select>
                    <div class="text-sm text-red-600" v-if="errors && errors.status">{{ errors.status[0] }}</div>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Webinar</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Webinar</Button>
            </template>  
        </SideModal>
    </div>
</template>
<script>
    import SideModal from '@/Components/SideModal.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Button from "@/Components/Button.vue";
    import CkEditor from '@/Components/CkEditor.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import MultiSelect from "@/Components/MultiSelect.vue";
    export default{
        components:{
            SideModal,        
            InputError,
            InputLabel,
            TextInput,
            Button,
            CkEditor,
            MediaButton,
            MultiSelect
        },
        props:{
            current: {
                type: Number,
                required: true
            }
        },
        data(){
            return{
                show: false,
                form: this.initialize(),
                data: {
                    categories: [],
                },
                errors: []
            }
        },
        methods:{
            initialize(){
                return{
                    category_id: '',
                    thumbnail_id: '',
                    title: '',
                    description: '',
                    date_time: '',
                    about_presenter: '',
                    meeting_information: '',
                    recording_url: '',
                    status: '',
                    published_on: '',
                }
            },
            create(){
                let vm = this;
                axios.get(route('content.webinars.create')).then(response => {
                    vm.data = response.data
                }).catch(error => {

                });
            },
            edit(webinar){
                let vm = this;
                axios.get(route('content.webinars.edit', { webinar: webinar })).then(response => {
                    vm.form = response.data.data;
                    vm.show = true;
                }).catch(error => {

                });
            },
            store(){
                let vm = this;
                axios.post(route('content.webinars.store'), vm.form).then(response => {
                    if(response.data.success){
                        vm.close_modal();
                        vm.$emit('refresh');
                        this.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Create Webinar', {                        
                        position: 'bottom-right'
                    });
                });
            },
            update(webinar){
                let vm = this;
                axios.put(route('content.webinars.update', { webinar: webinar }), vm.form).then(response => {
                    if(response.data.success){
                        vm.close_modal();
                        vm.$emit('refresh');
                        this.$toast.success(response.data.message, {
                            position: 'bottom-right',
                        });
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Update Webinar', {                        
                        position: 'bottom-right'
                    });
                });
            },
            open_modal(){
                this.create();
                this.show = true;
            },
            close_modal(){
                this.form = this.initialize();
                this.show = false;
                this.errors = [];
                this.$emit('close');
            }
        },
        watch: {
            current(){
                if(this.current){
                    this.create();
                    this.edit(this.current);
                }
            }
        },
        mounted(){
            
        }
    }
</script>
