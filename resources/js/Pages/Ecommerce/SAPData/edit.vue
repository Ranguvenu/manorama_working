<template>
    <SideModal :show="show" max-width="4xl" @close="close_modal">
        <template #header>
            <div class="text-lg">Edit SAP Data</div>
        </template>
        <div class="mx-2">
            <div>
                <InputLabel for="payload">Payload</InputLabel>
                <TextArea id="payload" type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2 min-h-[150px]"
                    v-model="form.payload" required autofocus autocomplete="payload" v-bind:disabled="!editdata"
                    v-bind:enabled="editdata" />
            </div>
            <div v-if="response && response.response" class="mt-2">
                <InputLabel for="payload">Response</InputLabel>
                <div class="border p-2 rounded bg-zinc-100">
                    {{ response.response }}
                </div>
            </div>
        </div>
        <template #footer>
            <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
            <Button size="sm" color="primary" v-if="!editdata" v-on:click="toggle">Edit SAP Data</Button>
            <Button size="sm" color="primary" v-if="editdata" v-on:click="update(current)">Update & Submit SAP Data</Button>
        </template>
    </SideModal>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import Button from "@/Components/Button.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
export default {
    emits: ['refresh', 'close'],
    props: {
        current: {
            type: Number,
            default: false
        },
    },
    components: {
        SideModal,
        Button,
        InputLabel,
        TextArea
    },
    data() {
        return {
            form: this.initialize(),
            data: [],
            show: false,
            editdata: false,
            response: ''
        }
    },
    methods: {
        initialize() {
            return {
                payload: '',
            }
        },
        edit(sapid) {
            let vm = this;
            axios.get(route('integrations.sap.edit', { sapdata: sapid })).then(response => {
                vm.form = response.data.data;
                vm.response = response.data.response;
                vm.show = true;
            }).catch(error => {

            });
        },
        update(sapid) {
            let vm = this;
            axios.put(route('integrations.sap.update', { sapdata: sapid }), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        open_modal() {
            this.show = true;
        },
        close_modal() {
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
            this.editdata = false;
        },
        toggle() {
            this.editdata = true;
        }
    },
    watch: {
        current() {
            if (this.current) {
                this.edit(this.current);
            }
        }
    },
    mounted() {

    }
}
</script>
