import { createStore } from 'vuex';

const loadState = () => {
    try {
        const serializedState = localStorage.getItem('vuex_state');
        if (serializedState === null) {
            return undefined;
        }
        return JSON.parse(serializedState);
    } catch (error) {
        return undefined;
    }
};

const saveState = (state) => {
    try {
        const serializedState = JSON.stringify(state);
        localStorage.setItem('vuex_state', serializedState);
    } catch (error) {
        // Handle errors while saving state
    }
};

export default createStore({
    state: loadState() || {
        variation: 0,
        navigation: []
    },
    mutations: {
        add_variation(state, variation) {
            state.variation = variation;
            saveState(state);
        },
        remove_variation(state) {
            state.variation = 0;
            saveState(state);
        },
        clear_variations(state) {
            state.variation = 0;
            saveState(state);
        },
        add_navigation(state, navigation){
            state.navigation = navigation;
            saveState(state);
        },
        remove_navigation(state){
            state.navigation = [];
            saveState(state)
        },
        clear_navigation(state){
            state.navigation = [];
            saveState(state);
        }
    },
    actions: {
        add_variation({ commit }, variation) {
            commit('add_variation', variation);
        },
        remove_variation({ commit }, variation) {
            commit('remove_variation', variation);
        },
        clear_variations({ commit }) {
            commit('clear_variations');
        },
        add_navigation({commit}, navigation){
            commit('add_navigation', navigation);
        },
        remove_navigation({commit}, navigation){
            commit('remove_navigation', navigation);
        },
        clear_navigation({commit}, navigation){
            commit('clear_navigation', navigation);
        }
    },
    getters: {
        variation: state => state.variation,
        navigation: state => state.navigation
    },
});
