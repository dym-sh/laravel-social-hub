<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'

defineProps({
  content: String,
  contentClass: String,
})

</script>

<template>

  <Disclosure v-slot="{ open }">
    <div v-if="!open"
      class="ck-content-output"
      v-html="content.substring(0, 100)"
      :class="contentClass"
      ></div>

    <template v-if="content && content.length >= 200">
      <DisclosurePanel>
        <div
          class="ck-content-output"
          v-html="content"
          :class="contentClass"
          ></div>

      </DisclosurePanel>
      <div class="flex justify-end">
        <DisclosureButton>
          <span class="text-blue-400 hover:underline">{{ open ? 'Read less' : 'Read more' }}</span>
        </DisclosureButton>
      </div>
    </template>
  </Disclosure>

</template>