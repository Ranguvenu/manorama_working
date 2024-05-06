<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Notification Type</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" v-if="results && results.length">
                    <td>{{ data.type }}</td>
                    <td>{{ data.title }}</td>
                    <td><p v-html = "data.content.slice(0,200)"></p>
                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"  v-if="Object.keys(data.content).length >200" @click="activateReadMore(data)" href="#">
                            Read more...
                        </a>
                    </td>
                    <td>{{ data.status_name }}</td>
                    <td>
                        <ActionsDropdown align="right">
                          <template #content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('edit-email_template')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-email_template') && (data.status == 1)" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
    <Modal :show="show" max-width="xl" @close="close_modal">
        <template #header>
            <div class="text-lg">{{ readMoreActivated.title }}</div>
        </template>
        <p class="mx-3" v-html = "readMoreActivated.content"></p>
        <template #footer>
            <ButtonRegular size="sm" color="default"  v-on:click="close_modal">Close</ButtonRegular>                
        </template>
    </Modal>
</template>
<script>
    import ActionsDropdown from '@/Components/ActionsDropdown.vue';
    import Modal from '@/Components/Modal.vue';
    import ButtonRegular from "@/Components/Button.vue";
    export default {
        emits: ['edit', 'delete'],
        props: {
            results: {
                type: Array,
                required: true,
            },
        },
        components: {
            ActionsDropdown,
            Modal,
            ButtonRegular
        },
        data() {
            return {
                readMoreActivated: {
                    id: 0,
                    title: '',
                    content:'',
                },
                show: false,
            };
        },
        methods: {
            activateReadMore(data){
                this.show = true;
                this.readMoreActivated.id = data.id;
                this.readMoreActivated.title = data.title;
                this.readMoreActivated.content = data.content;
            },
            deactivateReadMore(){
                this.readMoreActivated.id = 0;
                this.readMoreActivated.content = this.readMoreActivated.content.slice(0,200) ;
            },
            open_modal(){
                this.show = true;
            },
            close_modal(){
                this.show = false;
            }
        },
        mounted() {

        },
    };
</script>
