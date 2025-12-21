<script setup lang="ts">
import type { Combat } from '@/types/combat.type'
import { computed, onMounted, onUnmounted, inject, ref, watch, type Ref } from 'vue'

const combat = inject<Ref<Combat | null>>('combat')

if (!combat) {
    throw new Error('combat not provided')
}

const props = defineProps<{
  initialTime?: number
}>()

const time = ref(props.initialTime ?? 0)
const intervalId = ref<number | null>(null)

const clock = computed(() => {
  const hours = Math.floor(time.value / 3600).toString().padStart(2, '0')
  const minutes = Math.floor((time.value % 3600) / 60).toString().padStart(2, '0')
  const seconds = (time.value % 60).toString().padStart(2, '0')

  return `${hours === '00' ? '' : hours + ':'}${minutes}:${seconds}`
})

const startTimer = () => {
  if (intervalId.value !== null) return

  intervalId.value = globalThis.setInterval(() => {
    time.value += 1
  }, 1000)
}

const stopTimer = () => {
  if (intervalId.value !== null) {
    clearInterval(intervalId.value)
    intervalId.value = null
  }
}

onMounted(() => {
  startTimer()
})

onUnmounted(() => {
  stopTimer()
})

watch(
  () => combat.value?.status,
  (status) => {
    if (status !== 'IN_PROGRESS') {
      stopTimer()
    }
  }
)
</script>


<template>
  <div id="timerView">
    <p id="timerClock">{{ clock }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/scss/components/TimerView.scss';
</style>