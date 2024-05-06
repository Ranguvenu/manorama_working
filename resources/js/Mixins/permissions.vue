<script>
export default {
    methods:{
        $has_capability(permission){
            return this.$page.props.permissions.indexOf(permission) !== -1;
        },
        $has_role(role){
            return this.$page.props.roles.indexOf(role) !== -1;
        },
        $can_show_menu_item(capabilities){
            let count = 0;
            if(capabilities != undefined){
                capabilities.forEach((value, key) => {
                    this.$has_capability(value) ? count++ : count;
                });
            }
            return count ? true : false;
        }
    }
}
</script>
