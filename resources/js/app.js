import { createApp } from 'vue';
import MobileNavigation from './components/MobileNavigation.vue';

const mobileNavigation = document.querySelector('#mobile-navigation');

if (mobileNavigation) {
    createApp(MobileNavigation).mount(mobileNavigation);
}
