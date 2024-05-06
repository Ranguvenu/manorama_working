<template>
    <div class="mt-5">
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Name</th>
                    <th>Bio</th>
                    <th v-if="$has_capability('edit-blog-author') || $has_capability('delete-blog-author')">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results"
                    v-if="results && results.length">
                    <td>{{ data.name }}</td>
                    <td v-if="$has_capability('edit-blog-author') || $has_capability('delete-blog-author')">
                        <div v-html="data.bio.slice(0, 100)"></div>
                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            v-if="Object.keys(data.bio).length > 200" @click="activateReadMore(data)" href="#">
                            Read more...
                        </a>
                    </td>
                    <td v-if="$has_capability('edit-blog-author') || $has_capability('delete-blog-author')">
                        <ActionsDropdown align="right" width="5" height="5">
                            <template v-slot:content>
                                <div class="divide-y border-lightestgrey">
                                    <a href="javascript:void(0)" v-if="$has_capability('edit-blog-author')"
                                        v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                    <a href="javascript:void(0)" v-if="$has_capability('delete-blog-author')"
                                        v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
                                </div>
                            </template>
                        </ActionsDropdown>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Modal :show="show" max-width="7xl" @close="close_modal">
        <template #header>
            <div class="text-lg">Bio</div>
        </template>
        <div class="ck_content" v-html="readMoreActivated.bio"></div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="close_modal">Close</ButtonRegular>
        </template>
    </Modal>
</template>

<script>
import ActionsDropdown from '@/Components/ActionsDropdown.vue';
import Modal from '@/Components/Modal.vue';
import ButtonRegular from "@/Components/Button.vue";
export default {
    props: {
        results: {
            type: Array,
            required: true
        }
    },
    components: {
        ActionsDropdown,
        Modal,
        ButtonRegular,
    },
    data() {
        return {
            readMoreActivated: {
                id: 0,
                name: '',
                bio: '',
            },
            show: false,
        }
    },
    methods: {
        activateReadMore(data) {
            this.show = true;
            this.readMoreActivated.id = data.id;
            this.readMoreActivated.bio = data.bio;

        },
        deactivateReadMore() {
            this.readMoreActivated.id = 0;
            this.readMoreActivated.bio = this.readMoreActivated.bio.slice(0, 200);

        },
        open_modal() {
            this.show = true;
        },
        close_modal() {
            this.show = false;
            this.$emit('close');
        }

    },
    mounted() {

    }
}
</script>
