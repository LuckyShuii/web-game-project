<script setup lang="ts">
import HealthView from '../HealthView.vue';

</script>

<template>
    <section id="enemyFrameView">
        <HealthView :health="'12/48'" id="healthView" />
        <img src="/img/enemy-emerald-princess.png" alt="Enemy Avatar" id="enemyAvatar" />
        <h3 id="enemyName">Emerald Princess</h3>
    </section>
</template>

<style scoped>
@import '@/assets/scss/components/combat/EnemyFrameView.scss';
</style>