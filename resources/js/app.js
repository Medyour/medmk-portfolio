import { createApp } from 'vue';
import MobileNavigation from './components/MobileNavigation.vue';

const mobileNavigation = document.querySelector('#mobile-navigation');

if (mobileNavigation) {
    createApp(MobileNavigation).mount(mobileNavigation);
}

const contactStatus = document.querySelector('[data-contact-status]');

if (contactStatus) {
    contactStatus.focus();
}

const contactForm = document.querySelector('form[action$="/contact"]');

contactForm?.addEventListener('submit', () => {
    const submitButton = contactForm.querySelector('[data-contact-submit]');

    if (submitButton) {
        submitButton.disabled = true;
        submitButton.setAttribute('aria-disabled', 'true');
        submitButton.textContent = 'Envoi…';
    }

    contactForm.setAttribute('aria-busy', 'true');
});
