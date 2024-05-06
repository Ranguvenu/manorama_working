<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 px-3">
                <div class="col-span-full">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="caption" value="Caption" />
                    <TextArea id="caption" class="border-gray-300 mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="package" value="Package" />
                    <PackageAutoComplete v-model="configuration.package" :filters="{'published': 1}" :data="options.packages" returns="id" label="title"
                        :multiple="false" v-if="ispackageinitialized"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="testimonialcount" value="Testimonials Per Page" />
                    <TextInput id="testimonialcount" type="number" class="mt-1 block w-full" v-model="configuration.perpage" placeholder="Testimonials Per Page" autofocus v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="link" value="View all testimonials link" />
                    <TextInput id="link" type="text" class="mt-1 block w-full" v-model="configuration.view_all" placeholder="View all testimonials link" autofocus v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-12">
                    <InputLabel class="mb-2" for="layout" value="Layout" />
                    <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="configuration.layout" v-on:keyup="update_configuration">
                        <option value="grid-layout">Grid Layout</option>
                        <option value="carousel-layout">Carousel Layout</option>
                    </select>
                </div>
                <div class="col-span-2 flex" v-if="configuration.layout == 'carousel-layout'">
                    <InputLabel for="navigation" value="Navigation"/>
                    <div id="navigation" class="ms-3">
                        <Checkbox name="navigation" v-model:checked="configuration.navigation" />
                    </div>
                </div>
                <div class="col-span-2 flex" v-if="configuration.layout == 'carousel-layout'">
                    <InputLabel for="pagination" value="Pagination"/>
                    <div id="pagination" class="ms-3">
                        <Checkbox name="pagination" v-model:checked="configuration.pagination" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import CkEditor from '@/Components/CkEditor.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import PackageAutoComplete from '@/Components/AutoComplete/Packages.vue';
    import Checkbox from '@/Components/Checkbox.vue';

    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            CkEditor,
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            TextArea,
            PackageAutoComplete,
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    caption: '',
                    perpage: '',
                    view_all: '',
                    package: 0,
                    layout: 'grid-layout',
                    navigation : 1,
                    pagination : 1,
                },
                options: {
                    packages: []
                },
                ispackageinitialized: false
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            create() {
                let vm = this;
                let payload = {
                    package: vm.configuration.package
                }
                console.log('payload:', payload);
                axios.post(route('website.components.create', { component: 'testimonials' }), payload).then((response) => {
                    vm.options = response.data;
                    console.log('optio',vm.options)
                    vm.ispackageinitialized = true;
                }).catch(error => {

                });
            },
        },
        mounted(){
            this.configuration = this.data;
            if(this.configuration.limit == 0){
                this.configuration.limit = this.configuration.limittestimonials;
            }
            this.update_configuration();
            this.create();
        }
    }

</script>
