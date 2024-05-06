<template lang="">
    <div class="m-2 flex items-center flex-col rounded shadow-md bg-white">
        <div class="heading py-3 mx-6 mt-4 mb-2 px-10 flex-grow-1 w-72 justify-center flex rounded-full bg-primary/[0.1] ">
            <span class="text-xs font-medium">Financial (Total/Active)</span>
        </div>
        <div class="content_container w-full mt-2">
            <div class="flex mb-2 justify-start items-center  w-full p-3">
                <div class="icon rounded-md bg-secondary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/financial/Transcations.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Transcations
                </div>
                <div class="w-fit text-secondary me-2 text-sm font-semibold">
                    50/28
                </div>
            </div>
            <div class="flex mb-2 bg-primary/10 justify-start  items-center w-full p-3">
                <div class="icon rounded-md bg-primary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/financial/Orders.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Orders
                </div>
                <div class="w-fit text-primary me-2 text-sm font-semibold">
                    50/28
                </div>
            </div>
            <div class="flex  justify-start items-center w-full  p-3">
                <div class="icon rounded-md bg-secondary/[0.15] w-10 h-10 me-3 p-2">
                    <img src="/images/ds_widget_icons/financial/Tests.svg" alt="">
                </div>
                <div class="grow font-semibold text-sm">
                    Tests
                </div>
                <div class="w-fit text-secondary me-2 text-sm font-semibold">
                    50/28
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>
