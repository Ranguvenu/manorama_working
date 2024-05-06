<template>
    <div>
        <div class="p-3 border mt-2">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 mt-3 sm:grid-cols-12">
                <div class="col-span-12">
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" class="mt-1 block w-full" v-model="configuration.title"
                        placeholder="Section Title" autofocus autocomplete="title" v-on:keyup="update_configuration" />
                </div>
                <div class="col-span-12">
                    <div>Categories</div>
                    <table class="min-w-full bg-white border">
                        <tr>
                            <td class="w-1/6 text-left py-4 px-8 text-dark">Category</td>
                            <td class="w-1/6 text-center py-4 px-8 text-dark">Enable</td>
                            <td class="w-2/6 text-left py-4 px-8 text-dark">View More Label</td>
                            <td class="w-2/6 text-left py-4 px-8 text-dark">View More Link</td>
                        </tr>
                        <tr v-for="(category, index) in configuration.categories" :key="index">
                            <td class="w-1/6 text-left py-4 px-8 text-dark">{{ category.label }}</td>
                            <td class="w-1/6 text-center py-4 px-4 text-dark ">
                                <Checkbox name="status" v-model="category.show" :checked="category.show" v-on:change="update_configuration"/>
                            </td>
                            <td class="w-2/6 text-left py-4 px-4 text-dark ">
                                <TextInput id="title" type="text" class="mt-1 block w-full"
                                        v-model="category.more.label" placeholder="View More Label" autofocus
                                        v-on:keyup="update_configuration" />
                            </td>
                            <td class="w-2/6 text-left py-4 px-4 text-dark ">
                                <TextInput id="title" type="text" class="mt-1 block w-full"
                                        v-model="category.more.link" placeholder="View More Label" autofocus
                                        v-on:keyup="update_configuration" />
                            </td>
                        </tr>
                    </table>
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
import Checkbox from '@/Components/Checkbox.vue';
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
        Checkbox
    },
    emits: ['update-configuration'],
    data() {
        return {
            configuration: {
                title: '',
                categories: {
                    webinars: {
                        label: 'Webinars',
                        slug: 'webinars',
                        show: 1,
                        count: 4,
                        more: {
                            label: 'View More',
                            link: 'https://linktomorewebinars'
                        }
                    },
                    articles: {
                        label: 'Articles',
                        slug: 'articles',
                        show: 1,
                        count: 4,
                        more: {
                            label: 'View More',
                            link: 'https://linktomorewebinars'
                        }
                    },
                    currentaffairs: {
                        label: 'Current Affairs',
                        slug: 'currentaffairs',
                        show: 1,
                        count: 4,
                        more: {
                            label: 'View More',
                            link: 'https://linktomorecurrentaffairs'
                        }
                    },
                    studymaterials: {
                        label: 'Study Materials',
                        slug: 'studymaterials',
                        show: 1,
                        count: 4,
                        more: {
                            label: 'View More',
                            link: 'https://linktomorestudymaterials'
                        }
                    }
                }
            }
        }
    },
    methods: {
        update_configuration() {
            this.$emit('update-configuration', this.configuration);
        }
    },
    mounted() {
        this.configuration = this.data;
        this.update_configuration();
    }
}
</script>
