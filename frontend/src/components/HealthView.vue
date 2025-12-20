<script lang="ts" setup>
const props = defineProps<{
  health: string;
}>();
</script>

<template>
  <div id="healthView">
    <p id="healthText">{{ props.health }} <span class="health"></span></p>
  </div>
</template>

<style scoped>
@import '@/assets/scss/components/HealthView.scss';
</style>
