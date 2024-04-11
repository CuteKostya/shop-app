import './bootstrap';


import {createApp} from 'vue';
import {createStore} from 'vuex'
import ExampleComponent from './components/ExampleComponent.vue';
import CountProductsComponent from "./components/ChangesCountProductsComponent.vue";
import ChangesCountProductsComponent from "./components/ChangesCountProductsComponent.vue";

const store = createStore({
    state() {
        return {
            countProducts: 0,
        }
    },
    mutations: {
        extracted(state) {
            axios.post('/helper/countProduct', {
                params: {
                    "_token": "{{ csrf_token() }}",
                }
            })
                .then(res => {
                    state.countProducts = res.data['countProducts'];
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // выполняется всегда
                });
        },
    }
});
createApp({
    components: {
        ChangesCountProductsComponent,
        CountProductsComponent,
        ExampleComponent,
    }
}).use(store).mount('#app');
