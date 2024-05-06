<template>
    <div class="filters-wrapper relative p-6 mt-2 rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3">
            <div class="sm:col-span-4">
                <DateRangePicker v-model="filters.date"/>
            </div>
            <div class="sm:col-span-4">
                <select
                    style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                    id="send_sms_via"
                    class="mt-1 block w-full border-0.5"
                    v-model="filters.status">
                    <option value="">Select Status</option>
                    <option value="0">Received</option>
                    <option value="2">Assigned</option>
                    <option value="3">Pending</option>
                    <option value="4">Subscribed</option>
                    <option value="1">Disqualified</option>                  
                </select>
            </div>
            <div class="sm:col-span-4">
                <MultiSelect
                    v-model="filters.source"
                    placeholder="Source"
                    returns="id"
                    :options="sources"
                    label="name"
                    :multiple="false"
                />
            </div>
            <div class="sm:col-span-4">
                <MultiSelect
                    v-model="filters.package"
                    placeholder="Associated Products"
                    returns="id"
                    :options="packages"
                    label="title"
                    :multiple="false"
                />
            </div>
            <div class="sm:col-span-4" v-if="$has_capability('view-all-leads')">
                <UsersAutocomplete v-model="filters.agent" placeholder="Type to Search Agents" :filters="{roles: ['ccagent', 'cclead']}" :data="agents" returns="id" label="email" :multiple="false"/>
            </div>
            <div class="filter-submit sm:col-span-8">
                <Button size="sm" color="primary" v-on:click="$emit('filter')"
                    >Filter</Button
                >
                <ButtonOutline
                    size="sm"
                    color="primary"
                    v-on:click="$emit('reset')"
                    >Reset</ButtonOutline
                >
            </div>
        </div>
    </div>
</template>
<script>
import Button from "@/Components/Button.vue";
import ButtonOutline from "@/Components/ButtonOutline.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import "vue-datepicker-ui/lib/vuedatepickerui.css";
import VueDatepickerUi from "vue-datepicker-ui";
import DateRangePicker from '@/Components/DateRangePicker/index.vue';
import UsersAutocomplete from '@/Components/AutoComplete/Users.vue';

export default {
    props: {
        filters: {
            type: Object,
            required: true,
        },
        sources: {
            type: Object,
            required: false,
        },
        packages: {
            type: Object,
            required: false,
        },
        agents: {
            type: Object,
            required: false,
        },
        show: {
            type: Boolean,
            required: true,
        },
    },
    components: {
        Button,
        ButtonOutline,
        MultiSelect,
        DateRangePicker,
        UsersAutocomplete,
    },
    data() {
        return {};
    },
    methods: {
        filter(key, value, emit = true) {
            emit ? this.$emit("filter") : false;
        },
    },
    mounted() {},
};
</script>
