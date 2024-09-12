<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { PencilIcon, TrashIcon, EllipsisVerticalIcon } from '@heroicons/vue/24/solid'
import { ArrowDownTrayIcon, ChatBubbleLeftRightIcon, HandThumbUpIcon, PaperClipIcon } from '@heroicons/vue/24/outline';
import PostUserHeader from './PostUserHeader.vue';
import { router } from '@inertiajs/vue3';
import { isImage } from '@/helpers';
import axiosClient from '@/axiosClient.js'

const props = defineProps({
  post: Object
})

const emit = defineEmits(['editClick', 'attachmentClick'])

function openEditModal() {
  emit('editClick', props.post)
}

function deletePost() {
  if( window.confirm( 'Are you sure you want to delete this post?' ) ) {
    router.delete( route('post.destroy', props.post), {
      preserveScroll: true
    } )

  }
}

function openAttachment(ind) {
  emit('attachmentClick', props.post, ind)
}

function sendReaction () {
  axiosClient.post( route( 'post.reaction', props.post), {
    reaction: 'like'
  }).then( ({data}) => {
    props.post.current_user_has_reaction
      = data.current_user_has_reaction
    props.post.num_of_reactions
      = data.num_of_reactions
  })
}
</script>

<template>
  <div class="bg-white border rounded p-4 shadow" >
    <div class="flex items-center justify-between mb-3">
      <PostUserHeader :post="post"/>
      <div class="">

        <Menu as="div" class="z-10 relative inline-block text-left">
          <div>
            <MenuButton
              class="h-8 w-8 rounded-full hover:bg-black/5 transition flex items-center justify-center"
            >
              <EllipsisVerticalIcon
                class="size-5"
                />
            </MenuButton>
          </div>

          <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
          >
            <MenuItems
              class="absolute right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
            >
              <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                  <button
                    @click="openEditModal"
                    :class="[
                      active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]"
                  >
                    <PencilIcon
                      :active="active"
                      class="mr-2 h-5 w-5"
                      aria-hidden="true"
                    />
                    Edit
                  </button>
                </MenuItem>

                <MenuItem v-slot="{ active }">
                  <button
                    @click="deletePost"
                    :class="[
                      active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]"
                  >
                    <TrashIcon
                      :active="active"
                      class="mr-2 h-5 w-5"
                      aria-hidden="true"
                    />
                    Delete
                  </button>
                </MenuItem>

              </div>
            </MenuItems>
          </transition>
        </Menu>

      </div>
    </div>
    <div class="mb-3">
      <Disclosure v-slot="{ open }">
        <div v-if="!open" class="ck-content-output" v-html="post.body.substring(0, 100)"></div>
        <template v-if="post.body.length >= 200">
          <DisclosurePanel class="px-4 pb-2 pt-4">
            <div class="ck-content-output" v-html="post.body"></div>
          </DisclosurePanel>
          <div class="flex justify-end">
            <DisclosureButton>
              <span class="text-blue-400 hover:underline">{{ open ? 'Read less' : 'Read more' }}</span>
            </DisclosureButton>
          </div>
        </template>
      </Disclosure>
    </div>
    <div class="grid gap-3 mb-3" :class="[
      1 === post.attachments.length
      ? 'grid-cols-1'
      : 'grid-cols-2'
    ]">
      <template v-for="(attachment, ind) of post.attachments.slice(0, 4)">
        <div
          @click="openAttachment(ind)"
          class="group bg-blue-100 aspect-square flex flex-col items-center justify-center text-center text-gray-500 relative">

          <div v-if="3 === ind && 4 < post.attachments.length" class="absolute top-0 bottom-0 left-0 right-0 z-10 bg-black/60 text-white flex items-center justify-center text-2xl">
            +{{post.attachments.length - 4}} more
          </div>

          <!-- download button -->
          <a @click.stop :href="route('post.download', attachment)" class="z-20 opacity-0 group-hover:opacity-100 transition-all w-8 h-8 bg-gray-700 hover:bg-gray-800 rounded flex text-gray-100 items-center justify-center absolute right-2 top-2 cursor-pointer"
            >
            <ArrowDownTrayIcon class="size-4" />
          </a>

          <img v-if="isImage(attachment)"
          :src="attachment.url"
          class="object-contain aspect-square">

          <div v-else class="flex flex-col justify-center items-center gap-3 p-3">
            <PaperClipIcon class="size-12" />
            <small>{{ attachment.name }}</small>
          </div>

        </div>
      </template>

    </div>
    <div class="flex gap-2 mt-2">
      <button
        @click="sendReaction"
        class="text-gray-800 flex gap-1 items-center py-2 px-4 justify-center  rounded-lg flex-1"
        :class="[
          post.current_user_has_reaction
          ? 'bg-sky-100 hover:bg-sky-200'
          : 'bg-gray-100 hover:bg-gray-200'
        ]">
        <HandThumbUpIcon class="size-4" />
        <span clas="mr-2">{{post.num_of_reactions}}</span>
        {{ post.current_user_has_reaction ? 'Unlike' : 'Like'}}
      </button>
      <button class="text-gray-800 flex gap-1 items-center py-2 px-4 justify-center bg-gray-100 hover:bg-gray-200 rounded-lg flex-1">
        <ChatBubbleLeftRightIcon class="size-4" />
        Comment
      </button>
    </div>
  </div>
</template>

<style scoped>
</style>