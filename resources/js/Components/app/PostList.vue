<script setup>
import { ref } from 'vue';
import PostItem from './PostItem.vue';
import PostModal from './PostModal.vue';
import { usePage } from '@inertiajs/vue3';
import AttachmentPreviewModal from './AttachmentPreviewModal.vue';

defineProps({
  posts: Array
})



const authUser = usePage().props.auth.user
const showEditModal = ref( false )
const showAttachmentsModal = ref( false )
const editPost = ref( {} )
const previewAttachmentsPost = ref( {} )

function openEditModal(post) {
  editPost.value = post
  showEditModal.value = true
}

function onModalHide() {
  editPost.value = {
    id: null,
    body: '',
    user: authUser
  }
}

function openAttachmentPreviewModal(post, index) {
  previewAttachmentsPost.value = {
    post, index
  }
  showAttachmentsModal.value = true
}
</script>

<template>
  <div class="overflow-auto">
    <PostItem
      v-for="post of posts"
      :key="post.id"
      :post="post"
      @editClick="openEditModal"
      @attachmentClick="openAttachmentPreviewModal"
      />

    <PostModal
      :post="editPost"
      v-model="showEditModal"
      @hide="onModalHide"
      />

    <AttachmentPreviewModal
      :attachments="previewAttachmentsPost.post?.attachments || []"
      v-model:index="previewAttachmentsPost.index"
      v-model="showAttachmentsModal"/>
  </div>
</template>

<style scoped>
</style>