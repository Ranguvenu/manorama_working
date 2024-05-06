<template>
    <div>
        <Button
            size="sm"
            v-if="$has_capability('create-videolist')"
            v-on:click="open_modal"
            > Add Video List</Button
        >
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg">
                    <span v-if="current">Edit</span
                    ><span v-else>Add</span> Video List
                </div>
            </template>
            <div class="px-3">
                <div>
            <InputLabel for="title">Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                        autofocus
                        autocomplete="title"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.title"
                        :message="errors.title[0]"
                    />
                    </div>    
            
                    <div class="mt-3" v-if="isinitialized">
					<InputLabel for="category">Category <span class = "text-red-400">*</span></InputLabel>		
                    <MultiSelect class="mt-2" v-model="form.category_id" returns="id" :options="data.categories" label="name" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.category_id" :message="errors.category_id[0]" />
               </div>    
                <div class="mt-3">
                    <InputLabel for="image">Image Thumbnail <span class="text-red-400">*</span></InputLabel>
                    <MediaButton
                        class="mt-1"
                        accepts="png,jpeg,jpg,svg,webp"
                        component="content"
                        name="Upload Thumbnail"
                        :multiple="false"
                        return_type="url"
                        v-model="form.thumbnail"
                    />
                    <small class="text-gray-600"
                        >Note: Image Thumbnail should be in .png, .jpeg, .jpg,
                        .svg or .webp format.</small
                    >
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.thumbnail"
                        :message="errors.thumbnail[0]"
                    />
                </div>    
    
            <div class="mt-3">
                <InputLabel for="videourl">Upload Video URL
                    <span class="text-red-400">*</span>
                </InputLabel>
                <TextInput id="videourl" type="text" class="mt-1 block w-full" v-model="form.video" autofocus
                    autocomplete="host" />
                <InputError class="mt-2" v-if="errors && errors.video" :message="errors.video[0]" />
            </div>
            <div class="mt-3 sm:col-span-4">
                    <InputLabel for="published_from"
                        >Published From
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="published_from"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.published_from"
                        required
                        autofocus
                        autocomplete="date"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.published_from"
                        :message="errors.published_from[0]"
                    />
                </div>
                <div class="mt-3 sm:col-span-4">
                    <InputLabel for="published_to"
                        >Published To
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="published_to"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.published_to"
                        required
                        autofocus
                        autocomplete="date"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.published_to"
                        :message="errors.published_to[0]"
                    />
                </div>             
             
            </div>

            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal"
                    >Close</Button
                >
                <Button
                    size="sm"
                    color="primary"
                    v-if="current"
                    v-on:click="update(current)"
                    >Update Video List</Button
                >
                <Button
                    size="sm"
                    color="primary"
                    v-if="!current"
                    v-on:click="store"
                    >Create Video List</Button
                >
            </template>
        </SideModal>
    </div>
</template>

<script>
import SideModal from "@/Components/SideModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Button from "@/Components/Button.vue";
import MediaButton from "@/Components/MediaButton.vue";
import MultiSelect from '@/Components/MultiSelect.vue';
export default {
    components: {
        SideModal,   
        InputError,
        InputLabel,
        TextInput,       
        Button,    
        MediaButton,
        MultiSelect     
    },
    props: {
        current: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            show: false,
            form: this.initialize(),
            errors: [],
            data: {
                categories: []        
            },
            isinitialized: false,
        };
    },
    methods: {
        initialize() {
            return {
                title: '',
                category_id : '',
                thumbnail: '',          
                video: '',           
                published_from: '',
                published_to:'',                
            };
        },
        edit(videolist) {
            let vm = this;
            axios.get(route("content.videolist.edit", {videolist: videolist})).then((response) => {
                    vm.form = response.data.data;
                    vm.show = true;
                }).catch((error) => {});
        },
        create() {
            let vm = this;
            axios.get(route("content.videolist.create")).then((response) => {                   
                    vm.data = response.data;
                   vm.isinitialized = true;             

                }).catch((error) => {});
        },
        store() {
            let vm = this;
            axios.post(route("content.videolist.store"), vm.form).then((response) => {
                    if (response.data.success) {
                        vm.close_modal();
                        vm.$emit("refresh");
                        this.$toast.success(response.data.message, {
                            position: "bottom-right",
                        });
                    }
                }).catch((error) => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Create Study Material', {
                        position: 'bottom-right'
                    });
                });
        },

        update(videolist) {
            let vm = this;
            axios.put(route("content.videolist.update", {videolist: videolist, }),vm.form).then((response) => {
                    if (response.data.success) {
                        vm.close_modal();
                        vm.$emit("refresh");
                        this.$toast.success(response.data.message, {
                            position: "bottom-right",
                        });
                    }
                }).catch((error) => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Update Study Material', {
                        position: 'bottom-right'
                    });
                });
        },
        open_modal() {  
            this.create();
            this.show = true;
        },
        close_modal() {
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit("close");
        },
    },
    watch: {
        current() {
            if (this.current) {
                this.create();
                this.edit(this.current);
            }
        },
 
    },
    mounted() {},
};
</script>
