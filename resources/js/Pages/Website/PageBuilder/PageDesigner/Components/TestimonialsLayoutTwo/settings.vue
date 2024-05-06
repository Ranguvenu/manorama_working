<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12 pt-3">
                <div class="col-span-6">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="caption" value="Caption" />
                    <TextArea id="caption" type="text" class="mt-1 block w-full" v-model="configuration.caption" placeholder="Caption" autofocus autocomplete="caption" v-on:keyup="update_configuration"/>
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
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Testimonials</div>
            <div class="border border-gray-300 my-2" v-for="(testimonial, index) in configuration.testimonials" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Testimonial {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="name" value="Name" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="testimonial.name" placeholder="Name" autofocus autocomplete="name" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="profile" value="Profile" />
                        <MediaButton id="profile" class="mt-2" component="website" name="Select Profile" :multiple="false" return_type="url" v-model="testimonial.profile"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="logo" value="Logo" />
                        <MediaButton id="logo" class="mt-2" component="website" name="Select Logo" :multiple="false" return_type="url" v-model="testimonial.logo"/>
                    </div> 
                    <div class="col-span-full mt-3">
                        <InputLabel for="university" value="University" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="testimonial.university" placeholder="University" autofocus autocomplete="university" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="description" value="Description" />
                        <TextArea type="text" class="mt-1 block w-full" v-model="testimonial.description" placeholder="Description" autofocus autocomplete="description" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_testimonial(index)"
                        v-if="configuration.testimonials.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_testimonial">Add testimonial</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import Checkbox from '@/Components/Checkbox.vue';

    export default{
        props:{
            data:{
                type: Object,
                required: true
            }
        },
        components:{
            TextInput,
            InputLabel,
            MediaButton,
            ButtonOutline,
            TextArea,
            Checkbox
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Results & Testimonials',
                    caption: '100+ Admits in Fall 2022 and Spring 2023',
                    layout: 'grid-layout',
                    testimonials: [],
                    navigation : 1,
                    pagination : 1,
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_testimonial() {
                let testimonial = this.create_testimonial();
                this.configuration.testimonials.push(testimonial);
                this.update_configuration();
            },
            remove_testimonial(index) {
                this.configuration.testimonials.splice(index, 1);
                this.update_configuration();
            },
            create_testimonial() {
                return {
                    profile: 'Vaishnavi Koya',
                    university: 'Pace University',
                    logo: 'University Logo',
                    description: 'Conduria consultancy has helped with the whole admission. Lakshmi Mam and Abdullah sir are available when I need them I am very happy with the support received from Conduria. I also took coaching for GRE and IELTS, The way Abdullah sir teaches is amazing. I highly recommend conduria who is planning their study abroad.',
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
