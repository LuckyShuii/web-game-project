<script setup lang="ts">
import EnemyFrameView from '@/components/combat/EnemyFrameView.vue';
import PlayerFrameView from '@/components/combat/PlayerFrameView.vue';
import SpellsFrameView from '@/components/combat/spells/SpellsFrameView.vue';
import TimerView from '@/components/TimerView.vue';
import API from '@/services/API';
import type { Combat } from '@/types/combat.type';
import { onMounted, ref, provide } from 'vue';

const combat = ref<Combat | null>(null);

const actions = {
    castSpell(spellCode: string) {
        castSpell(spellCode);
    },
};

const castSpell = async (spellCode: string) => {
  if (!combat.value) {
    console.error('No active combat to cast spell in.');
    return;
  }

  const combatId = combat.value.id as string;

  if (!combatId) {
    console.error('Invalid combat ID.');
    return;
  }

  try {
    const response = (await API.combat.attackCombat(combatId, spellCode)).data;
    combat.value = response.combat;
  } catch (error) {
    console.error('Error casting spell:', error);
  }
};

const startCombat = async () => {
  try {
    const response = (await API.combat.startCombat()).data;
    combat.value = response.combat;
  } catch (error) {
    console.error('Error starting combat:', error);
  }
};

provide('combat', combat);
provide('actions', actions);

onMounted(async () => {
  await startCombat();
})
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