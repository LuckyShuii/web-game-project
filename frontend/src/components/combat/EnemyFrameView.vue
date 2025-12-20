<script setup lang="ts">
import type { Combat } from '@/types/combat.type';
import HealthView from '../HealthView.vue';
import { computed, inject, type Ref } from 'vue';

const combat = inject<Ref<Combat>>('combat');

const enemyHp = computed(() =>
    combat?.value ? combat.value.state.enemy.hp : 0
);
</script>

<template>
    <section id="enemyFrameView" v-if="combat">
        <HealthView
            :health="`${enemyHp}/80`"
            id="healthView"
        />
        <img src="/img/enemy-emerald-princess.png" alt="Enemy Avatar" id="enemyAvatar" />
        <h3 id="enemyName">Enemy Name</h3>
    </section>
</template>

<style scoped>
@import '@/assets/scss/components/combat/EnemyFrameView.scss';
</style>