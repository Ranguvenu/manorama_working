<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3">
            <div class="sm:col-span-4">
                <MultiSelect
                    v-model="filters.package"
                    placeholder="Packages"
                    returns="id"
                    :options="data.packages"
                    label="title"
                    :multiple="false"
                    />
            </div>
            <div class="sm:col-span-4">
                <DateRangePicker v-model="filters.date"/>
            </div>
            <div class="sm:col-span-4">
                <select
                    style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                    id="status"
                    class="mt-1 block w-full border-0.5"
                    v-model="filters.status"
                    >
                    <option value="">Select Status</option>
                    <option v-for="(status,index) in data.status" :value = index >{{ status }}</option>
                </select>
            </div>
            <div class="sm:col-span-4">
                <UsersAutocomplete v-model="filters.agent" placeholder="Type to Search Agents" :filters="{roles: ['ccagent', 'cclead']}" :data="data.agents" returns="id" label="email" :multiple="false"/>
            </div>
            <div class="filter-submit sm:col-span-4">
                <Button size="sm" color="primary" v-on:click="$emit('filter')"
                    >Filter</Button
                    >
                <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')"
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
            data: {
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
