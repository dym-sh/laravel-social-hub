<script setup>
  defineProps({
    image: String,
    title: String,
    description: String,
  })
</script>

<template>
  <div class="mb-3 cursor-pointer hover:bg-gray-100">
    <div class="flex items-center gap-1 p-2">
      <img :src="image" class="w-[32px] rounded-full">
      <div>
        <h3 class="font-black text-lg">{{ title }}</h3>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>