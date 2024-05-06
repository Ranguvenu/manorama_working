<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12 px-3">
                <div class="col-span-full">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title" placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration"/>
                </div>
                <div class="sm:col-span-12">
                    <label class="block font-medium text-sm text-gray-700" for="description">Content</label>
                    <CkEditor v-model="configuration.description" @input="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="cutoff" value="Cutoff" />
                    <TextInput id="cutoff" type="number" class="mt-1 block w-full" v-model="configuration.cutoff" placeholder="Cutoff" autofocus autocomplete="cutoff" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="readmore_text" value="Readmore Text"/>
                    <TextInput id="readmore_text" type="text" class="mt-1 block w-full" v-model="configuration.readmore_text" placeholder="Readmore Text" autofocus autocomplete="readmore_text" v-on:keyup="update_configuration"/>
                </div>
                <div class="col-span-full">
                    <InputLabel for="readless_text" value="Readless Text"/>
                    <TextInput id="readless_text" type="text" class="mt-1 block w-full" v-model="configuration.readless_text" placeholder="Readless Text" autofocus autocomplete="readless_text" v-on:keyup="update_configuration"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import CkEditor from '@/Components/CkEditor.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
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
        },
        emits: ['update-configuration'],
        data(){
            return{
                configuration:{
                    title: '',
                    description: '',
                    cutoff: 10,
                    readmore_text: 'See More',
                    readless_text: 'See Less'
                }
            }
        },
        methods:{
            update_configuration(){
                this.$emit('update-configuration', this.configuration);
            },
        },
        mounted(){
            this.configuration = this.data;
            this.update_configuration();
        }
    }
</script>
