<script setup lang="ts">
import EnemyFrameView from '@/components/combat/EnemyFrameView.vue';
import PlayerFrameView from '@/components/combat/PlayerFrameView.vue';
import SpellsFrameView from '@/components/combat/spells/SpellsFrameView.vue';
import TimerView from '@/components/TimerView.vue';

</script>

<template>
  <div id="combatView">
    <div class="backgroundLayer"></div>
    <div class="blurLayer"></div>

    <div class="uiLayer">
      <TimerView />
      <PlayerFrameView />
      <EnemyFrameView />
      <SpellsFrameView />
    </div>
  </div>
</template>


<style scoped>
@import '@/assets/scss/pages/CombatView.scss';
</style>