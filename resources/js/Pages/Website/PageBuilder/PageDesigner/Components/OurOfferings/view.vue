<template>
  <div>
    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-6">{{ data.title }}</div>
    <div class="tab_wrap">
      <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 tablist" id="resources_tablist"
          data-tabs-toggle="#resources_tablist" :class="{'active' : (active == '')}" role="tablist">
        <template v-for="(category, index) in data.courses" >     
          <li class="mr-2" role="presentation">
            <a href="javascript:void(0)" v-on:click="switch_tab(category)"
                :class="{ 'active': active == tabslug(category.title) }"
                class="inline-block px-4 py-1 bg-white rounded text-gray-600 text-md font-medium" type="button"
                role="tab" :aria-controls="category.title" aria-selected="false">{{ category.title }}</a>
          </li>
        </template>
      </ul>
    </div>
    <div>
      <div class="py-4" role="tabpanel">
        <template v-if="response && response.length">
          <div class="flex flex-wrap items-center">
            <Tab :response="response"/>        
          </div>
          <div v-if="selected && selected.more">
            <div class="text-blue-800 text-md font-semibold flex justify-end mb-6">
              <div class="cursor-pointer" @click="pagination" v-if="selected.more.label && show">{{ selected.more.label }}<span>
                <img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span>
              </div>
            </div>
          </div>
        </template>
        <template v-if="response && !response.length">
          <div class="border border-gray-300 text-center p-3 text-gray-600 w-full" role="button">No Data
            Available</div>
        </template>
      </div>
    </div>
  </div>
</template>
<script>
import Tab from "./tabs/tab.vue";

export default {
  components: {
    Tab
  },
  props: {
    data: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      active: null,
      response: [],
      initialized: false,
      selected: {},
      goal: '',
      limit: '',
      elements: '',
      timeline: '',
      show : true
    };
  },
  methods: {
    index(page = 1, slug = '', element = '') {
      let vm = this;
      console.log(vm.timeline);
      // console.log('sfdkjsafdkdsf');
      let payload = {
        goal: vm.goal ? vm.goal : '',
        limit: vm.elements,
        slug: slug ? slug : '',
        timeline: vm.timeline ? vm.timeline : ''
      };
      axios.post(route('website.components.index', { component: 'our-offerings', page: page }), payload)
        .then((response) => {
            vm.response = response.data.data;
            console.log(vm.response)
            // console.log('dsajasdsad')
            if(vm.elements > vm.response.length){
              this.show = false
            }
        })
        .catch(error => {
        });
    },
    switch_tab(data = null) {
      if (data) {
        this.active = data.title.replace(/\s+/g, '-').toLowerCase();
        this.goal = data.goal;
        this.limit = data.limit;
        this.elements = data.limit;
        this.timeline = data.timeline;
        this.index('', this.active, this.elements);
        this.selected = data;
        this.show = true;
      } else {
        this.active = '';
        this.goal = '';
        this.selected = '';
        this.timeline = '';
        this.index('', '','',  true); 
      }
    },
    tabslug(title) {
      return title.replace(/\s+/g, '-').toLowerCase();
    },
    pagination() {
      this.limit = parseInt(this.limit)
      this.elements = parseInt(this.elements)
      this.elements = this.elements + this.limit;
      this.index('', this.active, this.elements);
    }
  },
    mounted() {
        this.switch_tab(this.data.courses[0]);
    }
};
</script>
