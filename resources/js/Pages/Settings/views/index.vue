<template>
    <div class="grid grid-cols-2 gap-x-0 gap-y-0 sm:grid-cols-12 h-full">
        <div class="sm:col-span-3 bg-gray-200">
            <ul class="flex list-none flex-col flex-wrap pl-0">
                <li role="presentation" class="flex-grow text-left" v-for="(setting, index) in settings">
                    <a href="javascript:void(0)"
                        v-on:click="switch_tab(setting)"
                        class="block border-x-0 border-t-0 border-transparent px-3 py-4 leading-tight text-neutral-500"
                        :class="{'border-l-4 border-primary bg-white' : (active.slug === setting.slug)}"
                        >{{setting.name}}</a>
                </li>
            </ul>
        </div>
        <div class="sm:col-span-9 bg-slate-1 px-5 py-3 h-full">
            <component v-bind:is="active.slug" :errors = "errors" :settings="get_settings(active.category)" @get-settings="create(active.category)" @save-settings="store"></component>
        </div>
    </div>
</template>
<script>
import SSOSettings from '../components/sso/index.vue';
import EmailSettings from '../components/email/index.vue';
import SMSSettings from '../components/sms/index.vue';
import PaymentGatewaySettings from '../components/paymentgateway/index.vue';
import ThemeSettings from '../components/theme/index.vue';
import Footer from '../components/footer/index.vue';
import MenuSettings from '../components/menu/index.vue';
import BlogSidebar from '../components/sidebar/index.vue';
import Links from '../components/links/index.vue';
export default{
    components:{
        'ssosettings': SSOSettings,
        'emailsettings': EmailSettings,
        'smssettings': SMSSettings,
        'paymentgatewaysettings' : PaymentGatewaySettings,
        'themesettings': ThemeSettings,
        'menusettings': MenuSettings,
        'theme_footer': Footer,
        'blogsidebar': BlogSidebar,
        'links': Links
    },
    data(){
        return{
            active: {},
            settings: [
                {
                    name: 'SSO Settings',
                    slug: 'ssosettings',
                    category: 'lms_sso_settings'
                },
                {
                    name: 'Theme Settings',
                    slug: 'themesettings',
                    category: 'theme_settings'
                },
                {
                    name: 'Email Settings',
                    slug: 'emailsettings',
                    category: 'email_smtp_settings'
                },
                {
                    name: 'SMS Settings',
                    slug: 'smssettings',
                    category: 'sms_settings'
                },
                {
                    name: 'SAP Settings',
                    slug: 'sapsettings',
                    category: 'sap_settings'
                },
                {
                    name: 'Payment Gateway Settings',
                    slug: 'paymentgatewaysettings',
                    category: 'paymentgateway_settings'
                },
                {
                    name: 'Menu Settings',
                    slug: 'menusettings',
                    category: 'menu_settings'
                },
                {
                    name: 'Blog Sidebar',
                    slug: 'blogsidebar',
                    category: 'blog_sidebar'
                },
                {
                    name: 'Links',
                    slug: 'links',
                    category: 'links'
                },
                {
                    name: 'Footer',
                    slug: 'theme_footer',
                    category: 'theme_footer'
                }
            ],
            data: {

            },
            errors: [],
        }
    },
    methods:{
        switch_tab(setting){
            this.active = setting;
        },
        store(category, settings){
            let vm = this;
            let payload = {};
           
            payload['category'] = category;
            payload['configuration'] = settings;
            axios.post(route('settings.store'), payload).then(response => {
                vm.errors =  [];
                this.$toast.success(response.data.message, {                        
                            position: 'bottom-right'     
                    });
            }).catch(error => {               
                 vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Save Settings', {                        
                        position: 'bottom-right'                   
                    });
                
            });
        },
        create(category){
            let vm = this;
            let payload = {};
            payload['category'] = category;
            axios.post(route('settings.create'), payload).then(response => {
                vm.data[category] = response.data.data;
            }).catch(error => {

            });
        },
        get_settings(category){
            if(this.data && this.data[category]){
                return this.data[category];
            }
            return {};
        }
    },
    mounted(){
        this.active = this.settings[0];
    }
}
</script>
