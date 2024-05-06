<!-- <script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const getRouteLabel = (routeName) => {
  // Implement a method to return the appropriate label for the route
};

const breadcrumbs = computed(() => {
  return route.matched.map(match => ({
    label: getRouteLabel(match.name),
    route: { name: match.name, params: route.params },
  }));
});
</script>

<template>
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li v-for="(breadcrumb, index) in breadcrumbs" :key="index">
        <router-link :to="breadcrumb.route">
          {{ breadcrumb.label }}
        </router-link>
      </li>
    </ul>
  </nav>
</template> -->

<!-- <template>
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li v-for="(item, index) in items" :key="index">
        <router-link :to="item.url">{{ item.label }}</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    items: Array, // Array of breadcrumb items, each having 'label' and 'url'
  },
};
</script> -->
<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  items: Array, // Array of breadcrumb items, each having 'name' and 'path'
});
</script>

<template>
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li v-for="(item, index) in items" :key="index">
        <a :href="item.path" :class="item.active">{{ item.name }}</a>
      </li>
    </ul>
  </nav>
</template>