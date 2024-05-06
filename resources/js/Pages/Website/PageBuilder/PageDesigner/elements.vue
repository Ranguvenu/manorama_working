<template>
    <div>
        <TextInput type="text" class="bg-neutral-50 bg-opacity-90 rounded border border-neutral-300 block w-full" v-model="search" placeholder="Search for Components"/>
        <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 grid-cols-12">
            <div class="lg:col-span-3 md:col-span-4 sm:col-span-6 col-span-12 border-2 cursor-pointer" v-for="(component, index) in searched_components" v-on:click="$emit('add-component', component)">
                <img :src="component.featured_image" class="w-full flex items-center content-center object-contain min-h-[125px] max-h-[125px]"/>
                <div class="text-md p-2 text-center">{{  component.name }}</div>                
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    export default {
        components:{
            TextInput
        },
        data(){
            return{
                filters: {
                },
                search: '',
                components: []
            }
        },
        emits: ['add-component'],
        methods:{
            index(){
                let vm = this;
                axios.post(route('website.pages.components'), vm.filters).then(response => {
                    vm.components = response.data;
                }).catch(error =>{

                });
            }
        },
        computed:{
            searched_components(){
                return this.components.filter((component) => {
                    return (
                        component.name.toLowerCase()
                        .indexOf(this.search.toLowerCase()) != -1

                    );
                });
            }
        },
        mounted(){
            this.index();
        }
    }
</script>
