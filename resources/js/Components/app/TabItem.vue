<script setup>
defineProps({
  selected: Boolean,
  text: String,
})
</script>

<template>
  <button
    :class="[
      'py-2.5 px-3 outline-none text-sm',
      selected
        ? 'bg-white text-blue-500 border-b-2 border-blue-500'
        : 'text-gray-700',
    ]"
  >
    {{ text }}
  </button>
</template>