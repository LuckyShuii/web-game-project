<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps<{
  initialTime?: number
}>()


const time = ref(props.initialTime ?? 0)
const clock = computed(() => {
  const hours = Math.floor(time.value / 3600).toString().padStart(2, '0')
  const minutes = Math.floor((time.value % 3600) / 60).toString().padStart(2, '0')
  const seconds = (time.value % 60).toString().padStart(2, '0')
  return `${hours == '00' ? '' : hours + ':'}${minutes}:${seconds}`
})

onMounted(() => {
  const timer = setInterval(() => {
    time.value += 1
  }, 1000)

  onUnmounted(() => {
    clearInterval(timer)
  })
})
</script>

<template>
  <div id="timerView">
    <p id="timerClock">{{ clock }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/scss/components/TimerView.scss';
</style>