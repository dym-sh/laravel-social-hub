<script setup>
import { ref } from 'vue';
import InputTextarea from '../InputTextarea.vue';
import { useForm, usePage } from '@inertiajs/vue3'
import PostModal from './PostModal.vue';

const authUser = usePage().props.auth.user
const showModal = ref(false);
const newPost = ref({
  id:null,
  body:'',
  user: authUser,
})


function showCreatePostModal() {
  showModal.value = true
}
</script>

<template>
  <div class="p-4 bg-white rounded-lg border mb-3">
    <div
      @click="showCreatePostModal"
      class="mb-3 w-full py-2 px-3 border-2 border-gray-200 text-gray-600 rounded-md shadow-sm"
    >Click here to create new post</div>
    <!-- <div class="flex gap-2 justify-between">
      <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative"
        type="button">
        Attach files
        <input type="file" class="absolute left-0 right-0 top-0 bottom-0 opacity-0">
      </button>
      <button type="submit"
        @click="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >Submit</button>

      </div> -->
      <PostModal :post="newPost" v-model="showModal" />
  </div>
</template>

<style scoped>
</style>