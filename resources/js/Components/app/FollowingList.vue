<script setup>
import { Disclosure,DisclosureButton,DisclosurePanel } from '@headlessui/vue';

import FollowingListItems from './FollowingListItems.vue';

</script>

<template>
  <div class="px-3 bg-white rounded border h-full py-3 overflow-hidden ">
    <div class="block lg:hidden">
      <Disclosure v-slot="{ open }">
        <DisclosureButton class="w-full flex justify-between items-center">
          <h2 class="text-xl font-bold px-3">My Followings</h2>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 transition-all"
          :class="open ? 'rotate-90 transform' : ''">
            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
          </svg>
          </DisclosureButton>
        <DisclosurePanel class="px-4 pb-2 pt-4">
          <FollowingListItems />
        </DisclosurePanel>
      </Disclosure>
    </div>
    <div class="h-full flex-col overflow-hidden lg:flex hidden">
      <h2 class="text-xl font-bold px-3">My Followings</h2>
      <FollowingListItems />
    </div>
  </div>
</template>

<style scoped>
</style>