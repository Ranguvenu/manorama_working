<template lang="">
    <div class="p-4 bg-primary/[0.17] rounded-md flex shadow-md m-2">
        <div class="flex items-center justify-between flex-grow-1 w-full">
            <div class="">
                <div class="font-bold text-md">Registrations</div>
                <div class="mt-5 flex justify-between w-full">
                    <div class="pe-3 me-3">
                        <h4 class="text-primary mb-px font-semibold text-lg">{{ data.total }}</h4>
                        <span class="text-xs">Total</span>
                    </div>
                    <div class="border-e border-primary/[0.3] me-4"></div>
                    <div class="pe-4 ms-3">
                        <h4 class="text-primary mb-px font-semibold text-lg">{{ data.active }}</h4>
                        <span class="text-xs">Subscribed</span>
                    </div>

                </div>
            </div>
            <div class="icon p-3 flex-shrink-0 rounded-full flex items-center justify-center w-14 h-14 bg-primary">
                <img src="/images/ds_widget_icons/Registrations.svg" alt="">
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return {
            data: {
                active: '',
                total: ''
            }
        }
    },
    methods:{
        index(){
            let vm = this;
            axios.get(route('reports.registrations')).then( (response) => {
                vm.data = response.data;
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.index();
    }
}
</script>
