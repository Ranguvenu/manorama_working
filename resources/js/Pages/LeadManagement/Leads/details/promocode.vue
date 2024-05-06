<template>
    <div class="float-right mb-3">
        <ButtonRegular color="primary" size="sm" v-on:click="show = true; errors = []"  >Send Promo Code</ButtonRegular>
    </div>
    <Modal :show="show" max-width="2xl" @close="show = false">
        <template #header>
            <div class="text-lg">Send Promo Code</div>
        </template>
        <div class="m-3">
            <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 gap-3 mb-4">
                <div class="col-span-6">
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" v-if="errors && errors.email" :message="errors.name[0]"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="phone" value="Phone" />
                    <TextInput
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" v-if="errors && errors.phone" :message="errors.phone[0]"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="code">Code <span class="text-red-600">*</span></InputLabel>
                    <CouponsAutocomplete v-model="form.code" placeholder="Type to Search Code"  :data="coupons" returns="code" label="code" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]"/>
                </div>
                <div class="min-h-[100px] col-span-12"></div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="show = false">Close</ButtonRegular>
            <ButtonRegular :class="{'cursor-not-allowed pointer-events-none': isloading}" size="sm" color="primary" v-on:click="store"><LoaderButton :loading="isloading">Send Promo Code</LoaderButton></ButtonRegular>
        </template>
    </Modal>
</template>
<script>
    import Modal from '@/Components/Modal.vue'; 
    import ButtonRegular from '@/Components/Button.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import CouponsAutocomplete from '@/Components/AutoComplete/Coupons.vue';
    import LoaderButton from '@/SvgIcons/LoaderButton.vue';
    export default{
        components:{
            Modal,
            ButtonRegular,
            InputError,
            InputLabel,
            TextInput,
            CouponsAutocomplete,
            LoaderButton,
        },
        props:{
            lead: {
                type: Object,
                required: true
            },
            coupons: {
                type: Object,
                required: true
            }
        },
        data(){
            return{
                show: false,
                form: this.initialize(),
                errors: [],
                isloading: false
            }   
        },
        methods: {
            initialize(){
                return {
                    name: this.lead.name,
                    email: this.lead.email,
                    phone: this.lead.caller,
                    code: ''
                }
            },
            store(){
                let vm = this;
                vm.isloading = true;
                axios.post(route('leads.promocode.send', {interests: vm.lead.id}), vm.form).then(response => {
                    if(response.data.success){
                        this.show = false;
                        vm.isloading = false;
                        this.form = this.initialize();
                        this.$toast.success(response.data.message,{
                            position: 'bottom-right'
                        });
                        this.$emit('refresh', vm.lead.id);
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    vm.isloading = false;
                });
            }
        },
        watch: {
            "lead.id": function() {
                this.form = this.initialize();
            }
        },
        mounted(){
            // this.form = this.initialize()
        }
    }
</script>
