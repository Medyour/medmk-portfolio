<script setup>
import { nextTick, ref } from 'vue';

const isOpen = ref(false);
const menu = ref(null);
const trigger = ref(null);

const toggleMenu = async () => {
    isOpen.value = !isOpen.value;

    if (isOpen.value) {
        await nextTick();
        menu.value?.querySelector('a')?.focus();
    }
};

const closeMenu = () => {
    isOpen.value = false;
};

const handleEscape = () => {
    if (!isOpen.value) return;

    closeMenu();
    nextTick(() => trigger.value?.focus());
};
</script>

<template>
    <div class="md:hidden" @keydown.esc="handleEscape">
        <button
            ref="trigger"
            type="button"
            class="inline-flex min-h-11 items-center justify-center rounded-lg border border-slate-300 px-4 text-sm font-semibold text-slate-900 transition hover:border-sky-700 hover:text-sky-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-700"
            aria-controls="mobile-menu"
            :aria-expanded="isOpen"
            @click="toggleMenu"
        >
            {{ isOpen ? 'Fermer' : 'Menu' }}
        </button>

        <nav
            v-if="isOpen"
            id="mobile-menu"
            ref="menu"
            aria-label="Navigation mobile"
            class="absolute inset-x-4 top-[4.5rem] rounded-xl border border-slate-200 bg-white p-3 shadow-lg"
        >
            <a class="mobile-link" href="/#expertises" @click="closeMenu">Expertises</a>
            <a class="mobile-link" href="/#approche" @click="closeMenu">Approche</a>
            <a class="mobile-link" href="/#projets" @click="closeMenu">Projets</a>
            <a class="mobile-link" href="/#a-propos" @click="closeMenu">À propos</a>
            <a class="mobile-link bg-sky-800 text-white hover:bg-sky-900 hover:text-white" href="/#contact" @click="closeMenu">
                Étudier mon besoin
            </a>
        </nav>
    </div>
</template>
