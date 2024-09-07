<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'

defineProps({
  post: Object
})

function isImage( attachment ) {
  const mime = attachment.mime.split('/')
  return 'image' === mime[0].toLowerCase()
}
</script>

<template>
  <div class="bg-white border rounded p-4 shadow" >
    <div class="flex items-center gap-2">
      <a href="javascript:void(0)">
        <img
          :src="post.user.avatar"
          class="w-[32px] rounded-full transition-all border-2 hover:border-blue-400"
          >
      </a>
      <div>
        <h4 class="font-bold">
          <a href="javascript:void(0)" class="hover:underline">{{post.user.name}}</a>
          <template v-if="post.group">
            >
            <a href="javascript:void(0)" class="hover:underline">{{post.group.name}}</a>
          </template>
        </h4>
        <small class="text-gray-400">{{post.created_at}}</small>
      </div>
    </div>
    <div class="mb-3">
      <Disclosure v-slot="{ open }">
        <div v-if="!open" v-html="post.body.substring(0, 100)"></div>
        <DisclosurePanel class="px-4 pb-2 pt-4">
          <div v-html="post.body"></div>
        </DisclosurePanel>
        <div class="flex justify-end">
          <DisclosureButton>
            <span class="text-blue-400 hover:underline">{{ open ? 'Read less' : 'Read more' }}</span>
          </DisclosureButton>
        </div>
      </Disclosure>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <template v-for="attachment of post.attachments">
        <div class="bg-blue-100 aspect-square flex flex-col items-center justify-center text-center text-gray-500 relative">
          <button class="w-8 h-8 bg-gray-700 hover:bg-gray-800 rounded flex text-gray-100 items-center justify-center absolute right-2 top-2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
              <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
          </button>

          <img v-if="isImage(attachment)" :src="attachment.url"
          class="object-cover aspect-square">

          <template v-else>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-16 ">
              <path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625Z" />
              <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
            </svg>
            {{ attachment.name }}
        </template>

        </div>
      </template>

    </div>
    <div>
      <button>like</button>
      <button>comment</button>
    </div>
  </div>
</template>

<style scoped>
</style>