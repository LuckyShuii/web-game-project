<script setup lang="ts">
import EnemyFrameView from '@/components/combat/EnemyFrameView.vue';
import PlayerFrameView from '@/components/combat/PlayerFrameView.vue';
import TimerView from '@/components/TimerView.vue';

</script>

<template>
  <div id="combatView">
    <div class="background-layer"></div>
    <div class="blur-layer"></div>

    <div class="uiLayer">
      <TimerView />
      <PlayerFrameView />
      <EnemyFrameView />
    </div>
  </div>
</template>


<style scoped>
@import '@/assets/scss/pages/CombatView.scss';
</style>