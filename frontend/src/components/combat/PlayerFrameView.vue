<script setup lang="ts">
import HealthView from '../HealthView.vue';

</script>

<template>
    <section id="playerFrameView">
        <HealthView :health="'45/100'" id="healthView" />
        <img src="/img/player.png" alt="Player Avatar" id="playerAvatar" />
        <h3 id="playerName">Player Name</h3>
    </section>
</template>

<style scoped>
@import '@/assets/scss/components/combat/PlayerFrameView.scss';
</style>