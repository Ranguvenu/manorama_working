<template>
	<div class="rounded-xl" v-bind:style="get_styles(data)">
		<div class="flex flex-wrap flex-col rounded-[17px] p-6"> 
			<div class="sm:text-center text-left justify-center text-white sm:text-2xl font-semibold leading-[35px] mb-4" :style="{color: data.color}">{{ data.title }}</div>
			<div class="flex flex-wrap items-center sm:items-center sm:justify-center"> 
				<div class="md:w-[383px] w-full mr-3 mb-3">
					<input id="email" v-model=form.email class="w-full bg-white rounded-[3px] text-zinc-800 text-[15px] leading-[35px]" aria-label="Email Address" placeholder="Your email address" required="" type="email">
				</div>
				<div class="mb-3">
					<button class="px-6 font-medium m-0 rounded-0 bg-primary text-white subscribe_btn" v-on:click="store">Subscribe</button>
				</div>
			</div>
			<InputError class="mt-2 flex flex-wrap items-center sm:items-center sm:justify-center" v-if="errors && errors.email" :message="errors.email[0]"/>
		</div>
	</div>
</template>
<script>
import InputError from '@/Components/InputError.vue';
export default {
	props: {
		data: {
			type: Object,
			required: true
		}
	},
	components:{
		InputError
	},
	data() {
		return {
			errors: [],
			form: this.initialize(),
		}
	},
	methods: {
		initialize(){
            return{
                email: '',
            }
        },
		store(){
            let vm = this;
            axios.post(route('newsletter.store'), vm.form).then(response => {
                if(response.data.success){
                    this.$toast.success(response.data.message,{
                        position: 'bottom-right'
                    });
                    this.$emit('refresh');
                    this.form = this.initialize();
                    vm.errors = [];
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
		get_styles(data){
			return {
				...this.background(data)
			};
		},
		background(data){
			let returns = {};
			switch(data.type){
				case 'color':
					returns.backgroundColor = data.background
				break;
				case 'image':
					returns.backgroundImage = 'url(' + encodeURI(data.image) + ')';
				break;
				case 'gradient':
					returns.background = data.gradient;
				break;
				default:
			}
			return returns;
		},
	},
};
</script>
  
