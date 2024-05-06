<template>
    <a href="javascript:void(0)" v-on:click="scroll_to">{{ label }}</a>
</template>
<script>
export default{
    props:{
        label:{
            type: String,
            default: 'View More'
        },
        tab: {
            type: String,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{
        scroll_to(){
            // let container = document.getElementById(this.tab);
            // if(container){
            //     container.scrollIntoView({ behavior: "smooth" });
            // }
            var element = document.getElementById(this.tab);
            if(element){
                var headerOffset = 90;
                var elementPosition = element.getBoundingClientRect().top;
                var offsetPosition = element.offsetTop - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        }
    },
    mounted(){

    }
}
</script>
