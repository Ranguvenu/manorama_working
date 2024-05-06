<template>
    <div>
        <Header @show-filters="toggle_filters" @filter="index" :filters="filters" :current="lead" @close="close"
            @refresh="index" :category="category"/>
        <Filters :show="show" :sources="sources" :packages="packages" :agents="agents" :filters="filters" @filter="index" @reset="reset" />
        <TableView class="mt-5" :meta="result.meta" :results="result.data" @edit="edit" @assign-agent="assign_agent"
            @disqualify="disqualify" @undisqualify="undisqualify" @view="view_details" @remove-agent="remove_agent" @set-search="set_search"/>
        <Pagination v-if="result.meta && result.meta.links" :meta="result" @pagechange="index" />
        <AssignAgent :interests="agent" @hide="agent = 0" @refresh="index" />
        <ViewDetails :details="details" :category="category" @hide="details = 0" />
    </div>
</template>
<script>
import Header from './header.vue';
import Pagination from '@/Components/Pagination.vue';
import TableView from './table.vue';
import Filters from '../filters/index.vue';
import AssignAgent from '../assignagent.vue';
import ViewDetails from '../details/index.vue';
export default {
    components: {
        Header,
        Pagination,
        TableView,
        Filters,
        AssignAgent,
        ViewDetails
    },
    props: {
        category: {
            type: Object,
            required: true
        },
        sources: {
            type: Object,
            required: true
        },
        packages: {
            type: Object,
            required: true
        },
        agents: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            filters: this.initialize(),
            show: false,
            result: {
                data: [],
                links: [],
                meta: []
            },
            lead: 0,
            agent: {
                lead: 0,
                agent: 0
            },
            details: 0
        }
    },
    methods: {
        toggle_filters() {
            this.show = !this.show
        },
        initialize() {
            return {
                search: '',
                perpage: 10,
                date: {
                    start: '',
                    end: ''
                },
                status: '',
                source: '',
                package: '',
                agent: '',
            }
        },
        index(page = 1) {
            let vm = this;
            axios.post('/leads/' + vm.category.slug + '/results?page=' + page, vm.filters).then(response => {
                vm.result = response.data;
            }).catch(error => {

            });
        },
        assign_agent(lead, agent) {
            this.agent = {
                lead: lead,
                agent: agent
            };
        },
        remove_agent(lead, agent,agentname){      
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to remove ${agentname} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if (response.value) {
                    axios.patch(route('leads.category.unassign', {category: vm.category.slug, agent: agent, interested: lead})).then(response => {
                        vm.index();
                        vm.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                    }).catch(error => {

                    });
                }
            });           

        },
        view_details(lead) {
            this.details = lead;
        },
        edit(lead) {
            this.lead = lead;
        },
        disqualify(lead) {
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to disqualify ${lead.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if (response.value) {
                    axios.get(route('leads.category.disqualify', { lead: lead.id, category: vm.category.slug })).then(response => {
                        vm.index();
                        vm.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Disqualify Lead', {
                            position: 'bottom-right'
                        });
                    });
                }
            });
        },
        undisqualify(lead) {
            let vm = this;
            vm.$swal({
                title: "",
                text: `Are you sure you want to undisqualify ${lead.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue"
            }).then((response) => {
                if (response.value) {
                    axios.get(route('leads.category.undisqualify', { lead: lead.id, category: vm.category.slug })).then(response => {
                        vm.index();
                        vm.$toast.success(response.data.message, {
                            position: 'bottom-right'
                        });
                    }).catch(error => {
                        this.$toast.error('Failed to Undisqualify Lead', {
                            position: 'bottom-right'
                        });
                    });
                }
            });
        },
        set_search(search){
            this.filters.search = search;
            console.log(this.filters);
            this.index();
        },
        close() {
            this.lead = 0;
        },
        reset() {
            this.filters = this.initialize();
            this.index();
        }
    },
    mounted() {
        this.index();
    }
}
</script>
