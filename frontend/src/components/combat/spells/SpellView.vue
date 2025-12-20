<script setup lang="ts">
import { inject } from 'vue';

const props = defineProps<{
    spell: {
        name: string;
        code: string;
        cost: number;
    };
}>();

const actions = inject<{
    castSpell: (spellCode: string) => void;
}>('actions');
</script>

<template>
    <div class="spellView" :style="{ backgroundImage: `url('/img/spells/${props.spell.code}/${props.spell.code}.png')` }"
        @click="actions?.castSpell(props.spell.code)">
        <div class="blur"></div>
        <small class="spellCost">{{ props.spell.cost }}</small>
        <p>{{ props.spell.name }}</p>
    </div>
</template>

<style >
@import '@/assets/scss/components/combat/spells/player/SpellView.scss';
</style>