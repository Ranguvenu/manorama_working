<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-lead') && category.meta.add" v-on:click="open_modal">{{
            category.meta.new }}</Button>
        <SideModal :show="show" max-width="3xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> {{ category.name }}</div>
            </template>
            <div class="mx-2">
                <div>
                    <InputLabel for="name">Name <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="phone_number">Phone Number <span class="text-red-400">*</span></InputLabel>
                    <PhoneNumber id="phone_number" class="mt-1 w-full" v-model="form.phone" autofocus
                        autocomplete="phone_number" />
                    <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]" />
                    <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="email">Email <span class="text-red-400">*</span></InputLabel>
                    <TextInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="email" />
                    <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="product_id">Package</InputLabel>
                    <MultiSelect class="mt-2" v-model="form.product_id" returns="id" :options="data.packages" label="title"
                        :multiple="false" />
                    <InputError class="mt-2" v-if="errors && errors.product_id" :message="errors.product_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="tags" value="Tags" />
                    <TextInput id="tags" type="text" class="mt-1 block w-full" v-model="form.tags" required autofocus
                        autocomplete="tags" />
                    <InputError class="mt-2" v-if="errors && errors.tags" :message="errors.tags[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="source">Lead Source <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.source" returns="id" :options="data.sources" label="name"
                        :multiple="false" />
                    <InputError class="mt-2" v-if="errors && errors.source" :message="errors.source[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
                <Button size="sm" :class="{ 'cursor-not-allowed pointer-events-none': isloading }" color="primary"
                    v-if="current" v-on:click="update(current)"><LoaderButton :loading="isloading">Update Marketing Lead</LoaderButton></Button>
                <Button size="sm" :class="{ 'cursor-not-allowed pointer-events-none': isloading }" color="primary" v-if="!current" v-on:click="store">
                    <LoaderButton :loading="isloading">Create Marketing Lead</LoaderButton>
                </Button>
            </template>
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from "@/Components/Button.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import PhoneNumber from '@/Components/PhoneNumber.vue';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';
export default {
    components: {
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        PhoneNumber,
        MultiSelect,
        Button,
        LoaderButton
    },
    props: {
        current: {
            type: Number,
            required: true
        },
        category: {
            type: Object,
            required: true
        }
    },
    emits: ["refresh", "close"],
    data() {
        return {
            show: false,
            form: this.initialize(),
            data: {
                sources: [],
                packages: []
            },
            errors: [],
            isloading: false
        }
    },
    methods: {
        initialize() {
            return {
                name: '',
                phone: {
                    number: '',
                    code: '+91'
                },
                email: '',
                tags: '',
                source: '',
                associated_product: '',
                product_id: 0,
            }
        },
        edit(lead) {
            let vm = this;
            vm.create();
            axios.get(route('leads.category.edit', { category: vm.category.slug, interested: lead })).then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        create() {
            let vm = this;
            axios.get('/leads/' + vm.category.slug + '/create').then(response => {
                vm.data = response.data
            }).catch(error => {

            });
        },
        store() {
            let vm = this;
            vm.isloading = true;
            axios.post('/leads/' + vm.category.slug + '/store', vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                    vm.isloading = false;
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Marketing Lead', {
                    position: 'bottom-right'
                });
                vm.isloading = false;
            });
        },
        update(lead) {
            let vm = this;
            vm.isloading = true;
            axios.put('/leads/marketing/' + lead + '/update', vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                    vm.isloading = false;
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Update Marketing Lead', {
                    position: 'bottom-right'
                });
                vm.isloading = false;
            });
        },
        open_modal() {
            this.create();
            this.show = true;
        },
        close_modal() {
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
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
