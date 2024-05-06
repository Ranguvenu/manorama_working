<template>
    <div :class="layout_class(data.type, data.container)" :id="layout_id(data.container)">
        <div :style="get_styles(data)" :class="background_class(data.background)">
            <div :class="content_class(data.type)">
                <slot/>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            data: {
                type: Object,
                required: true
            }
        },
        data(){
            return{

            }
        },
        methods:{
            get_styles(data){
                return {
                    ...this.paddings(data.padding),
                    ...this.margins(data.margins),
                    ...this.background(data.background)
                };
            },
            paddings(data){
                return {
                    paddingTop: data.value.top+data.unit,
                    paddingRight: data.value.right+data.unit,
                    paddingBottom: data.value.bottom+data.unit,
                    paddingLeft: data.value.left+data.unit,
                }
            },
            background(data){
                let returns = {};
                switch(data.type){
                    case 'color':
                        returns.backgroundColor = data.value
                    break;
                    case 'image':
                        returns.backgroundImage = 'url("' + data.value + '")';
                    break;
                    case 'gradient':
                        returns.background = data.gradient;
                    break;
                    default:
                }
                return returns;
            },
            margins(data){
                return {
                    marginTop: data.value.top+data.unit,
                    marginRight: data.value.right+data.unit,
                    marginBottom: data.value.bottom+data.unit,
                    marginLeft: data.value.left+data.unit,
                }
            },
            layout_class(data, container = {}){
                let returns = '';
                if(container && container.class){
                    returns = container.class;
                }
                switch(data){
                    case 'fwbg':
                        returns += ' w-full';
                    break;
                    case 'fwcontent':
                        returns += ' w-full';
                    break;
                    case 'container':
                        returns += ' container m-auto';
                    break;
                    default:
                        returns += ' w-full';
                }
                return returns;
            },
            layout_id(container = {}){
                return container.id;
            },
            content_class(data){
                let returns = '';
                switch(data){
                    case 'fwbg':
                        returns = 'md:max-w-screen-2xl md:mx-auto custom_md:max-w-full custom_md:px-4 px-4 md:px-16 pt-4';
                    break;
                    case 'fwcontent':
                        returns = 'w-full'
                    break;
                    case 'container':
                        returns = 'container m-auto';
                    break;
                    default:
                        returns = 'w-full';
                }
                return returns;
            },
            background_class(background){
                if(background.type == 'theme'){
                    return background.class;
                }
            }
        },
        mounted(){

        }
    }
</script>
