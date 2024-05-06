<template>
    <div class="mt-5">
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" v-if="results && results.length">
                    <td>{{ data.name }}</td>
                    <td>{{ data.email }}</td>
                    <td>{{ data.country_code }} {{ data.phone_number }}</td>
                    <td>
                        <div v-html="data.message.slice(0, 100)"></div>
                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            v-if="Object.keys(data.message).length > 200" @click="activateReadMore(data)" href="#">
                            Read more...
                        </a>
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
            <div class="text-lg">User message</div>
        </template>
        <div class="ck_content p-3" v-html="readMoreActivated.message"></div>
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
                required: true,
            },
            meta: {
                type: Object,
                rquired: true
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
                    message: '',
                },
                show: false,
            }
        },
        methods: {
            activateReadMore(data) {
                this.show = true;
                this.readMoreActivated.id = data.id;
                this.readMoreActivated.message = data.message;

            },
            deactivateReadMore() {
                this.readMoreActivated.id = 0;
                this.readMoreActivated.message = this.readMoreActivated.message.slice(0, 200);

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
    };
</script>
