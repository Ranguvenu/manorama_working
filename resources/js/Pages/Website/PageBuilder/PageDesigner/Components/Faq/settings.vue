<template>
    <div>
        <div class="border border-gray-300 p-3">
            <div class="grid grid-cols-12 gap-x-5 p-3">
                <div class="col-span-6">
                    <InputLabel for="title" value="Section Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="mode" value="Mode" />
                    <select class="w-full mt-1 border-gray-300 rounded" v-model="configuration.mode" v-on:keyup="update_configuration">
                        <option value="0">Manually Configure Questions</option>
                        <option value="1">Fetch From Master Data</option>
                    </select>
                </div>
            </div>
        </div>
        <div v-if="configuration.mode == 1" class="mt-2 border border-gray-300  p-2">
            <InputLabel class="text-gray-800 font-semibold mb-2" for="title" value="Select Categories"/>
            <MultiSelect v-model="configuration.categories" placeholder="Select Categories" returns="id" :options="options.categories" label="name" :multiple="true" v-if="isfaqinitialized"/>
        </div>
        <div v-if="configuration.mode == 0">
            <div>
                <div class="text-lg font-semibold pt-5 pb-2 text-gray-800">Questions</div>
                <div v-for="(item, index) in configuration.items" :key="index" class="border p-2">
                    <div class="col-span-full mb-2" :section="section" v-if="item.category !== undefined">
                        <InputLabel class="text-gray-800 font-semibold" for="title"
                            value="Category Title" />
                        <TextInput id="itemcategory" type="text" class="mt-1 block w-full" v-model="item.category"
                            placeholder="Category Title" autofocus autocomplete="category"
                            v-on:keyup="update_configuration" />
                    </div>
                    <div class="border">
                        <div class="text-gray-800 font-semibold bg-gray-100 p-2">Item {{ index + 1 }}</div>
                        <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-3">
                            <div class="sm:col-span-12 mt-2">
                                <InputLabel for="" value="Question" />
                                <TextInput id="question-{{index}}" type="text" class="mt-2 block w-full" v-model="item.question"
                                    placeholder="Question" autofocus autocomplete="Question"
                                    v-on:keyup="update_configuration" />
                            </div>
                            <div class="sm:col-span-12">
                                <label class="block font-medium mb-2 text-sm text-gray-700" for="description">Answer</label>
                                <CkEditor v-model="item.answer" @input="update_configuration" />
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-end gap-x-6">
                            <ButtonOutline color="primary" size="sm" v-on:click="remove_item(index)"
                                v-if="configuration.items.length > 1">Remove</ButtonOutline>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <ButtonOutline color="primary" size="sm" v-on:click="add_item">Add Question</ButtonOutline>
                    <ButtonOutline color="primary" size="sm" v-on:click="add_category">Add Category</ButtonOutline>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CkEditor from '@/Components/CkEditor.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MediaButton from '@/Components/MediaButton.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        CkEditor,
        TextInput,
        InputLabel,
        MediaButton,
        ButtonOutline,
        MultiSelect
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                items: [],
                mode: 0                
            },
            options: {
                categories: []
            },
            isfaqinitialized: false
        }
    },
    methods: {
        add_item() {
            this.section = false;
            let item = this.create_item();
            this.configuration.items.push(item);
            this.update_configuration();
        },
        add_category() {
            let category = this.create_item();
            category.category = ''; // Clear the category field for a new category item
            this.configuration.items.push(category);
            this.update_configuration();
        },
        remove_item(index) {
            this.configuration.items.splice(index, 1);
            this.update_configuration();
        },
        create_item() {
            return {
                question: '',
                title: '',
                answer: '',
            }
        },
        create_section() {
            return {
                question: '',
                title: '',
                answer: '',
                category: ''
            }
        },
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        },
        create() {
            let vm = this;
            let payload = {}
            axios.post(route('website.components.create', { component: 'faq' }), payload).then((response) => {
                vm.options = response.data;
                vm.isfaqinitialized = true;
            }).catch(error => {

            });
        },
    },
    watch: {
        "configuration.mode": function(){
            if(this.configuration.mode == 1){
                this.create();
            }
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
        if(this.configuration.mode == 1){
            this.create();
        }
    }
}
</script>
