<script setup>
    import { useStore } from 'vuex'
    const store = useStore();
    let variation = (store && store.getters && store.getters.variation) ? store.getters.variation : [];
    if(variation && variation.price){
        window.location.href = route('checkout.index');
    }else{
        window.location.href = route('integrations.sso.login');
    }
</script>
