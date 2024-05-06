<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="pt-3">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Mentors</div>
            <div class="border border-gray-300 my-2" v-for="(mentor, index) in configuration.mentors" :key="index">
                <div class="text-gray-800 font-semibold bg-gray-200 p-2">Mentor {{ index + 1 }}</div>
                <div class="mt-2 grid-cols-1 gap-x-6  sm:grid-cols-6 px-3">
                    <div class="col-span-full mt-3">
                        <InputLabel for="name" value="Name" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="mentor.name" placeholder="Name" autofocus autocomplete="name" v-on:keyup="update_configuration"/>
                    </div>
                    <div class="sm:col-span-12 mt-3">
                        <InputLabel for="profile" value="Profile" />
                        <MediaButton class="mt-2" component="website" name="Select Image" :multiple="false" return_type="url" v-model="mentor.profile"/>
                    </div>
                    <div class="col-span-full mt-3">
                        <InputLabel for="linkedin" value="Linkedin" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="mentor.linkedin" placeholder="Card Linkedin" autofocus autocomplete="linkedin" v-on:keyup="update_configuration"/>
                    </div>
                </div>
                <div class="mt-3 flex mentors-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="remove_mentor(index)"
                        v-if="configuration.mentors.length > 1">Remove</ButtonOutline>
                </div>
            </div>
            <div class="mt-6 flex mentors-center justify-end gap-x-6">
                <ButtonOutline color="primary" size="sm" v-on:click="add_mentor">Add Mentor</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
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
            ButtonOutline
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: 'Our Mentors',
                    mentors: []
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
            add_mentor() {
                let mentor = this.create_mentor();
                this.configuration.mentors.push(mentor);
                this.update_configuration();
            },
            remove_mentor(index) {
                this.configuration.mentors.splice(index, 1);
                this.update_configuration();
            },
            create_mentor() {
                return {
                    name: 'USA',
                    linkedin: 'USA',
                    profile : '/images/pagebuilder/ourmentors/mentor2.png'
                }
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
