<template>
    <div>
        <div :class="'md:text-'+ data.title_alignment">
            <div class="text-zinc-800 text-[22px] font-semibold mb-2">{{ data.title }}</div>
            <div class="text-zinc-600 text-[14px] mb-4">{{data.caption}}</div>
        </div>
        <div v-bind:style="get_styles(data)" :class="get_class(data)">
            <div class="flex flex-col rounded-[11px] mt-2" v-for="(item, index) in data.items">
                <div class="flex flex-wrap items-center md:py-8 py-2 px-6" v-if="index % 2 === 0">
                    <div class="md:w-1/2 md:pr-12">
                        <div class="flex flex-col">
                            <div class="mb-3 ck-content"  v-html="item.description"></div>
                        </div>
                        <div class="text-blue-800 text-md font-medium flex mb-2"  v-if="item && item.viewmore && item.viewmore.url"><a :href="item.viewmore.url">{{item.viewmore.label}}<span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" alt="View All Courses"/></span></a></div>
                    </div>
                    <div class="hidden md:block md:w-1/2 alter_image">
                        <img :src="item.image" class="rounded-xl"/>
                    </div>
                </div>
                <div class="flex flex-wrap items-center py-1 md:px-6" v-if="index % 2 !== 0">
                    <div class="md:w-1/2 md:pr-12">
                            <div class="alter_image"><img :src="item.image" class="rounded-xl"/>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <div class="flex flex-col">
                            <div class="mb-3 ck-content" v-html="item.description"></div>
                        </div>
                        <div class="text-blue-800 text-md font-medium flex mb-2" v-if="item && item.viewmore && item.viewmore.url"><a :href="item.viewmore.url">{{item.viewmore.label}}<span><img v-if="item.viewmore.label" class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" alt="View All Courses"/></span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
	props:{
        data:{
            type: Object,
            required: true
        }
    },
	data() {
	  return {
	  };
	},
	methods: {
        get_styles(data){
			return {
				...this.bg_color(data)
			};
		},
        bg_color(data){
			let returns = {};
			returns.backgroundColor = data.background_color
			return returns;
		},
        get_class(data){
            if(data && data.background_color && (data.background_color != 'rgba(0, 0, 0, 0)')){
                return 'border rounded-lg';
            }
            return '';
        }

	}
  }
</script>
