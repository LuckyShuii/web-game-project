<script setup lang="ts">
import SpellView from './SpellView.vue';
import { ref } from 'vue';

const spells = ref([
    { name: 'Slash', code: 'slash', cost: 10},
    { name: 'Heavy Strike', code: 'heavy_strike', cost: 15},
    { name: 'Shield Up', code: 'shield_up', cost: 20},
    { name: 'Heal (+10)', code: 'warrior_heal', cost: 25},
]);

const currentMana = ref(75);
const maxMana = ref(100);
</script>

<template>
    <section id="spellsFrameView">
        <div class="manaBarWrapper">
            <progress
                id="manaBar"
                :max="maxMana"
                :value="currentMana"
            ></progress>

            <span class="manaText">
                {{ currentMana }} / {{ maxMana }}
            </span>
        </div>
        <div class="spellRow">
            <SpellView class="spell" :spell="spell" v-for="(spell, index) in spells.slice(0, 2)" :key="index" />
        </div>
        <div class="spellRow">
            <SpellView class="spell" :spell="spell" v-for="(spell, index) in spells.slice(2, 4)" :key="index" />
        </div>
    </section>
</template>

<style scoped>
@import '@/assets/scss/components/combat/spells/player/SpellsFrameView.scss';
</style>