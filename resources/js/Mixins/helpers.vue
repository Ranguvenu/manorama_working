<script>
export default {
    methods:{
        $merge_objects(initial, filled){
            if(typeof filled == 'object' && typeof initial == 'object'){
                Object.keys(initial).forEach((key, value) => {
                    if(filled[key]){
                        initial[key] = filled[key];
                    }else{
                        initial[key] = '';
                    }
                });
                console.log(initial);
                return initial;
            }
            return filled;
        },
        $get_sno(index, currentpage, perpage){
            let page = currentpage - 1;
            return index+(page*perpage);
        },
        $get_error_key(key, value, index){
            return key+"."+index+"."+value;
        }
    }
}
</script>
