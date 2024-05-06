<template>
    <div>
      <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-4">{{ data.title }}</div>
      <div class="flex flex-wrap items-center justify-between">
        <div  class="md:w-1/2 w-full mt-8">
          <div v-for="(accordion, index) in data.accordions" :key="index"
            @click="toggleAccordion(index)"
            role="button"
            :aria-expanded="isOpen[index]"
            :aria-controls="'day' + index + 'collapse'"
            id="services_wrap"
          >
            <div class="bg-neutral-50 rounded-md px-6 mb-2">
              <h2 class="mb-0" :id="'testprep' + index">
                <button
                  class="group relative flex justify-between items-center w-full items-center border-0 py-4 text-lg font-medium text-zinc-800 transition overflow-anchor:none"
                  type="button"
                  :data-te-collapse-init="index"
                  :data-te-target="'#testprepcollapse' + index"
                  :aria-expanded="isOpen[index]"
                  :aria-controls="'testprepcollapse' + index"
                >
                  <div>{{ accordion.heading }}</div>
                  <div class="text-black font-semibold">
                    <ChevronDownIcon :class="{ 'transform rotate-180': isOpen[index] }" class="h-6 w-6 text-black" aria-hidden="true" />
                  </div>
                </button>
              </h2>
              <div
                :id="'testprepcollapse' + index"
                :class="{ 'hidden': !isOpen[index] }"
                :aria-labelledby="'testprep' + index"
                class="!visible"
                data-te-collapse-item
                data-te-collapse-show
                :data-te-parent="'#services_wrap' + index"
              >
                <div class="border-t border-gray-200 text-gray-600 text-base py-4 leading-relaxed">
                  {{accordion.content}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="md:w-1/2"><img :src="data.image" class="md:flex hidden mx-auto" /></div>
      </div>
    </div>
  </template>
  
  <script>
  import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
  import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';
  import { ChevronDownIcon } from '@heroicons/vue/24/solid';
  
  export default {
    props: {
      data: {
        type: Object,
        required: true,
      },
    },
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
      RequestCallbackButton,
      ChevronDownIcon,
    },
    data() {
      const isOpen = Array(this.data.accordions.length).fill(false);
      return {
        isOpen,
      };
    },
    methods: {
      toggleAccordion(index) {
        this.isOpen[index] = !this.isOpen[index];
      },
      toggleExpandAll() {
        const isAllExpanded = this.isOpen.every((accordion) => accordion);
        this.isOpen = this.isOpen.map(() => !isAllExpanded);
      },
    },
    mounted() {},
    computed: {},
  };
  </script>
  
