<template>
    <div>
        <div class="grid grid-cols-12 gap-3 mb-4">            
            <div class="col-span-8">
                <div class="bg-white" v-if="!edit">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 border p-3">
                        <div class="col-span-12">
                            <InputLabel for="users" class="mb-1">Users <span class="text-red-400">*</span></InputLabel>
                            <UsersAutocomplete v-model="form.user_id" :data="options.users" returns="id" label="email" :multiple="false" :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.user_id" :message="errors.user_id[0]"/>
                        </div>
                        <div class="col-span-12">
                            <InputLabel for="package" class="mb-1">Package <span class="text-red-400">*</span></InputLabel>
                            <PackagesAutocomplete v-model="form.package_id" returns="id" :data="options.packages" label="title" :multiple="false"  :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.package_id" :message="errors.package_id[0]"/>
                        </div>
                        <div class="col-span-12">
                            <InputLabel for="pricing" class="mb-1">Courses <span class="text-red-400">*</span></InputLabel>
                            <CoursesAutocomplete :depends="form.package_id" v-model="form.courses" returns="id" :data="options.courses" label="name" :multiple="true" :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.courses" :message="errors.courses[0]"/>
                        </div>
                        <div class="col-span-12">
                            <InputLabel for="pricing" class="mb-1">Batches <span class="text-red-400">*</span></InputLabel>
                            <BatchesAutoComplete :depends="form.package_id" v-model="form.batches" returns="id" :data="options.batches" label="name" :multiple="true" :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.batches" :message="errors.batches[0]"/>
                        </div>     
                        <div class="col-span-12">
                            <InputLabel for="pricing" class="mb-1">Payment Reference Number <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="form.cheque" placeholder="Payment Reference Number" :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.cheque" :message="errors.cheque[0]"/>
                        </div>                 
                    </div>
                </div>
                <div class="bg-white" v-else>
                    <div class="mb-4 border p-3">
                        <div class="text-md font-semibold mb-3">Order Summary</div>
                        <div class="flex flex-col my-4">
                            <div class="flex flex-wrap justify-between items-center mb-3">
                                <div class="text-gray-600 text-md">User Email</div>
                                <div class="text-zinc-800 text-md font-medium"><span v-if="form.user">{{ form.user.email }}</span><span v-else>NA</span></div>
                            </div>
                            <div class="flex flex-wrap justify-between items-center mb-3">
                                <div class="text-gray-600 text-md">Package</div>
                                <div class="text-zinc-800 text-md font-medium"><span v-if="form.package">{{ form.package.title }}</span><span v-else>NA</span></div>
                            </div>
    
                            <div class="flex flex-wrap justify-between items-center mb-3">
                                <div class="text-gray-600 text-md">Courses</div>
                                <div class="text-zinc-800 text-md font-medium"><span v-if="form.courses">{{ form.courses }}</span><span v-else>NA</span></div>
                            </div>
                            <div class="flex flex-wrap justify-between items-center mb-3">
                                <div class="text-gray-600 text-md">Batches</div>
                                <div class="text-zinc-800 text-md font-medium"><span v-if="form.batches">{{ form.batches }}</span><span v-else>NA</span></div>
                            </div>
                            <div class="flex flex-wrap justify-between items-center mb-3">
                                <div class="text-gray-600 text-md">Payment Reference Number</div>
                                <div class="text-zinc-800 text-md font-medium"><span v-if="form.cheque">{{ form.cheque }}</span><span v-else>NA</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border p-2" v-if="pricing && pricing.selling_price">
                    <div class="text-md font-semibold mb-3">Payment Summary</div>
                    <CouponCode :package="form.package_id" v-if="form.package_id && !edit" @apply="apply"/>
                    <div class="flex flex-col my-4">
                        <div class="flex flex-wrap justify-between items-center mb-3">
                            <div class="text-gray-600 text-md">Actual Price</div>
                            <div class="text-zinc-800 text-md font-medium"><span>₹</span> {{ pricing.actual_price }}</div>
                        </div>
                        <div class="flex flex-wrap justify-between items-center mb-3">
                            <div class="text-gray-600 text-md">Selling Price </div>
                            <div class="text-zinc-800 text-md font-medium"><span>₹</span>  {{ pricing.selling_price }}</div>
                        </div>
                        <div class="flex flex-wrap justify-between items-center mb-3">
                            <div class="text-gray-600 text-md">Discount</div>
                            <div class="text-center text-green-500 text-md font-medium"><span>- ₹</span> {{ pricing | discount }}</div>
                        </div>
                        <div class="flex flex-wrap justify-between items-center mb-3" v-if="pricing && pricing.coupon_discount">
                            <div class="text-gray-600 text-md">Coupon Discount <span v-if="pricing.code">({{ pricing.code }})</span></div>
                            <div class="text-center text-green-500 text-md font-medium"><span>- ₹</span> {{ pricing.coupon_discount }}</div>
                        </div>
                        <div class="flex flex-wrap justify-between items-center mb-3 border-t-2 mx-2 py-2" v-if="pricing && pricing.selling_price">
                            <div class="text-gray-900 text-md">Total </div>
                            <div class="text-center text-md font-medium"><span>₹</span> {{ caluculate_totals(pricing) }}</div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="col-span-4">
                <div class="border border-zinc-200 p-3 bg-white">
                    <div class="border-b border-zinc-200 pb-2">
                        <div class="text-regular text-gray-600">Actions</div>
                    </div>
                    <div class="my-4">
                        <div class="col-span-6">
                            <InputLabel for="status" class="mb-1">Status <span class="text-red-400">*</span></InputLabel>
                            <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="form.status">
                                <option v-for="(status, index) in options.status" :key="index"  :value="index">{{ status }}</option>
                            </select>
                            <InputError class="mt-2" v-if="errors && errors.status" :message="errors.status[0]"/>
                        </div>
                        <div class="col-span-6 mt-4" v-if="!edit && form.status == 6">
                            <InputLabel for="status" class="mb-1">No Of Days <span class="text-red-400">*</span></InputLabel>
                            <TextInput type="text" class="mt-1 block w-full" v-model="form.days" placeholder="No Of Days" :disabled="edit"/>
                            <InputError class="mt-2" v-if="errors && errors.days" :message="errors.days[0]"/>
                        </div>
                        <div class="col-span-6 mt-4">
                            <InputLabel for="status" class="mb-1">Agent</InputLabel>
                            <UsersAutocomplete v-model="form.agent_id" :filters="{roles: ['ccagent', 'cclead']}" :data="options.agents" returns="id" label="email" :multiple="false"/>
                            <InputError class="mt-2" v-if="errors && errors.agent_id" :message="errors.agent_id[0]"/>
                        </div>
                    </div>
                    <div class="text-right border-t border-zinc-200">
                        <ButtonRegular size="sm" color="default"  v-on:click="cancel()">Cancel</ButtonRegular>
                        <ButtonRegular size="sm" color="secondary"  v-if="edit" v-on:click="update()">Update</ButtonRegular>
                        <ButtonRegular size="sm" color="secondary" v-if="!edit" v-on:click="store()">Save</ButtonRegular>
                    </div>
                </div>
                <div class="border border-zinc-200 mt-4 bg-white" v-if="edit">
                    <div class="border-b border-zinc-200 bg-zinc-100">
                        <div class="text-regular text-gray-600 p-3">Order Notes</div>
                    </div>
                    <div>
                        <div class="col-span-6">
                            <div class="my-3">
                                <div class="block bg-gray-100 p-2 border border-gray-200 rounded my-2 mx-3" v-for="(note, index) in notes" :key="index">
                                    <div class="text-gray-700 dark:text-gray-400 text-sm">{{ note.note }}</div>
                                    <div class="flow-root mt-3 px-2">
                                       <div class="float-right text-xs text-gray-600">{{ note.created_by }} on {{ note.created_at }}</div>
                                    </div>
                                </div>
                            </div>
                            <p class="font-sm text-gray-700 dark:text-gray-400 p-2" v-if="!notes.length">No Data Avaiable</p>
                            <div v-if="edit" class="border-t p-3">
                                <div>
                                    <InputLabel for="ordernote">Add Note</InputLabel>
                                    <TextArea
                                        id="ordernote"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="note"
                                        required
                                        autofocus
                                        autocomplete="ordernote"
                                    />
                                    <InputError class="mt-2" v-if="errors && errors.note" :message="errors.note[0]" />
                                </div>
                                <div class="text-right border-t border-zinc-200">
                                    <ButtonRegular size="sm" color="primary" v-on:click="add_note()">Add Note</ButtonRegular>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </div>
</template>
<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ButtonRegular from '@/Components/Button.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import TextArea from '@/Components/TextArea.vue';
import UsersAutocomplete from '@/Components/AutoComplete/Users.vue';
import PackagesAutocomplete from '@/Components/AutoComplete/Packages.vue';
import CoursesAutocomplete from '@/Components/AutoComplete/Courses.vue';
import BatchesAutoComplete from '@/Components/AutoComplete/Batches.vue';
import CouponCode from '../Checkout/form/coupon.vue';

export default{
    props: {
        data: {
            type: Object,
            required: true
        },
        edit: {
            type: Boolean,
            default: false
        },
        order: {
            type: Object,
            required: false
        }
    },
    components:{
        InputError,
        InputLabel,
        TextInput,
        PrimaryButton,
        ButtonRegular,
        ButtonOutline,
        MultiSelect,
        TextArea,
        UsersAutocomplete,
        PackagesAutocomplete,
        CoursesAutocomplete,
        BatchesAutoComplete,
        CouponCode
    },
    data(){
        return{
            errors: '',
            form: this.initialize(),
            options: {
                users: this.data.users,
                packages: this.data.packages,
                courses: this.data.courses,
                batches: this.data.batches,
                status: this.data.orderstatus,
                pricings: [],
                agents: this.data.agents,
            },
            pricing: this.edit ? this.data.pricing : [],
            note: '',
            notes: []
        }
    },
    methods:{
        store(){
            let vm = this;
            axios.post(route('ecommerce.orders.store'), vm.form).then(response => {
                if(response.data.success){
                    vm.$inertia.visit(route('ecommerce.orders.edit', {order: response.data.id}));
                }
                this.$toast.success(response.data.message, {
                    position: 'bottom-right'
                });
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Order', {                        
                    position: 'bottom-right'
                });
            })
        },
        get_notes(){
            let vm = this;
            axios.get(route('ecommerce.orders.notes.index', {order: vm.order.id})).then(response => {
                vm.notes = response.data.data;
            }).catch(error => {

            });
        },
        add_note() {
            let vm = this;
            axios.post(route('ecommerce.orders.notes.add', {order: vm.order.id}), {note: vm.note}).then(response => {
                this.$toast.success(response.data.message, {
                    position: 'bottom-right'
                });
                vm.note = '';
                vm.get_notes();
            }).catch(error => {
                this.$toast.error('Failed to Create Note', {                        
                    position: 'bottom-right'
                });
            })
        },
        update(){
            let vm = this;
            let payload = {
                status: vm.form.status,
                agent_id: vm.form.agent_id
            }
            axios.put(route('ecommerce.orders.update', {order: vm.order.id}), payload).then(response => {
                if(response.data.success){
                    vm.get_notes();
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                this.$toast.error('Failed to Update Order', {                        
                    position: 'bottom-right'
                });
            });
        },
        initialize(){
            return {
                user_id: '',
                agent_id: '',
                package_id: '',
                courses: [],
                status: '',
                cheque: '',
                batches: [],
                days: 0,
            }
        },
        get_pricings(packages) {
            let vm = this;
            axios.get(route('ecommerce.orders.getpricings', {package: packages})).then(response => {
                vm.options.pricings = response.data.data;
            }).catch(error => {

            });
        },
        update_pricing(coupon){
            let vm = this;
            vm.variation = Object.keys(vm.options.pricings).filter(key => {
                const value = vm.options.pricings[key];
                console.log("HREE", value);
                return JSON.stringify(value.sort((a, b) => a - b)) === JSON.stringify(vm.form.courses.sort((a, b) => a - b));
            });
            let payload = {
                coupon: coupon,
                batch: vm.batches,
                trial: 0
            };
            vm.form.package_pricing_id = vm.variation[0];
            axios.post(route('checkout.summary', {variation: vm.variation}), payload).then( (response) => {
                vm.pricing = response.data.data;
            }).catch(error => {

            });
        },
        apply(coupon){
            this.update_pricing(coupon);
        },
        cancel() {
            this.$inertia.visit(route('ecommerce.orders.index'));
        },
        caluculate_totals(pricing){
            return pricing.selling_price - pricing.coupon_discount;
        }
    },
    computed:{
        discount(){
            if(this.pricing){
                return this.pricing.actual_price - this.pricing.selling_price;
            }
            return 0;
        }
    },
    watch: {
        "form.package_id"() {
            if(!this.edit && this.form.package_id){   
                this.form.courses = []; 
                this.form.batches = [];         
                this.get_pricings(this.form.package_id);
            } else if(!this.form.package_id)  {                
                this.form.courses = [];
                this.form.batches = []; 

            }
        },
        "form.courses"(){
            if(this.form.courses && this.form.courses.length){
                if(!this.edit){
                    this.update_pricing();

                }
            }
        }   
    },
    mounted(){
        if (this.edit) {
            this.form = this.order;
            this.get_notes();
        }
    }

}
</script>
