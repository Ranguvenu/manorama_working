<template>
    <div>
        <div class="bg-white rounded-md border border-stone-300 p-3">
            <div class="flex justify-between items-center ">
                <div class="flex items-center">
                    <div class="w-8"><img  class="me-4" src="/images/coupon.png" alt="Coupon"/></div>
                    <div class="w-100">
                        <input type="text" v-model="code" :disabled="coupon.id" class="border-none border-gray-100 w-full p-1" placeholder="Write Coupon Code">
                    </div>
                </div>
                <div class="mx-2 w-100" v-if="coupon && !coupon.id">
                    <a href="javascript:void(0)" v-on:click="apply" class="bg-white rounded-[3px] border border-rose-500 text-rose-500 text-[13px] py-1 px-8 font-medium">Apply</a>
                </div>
                <div class="mx-2 w-100" v-if="coupon && coupon.id">
                    <a href="javascript:void(0)" v-on:click="remove" class="bg-white rounded-[3px] border border-rose-500 text-rose-500 text-[13px] py-1 px-8 font-medium">Remove</a>
                </div>
            </div>
        </div>
        <div v-if="coupon && coupon.id"> 
            <div class="text-green-800 text-sm mt-2">Coupon Code Applied Successfully</div>
        </div>
        <div v-if="coupon && coupon.error">
            <div class="text-red-800 text-sm mt-2">{{ coupon.message }}</div>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            package: {
                type: Number,
                required: true
            }
        },
        data(){
            return{
                code: '',
                error: [],
                coupon: {
                    
                }
            }
        },
        methods: {
            apply(){
                let vm = this;
                let payload = {
                    coupon: vm.code,
                }
                axios.post(route('checkout.coupon.apply', {package: vm.package}), payload).then((response) => {
                    vm.coupon = response.data;
                    vm.$emit('apply', response.data);
                }).catch(error => {

                });
            },
            remove(){
                let vm = this;
                vm.coupon = {};
                vm.code = '';
                vm.$emit('apply', vm.coupon);
            }
        },
        mounted(){
            
        }
    }
</script>
