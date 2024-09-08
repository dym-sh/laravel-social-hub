<script setup>

import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TabItem from '@/Components/app/TabItem.vue';
import Edit from './Edit.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed } from 'vue';

import { XMarkIcon } from '@heroicons/vue/24/solid'
import { CheckCircleIcon, CameraIcon } from '@heroicons/vue/24/outline'

import { useForm } from '@inertiajs/vue3'

const imagesForm = useForm({
  avatar: null,
  cover: null,
})


const props = defineProps({
  errors: Object,
  mustVerifyEmail: {
      type: Boolean,
  },
  status: {
      type: String,
  },
  success: {
      type: String,
  },
  user: {
    type: Object
  }
});

const showNotification = ref(true)
let coverImageSrc = ref('')
let avatarImageSrc = ref('')

const authUser = usePage().props.auth.user;

const isMyProfile = computed( () => {
  return authUser && authUser.id === props.user.id
})


function onCoverChange(event) {
  imagesForm.cover = event.target.files[0]
  if( imagesForm.cover) {
    const reader = new FileReader()
    reader.onload = () => {
      coverImageSrc.value = reader.result
    }
    reader.readAsDataURL(imagesForm.cover)
  }
}

function onAvatarChange(event) {
  imagesForm.avatar = event.target.files[0]
  if( imagesForm.avatar) {
    const reader = new FileReader()
    reader.onload = () => {
      avatarImageSrc.value = reader.result
    }
    reader.readAsDataURL(imagesForm.avatar)
  }
}


function resetCoverImage(){
  imagesForm.cover = null
  coverImageSrc.value = null
}
function submitCoverImage(){
  console.log(imagesForm.cover)
  imagesForm.post( route('profile.updateImages'), {
    onSuccess: () => {
      resetCoverImage()
      setTimeout( () => {
        showNotification.value = false
      }, 3000 )
    }
  })
}

function resetAvatarImage(){
  imagesForm.avatar = null
  avatarImageSrc.value = null
}
function submitAvatarImage(){
  console.log(imagesForm.avatar)
  imagesForm.post( route('profile.updateImages'), {
    onSuccess: () => {
      resetAvatarImage()
      setTimeout( () => {
        showNotification.value = false
      }, 3000 )
    }
  })
}


</script>

<template>
<AuthenticatedLayout>
  <div class="max-w-[768px] mx-auto h-full overflow-auto">
    <div v-show="showNotification && success"
      class="my-2 py-2 px-3 font-medium text-sm bg-emerald-500 text-white">
      {{ success }}
    </div>
    <div v-if="errors.cover"
      class="my-2 py-2 px-3 font-medium text-sm bg-red-400 text-white">
      {{ errors.cover }}
    </div>
    <div class="relative group bg-white">
      <pre>{{errors}}</pre>
      <img :src="coverImageSrc || user.cover_path || '/img/cover.jpg'"
        class="w-full h-[200px] object-cover">
      <div class="absolute top-2 right-2">
        <button
          v-if="!coverImageSrc"
          class=" bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center opacity-0 group-hover:opacity-100">
          <CameraIcon class="size-3 mr-2" />
          Update cover image
          <input type="file"
            @change="onCoverChange"
            class="absolute left-0 bottom-0 right-0 top-0 opacity-0 cursor-pointer z-2">
        </button>
        <div v-else class="flex gap-2 bg-white p-2  opacity-0 group-hover:opacity-100">
          <button
            @click="resetCoverImage"
            class=" bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center">
            <XMarkIcon class="size-3 mr-2" />
            Cancel
          </button>
          <button
            @click="submitCoverImage"
            class=" bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center">
            <CheckCircleIcon class="size-3 mr-2" />
            Submit
          </button>
        </div>
      </div>
    </div>

    <div class="flex">
      <div class="flex items-center justify-center relative group/avatar -mt-[64px] ml-[48px] w-[128px] h-[128px] rounded-full ">
        <img class="w-full h-full object-cover rounded-full "
        :src="avatarImageSrc || user.avatar_path || '/img/avatar.jpg'">
        <button
          v-if="!avatarImageSrc"
          class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center group-hover/avatar:opacity-100 opacity-0  bg-black/50 text-gray-200 rounded-full">
          <CameraIcon class="size-8" />
          <input type="file"
            @change="onAvatarChange"
            class="absolute left-0 bottom-0 right-0 top-0 opacity-0 cursor-pointer z-2">
        </button>
        <div v-else class="absolute top-1 right-0 flex flex-col gap-2">
          <button
            @click="resetAvatarImage"
            class=" bg-red-500/80 w-7 h-7 flex items-center justify-center text-white rounded-full">
            <XMarkIcon class="size-5" />
          </button>
          <button
            @click="submitAvatarImage"
            class=" bg-emerald-500/80 w-7 h-7 flex items-center justify-center text-white rounded-full">
            <CheckCircleIcon class="size-5" />
          </button>
        </div>
      </div>
      <div class="flex-1 p-4 flex justify-between items-center">
        <h2 class="font-bold text-lg">{{ user.name }}</h2>
      </div>
    </div>


    <div class="border-t-2">
      <TabGroup>
        <TabList class="flex bg-white">
          <Tab v-slot="{ selected }" as="template">
            <TabItem text="Posts" :selected="selected" />
          </Tab>
          <Tab v-slot="{ selected }" as="template">
            <TabItem text="Followers" :selected="selected" />
          </Tab>
          <Tab v-slot="{ selected }" as="template">
            <TabItem text="Followings" :selected="selected" />
          </Tab>
          <Tab v-slot="{ selected }" as="template">
            <TabItem text="Photos" :selected="selected" />
          </Tab>
          <Tab
            v-if="isMyProfile"
            v-slot="{ selected }" as="template">
            <TabItem text="My Profile" :selected="selected" />
          </Tab>
        </TabList>

        <TabPanels class="mt-2">
          <TabPanel class="bg-white p-3 shadow">
            Post content
          </TabPanel>
          <TabPanel class="bg-white p-3 shadow">
            Followers
          </TabPanel>
          <TabPanel class="bg-white p-3 shadow">
            Followings
          </TabPanel>
          <TabPanel class="bg-white p-3 shadow">
            Photos
          </TabPanel>
          <TabPanel
            v-if="isMyProfile">
            <Edit :must-verify-email="mustVerifyEmail"
            :status="status"/>
          </TabPanel>
        </TabPanels>
      </TabGroup>
    </div>

  </div>
</AuthenticatedLayout>
</template>
