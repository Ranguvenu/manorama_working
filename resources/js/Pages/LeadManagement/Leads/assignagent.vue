<template>
    <Modal :show="show" maxWidth="xl" @close="$emit('hide')">
        <template #header>
            <div class="text-xl font-semibold"><span v-if="interests.agent">Edit</span><span v-else>Assign</span> Agent</div>
        </template>
        <div class="py-5 px-3 mb-10">
            <InputLabel for="source">Assign Agent <span class="text-red-400">*</span></InputLabel>
            <MultiSelect class="mt-2" v-model="agent" returns="id" :options="agents" label="name" :multiple="false"/>
            <InputError class="mt-2" v-if="errors && errors.agent" :message="errors.agent"/>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('hide')">Cancel</ButtonRegular>
                <ButtonRegular size="sm" v-on:click="assign_agent">Save</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

export default{
    components:{
        Modal,
        ButtonRegular,
        MultiSelect,
        InputLabel,
        InputError
    },
    props:{
        interests: {
            type: [Object],
            default: false
        }
    },
    emits: ["hide", "refresh"],
    data(){
        return{
            show: false,
            agent: 0,
            agents: [],
            errors: {}
        }
    },
    methods:{
        create(){
            let vm = this;
            axios.get('/users/role/ccagent').then(response => {
                vm.agents = response.data.data;
            }).catch(error => {

            });
        },
        assign_agent(){
            let vm = this;
            if(!this.agent){
                vm.errors['agent'] = 'Agent is required';
                return;
            }
            axios.get('/leads/marketing/'+this.interests.lead+'/agent/'+this.agent+'/assign') .then(response => {
                vm.$emit('hide');
                vm.$emit('refresh');
            }).catch(error => {

            });
        }
    },
    mounted(){
        this.create();
    },
    watch: {
        "interests.lead"(){
            this.show = this.interests.lead ? true : false,
            this.agent = this.interests.agent;
        },
        agent(){
           this.errors = {};
        }
    }
}
</script>
