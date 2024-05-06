<template>
    <div>
        <MarginsComponent v-model="advanced.margins" @change="$emit('advanced-settings', advanced)"/>
        <PaddingsComponent v-model="advanced.padding"  @change="$emit('advanced-settings', advanced)"/>
        <ContentTypeComponent v-model="advanced.type"  @change="$emit('advanced-settings', advanced)"/>
        <BackgroundComponent v-model="advanced.background" @change="$emit('advanced-settings', advanced)"/>
        <ContainerComponent v-model="advanced.container" @change="$emit('advanced-settings', advanced)"/>
    </div>
</template>
<script>
import MarginsComponent from './fields/margins.vue';
import PaddingsComponent from './fields/paddings.vue';
import ContentTypeComponent from './fields/type.vue';
import BackgroundComponent from './fields/background.vue';
import ContainerComponent from './fields/container.vue';
export default{
    components:{
        MarginsComponent,
        PaddingsComponent,
        ContentTypeComponent,
        BackgroundComponent,
        ContainerComponent
    },
    props:{
        data: {
            type: Object,
            required: false
        }
    },
    emits: ['advanced-settings'],
    data(){
        return{
            advanced: this.data
        }
    },
    methods:{
        initialize(){
            return {
                margins: {},
                padding: {},
                type: '',
                background: {},
                container: {}
            }
        }
    },
    mounted(){
        this.advanced = this.data;
        this.$emit('advanced-settings', this.advanced);
    }
}
</script>
