<script setup>
import { ref, computed } from 'vue';
import ProfileDetails from '@/Pages/Profile/profiledetails.vue';
import FollowUpDetails from '@/Pages/Profile/FollowUpDetails.vue';
import CallDetails from '@/Pages/Profile/CallDetails.vue';
import PurchaseInformation from '@/Pages/Profile/PurchaseInformation.vue';
import UpdatePassword from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
const tabs = ['Profile Details', 'Follow-up Details', 'Call Details', 'Purchase Information', 'Update Password'];
const activeTab = ref(tabs[0]);

// Define a computed property to dynamically load the component based on the active tab
const activeTabComponent = computed(() => {
  switch (activeTab.value) {
    case 'Profile Details':
      return ProfileDetails;
    case 'Follow-up Details':
      return FollowUpDetails;
    case 'Call Details':
      return CallDetails;
    case 'Purchase Information':
      return PurchaseInformation;
    case 'Update Password':
      return UpdatePassword;
    default:
      return ProfileDetails; // Default to 'ProfileDetails' component
  }
});

// Function to change the active tab
const changeTab = (tab) => {
  activeTab.value = tab;
};
</script>

<template>
  <div class="profiletabs border-2 border-grey-500 mb-5 mt-10">
    <ul class="profiletabslist flex list-none flex-row flex-wrap border-b-0 pl-0 bg-secondary-light" role="tablist">
      <li
        v-for="(tab, index) in tabs"
        :key="index"
        @click="changeTab(tab)"
        :class="{ active: activeTab === tab }"
        class="profiletabitem"
      >
        <a class="profiletablink block border-b-2 border-transparent px-7 pb-3.5 pt-4 text-sm font-medium leading-tight text-grey-700 hover:isolate hover:border-transparent focus:isolate focus:border-transparent">
            {{ tab }}
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <component :is="activeTabComponent"></component>
    </div>
  </div>
</template>
