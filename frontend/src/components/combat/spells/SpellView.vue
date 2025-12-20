<script setup lang="ts">
const props = defineProps<{
    spell: {
        name: string;
        code: string;
        cost: number;
    };
}>();
</script>

<template>
    <div class="spellView" :style="{ backgroundImage: `url('/img/spells/${props.spell.code}/${props.spell.code}.png')` }">
        <div class="blur"></div>
        <small class="spellCost">{{ props.spell.cost }}</small>
        <p>{{ props.spell.name }}</p>
    </div>
</template>

<style >
@import '@/assets/scss/components/combat/spells/player/SpellView.scss';
</style>