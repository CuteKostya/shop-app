import './bootstrap';


import {createApp} from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import CountProductsComponent from "./components/ChangesCountProductsComponent.vue";
import ChangesCountProductsComponent from "./components/ChangesCountProductsComponent.vue";


createApp({
    components: {
        ChangesCountProductsComponent,
        CountProductsComponent,
        ExampleComponent,
    }
}).mount('#app');