<template>
    <div>
        <Filters :filters="filters"  :data="filter_data" @filter="index"/>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="p-3" :class="{'sm:col-span-8': (current && current.id), 'sm:col-span-12': !(current && current.id)}">
                <MediaList :media="media" :items="items" @selected="selected" @load-more="index"/>
            </div>
            <div class="bg-slate-50 p-3" :class="{'sm:col-span-4': (current && current.id)}" v-if="current && current.id">
                <MediaSettings :data="current" @refresh="index"/>
            </div>
        </div>
    </div>
</template>
<script>
import Filters from "./filters/index.vue";
import MediaList from "./list/index.vue";
import MediaSettings from "./settings.vue";
export default{
    components:{
        Filters,
        MediaList,
        MediaSettings,
    },
    props:{
        component:{
            type: String,
            required: true
        },
        multiple: {
            type: Boolean,
            required: true
        },
        items: {
            type: Array,
            required: true
        },
        accepts: {
            type: String,
            required: false
        }
    },
    data(){
        return{
            media: {
                data: [],
                meta: [],
                links: []
            },
            current: {},
            filter_data: {
                dates: [],
                types: [],
                components: []
            },
            filters: {
                perpage: 25,
                search: '',
                accepts: this.accepts,
                component: -1,
                date: -1,
                type: -1
            }
        }
    },
    methods:{
        index(page = 1){
            let vm = this;
            axios.post("/media/index?page="+page, vm.filters).then(response => {
                if(response.data){
                    if(page == 1){
                        vm.media = response.data;
                    }else{
                        if(response.data.data.length){
                            response.data.data.forEach((value, index) => {
                                vm.media.data.push(value)
                            });
                            vm.media.meta = response.data.meta;
                        }
                    }
                }
            }).catch(error => {

            });
        },
        selected(data){
            this.current = data;
            let index = this.item_exists(this.current)
            if(index > -1){
                this.items.splice(index, 1);
                this.current = {};
            }else{
                if(this.multiple){
                    this.items.push(this.current);
                }else{
                    this.items.length = 0;
                    this.items.push(this.current);
                }
            }
            this.$emit('selected', this.items);
        },
        create(){
            let vm = this;
            let payload = {};
            axios.post('/media/create', payload).then(response => {
                vm.filter_data = response.data.data;
            }).catch(error => {

            });
        },
        item_exists(item){
            let index = this.items.findIndex( x => x.id == item.id);
            return index;
        }
    },
    mounted(){
        this.index();
        this.create();
        if(this.items && this.items.length){
            this.current = this.items[0]; 
        }
    }
}
</script>
