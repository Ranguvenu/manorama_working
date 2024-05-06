<template>
    <div class="w-full">
        <div>
            <ol class="flex items-center justify-between stepslist">
                <li class="flex w-full items-center justify-center steps-listitem stepcurrent relative"
                    v-for="(step, index) in steps" :key="index" v-on:click="switch_tab(step.slug)"
                    :class="{ 'cursor-not-allowed': (!edit && step.slug != 'package'), 'cursor-pointer': !(!edit && step.slug != 'package') }">
                    <div class="flex flex-col items-center relative z-[1]">
                        <div class="flex items-center stepcount justify-center w-10 h-10 rounded-full bg-gray-300"
                            :class="{ 'text-white bg-blue': (step.stage <= stage) }">
                            {{ index + 1 }}</div>
                        <div class="flex text-blue steplabel mt-3">
                            {{ step.label }}
                        </div>
                    </div>
                    <div class="border-t-4 border-gray-100 flex-1 connectline absolute w-full top-[19px] left-[50%]" :class="{ 'border-limegreen': (step.stage < stage) }"></div>
                </li>
            </ol>
        </div>
        <div>
            <component v-bind:is="current" :edit="edit" :data="data" :packagedata="package" @switch="switch_tab" />
        </div>
    </div>
</template>
<script>
import CreatePackageForm from './package.vue';
import PackageBatches from "./batches/index.vue";
import PackagePricing from './pricing/index.vue';
import MarketingPage from './marketing.vue';
export default {
    components: {
        "package": CreatePackageForm,
        "batch": PackageBatches,
        "pricing": PackagePricing,
        "marketing": MarketingPage
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        edit: {
            type: Boolean,
            required: true
        },
        active: {
            type: String,
            required: true
        },
        package: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            steps: [
                {
                    slug: 'package',
                    label: 'Create Package',
                    active: true,
                    stage: 1
                },
                {
                    slug: 'batch',
                    label: 'Add Batches',
                    active: false,
                    stage: 2
                },
                {
                    slug: 'pricing',
                    label: 'Pricing',
                    active: false,
                    stage: 3
                },
                {
                    slug: 'marketing',
                    label: 'Marketing Page',
                    active: false,
                    stage: 4
                }
            ],
            stage: 1,
            current: this.active
        }
    },
    methods: {
        switch_tab(tab) {
            if (!this.edit) {
                return;
            }
            if (tab == 'marketing') {
                let url = route('website.pages.components.index', [this.package.page_id]);
                window.open(url, '_blank');
            } else {
                this.current = tab;
                let index = this.steps.findIndex(step => step.slug == tab);
                if(index > -1){
                    this.stage = index+1;
                }
            }
        }
    },
    mounted() {
        if(!this.package.is_paid){
            let index = this.steps.findIndex(step => step.slug == 'pricing');
            if(index > -1){
                this.steps.splice(index, 1);
            }
        }
    }
}
</script>
