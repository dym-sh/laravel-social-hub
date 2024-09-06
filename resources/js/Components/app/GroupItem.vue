<script setup>
  defineProps({
    image: String,
    title: String,
    description: String,
  })
</script>

<template>
  <div class="flex items-start gap-3 cursor-pointer hover:bg-gray-100">
    <img :src="image" class="w-[48px] rounded-full">
    <div>
        <h3 class="font-black text-xl">{{ title }}</h3>
        <div class="text-xs text-gray-500">{{ description }}</div>
    </div>
  </div>
</template>

<style scoped>
</style>