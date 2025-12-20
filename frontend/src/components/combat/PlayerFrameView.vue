<script setup lang="ts">
import type { Combat } from '@/types/combat.type';
import HealthView from '../HealthView.vue';
import { computed, inject, type Ref } from 'vue';

const combat = inject<Ref<Combat>>('combat');

const playerHp = computed(() =>
    combat?.value ? combat.value.state.player.hp : 0
);
</script>

<template>
    <section id="playerFrameView" v-if="combat">
        <HealthView
            :health="`${playerHp}/100`"
            id="healthView"
        />
        <img src="/img/player.png" alt="Player Avatar" id="playerAvatar" />
        <h3 id="playerName">Player Name</h3>
    </section>
</template>

<style scoped>
@import '@/assets/scss/components/combat/PlayerFrameView.scss';
</style>