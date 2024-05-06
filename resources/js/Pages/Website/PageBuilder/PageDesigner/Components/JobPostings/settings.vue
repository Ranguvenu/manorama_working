<template>
    <div>
        <div class="p-3">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-full">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-full">
                    <InputLabel for="title" value="Postings Per Page" />
                    <TextInput id="title" type="number" class="mt-1 block w-full" v-model="configuration.perpage"
                        placeholder="Postings Per Page" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        TextInput,
        InputLabel,
        
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                perpage: 10
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
