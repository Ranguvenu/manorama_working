<template>
  <div>
    <div class="text-zinc-800 text-base font-semibold mb-2">{{ data.title }}</div>
    <div class="ck-content" v-html="computedContent"></div>
    <div v-if="showSeeMore" class="text-blue-800 text-base font-medium" @click="toggleContent">
      <a href="javascript:void(0)">{{ showAllContent ? data.readless_text : data.readmore_text }}</a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      maxwords: this.data.cutoff,
      showAllContent: false,
    };
  },
  methods: {
    toggleContent() {
      this.showAllContent = !this.showAllContent;
    },
  },
  computed: {
    computedContent() {
      const words = this.data.description.split(' ');
      if (this.showAllContent) {
        return this.data.description;
      } else {
        return words.slice(0, this.maxwords).join(' ');
      }
    },
    showSeeMore() {
      const words = this.data.description.split(' ');
      return words.length > this.maxwords;
    },
  },
  watch: {
    data: {
      handler(newValue) {
        this.maxwords = newValue.cutoff;
        if (this.showAllContent) {
          this.showAllContent = words.length > this.maxwords;
        }
      },
      deep: true,
    },
  },
};
</script>
