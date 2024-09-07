<script setup>
import { ref } from 'vue';
import TextInput from '../TextInput.vue';
import FollowingItem from './FollowingItem.vue';

const searchKeyword = ref('');

</script>

<template>
  <TextInput
    :model-value="searchKeyword"
    placeholder="Type to search"
    class="w-full"
    />
  <div class="mt-3 flex-1 overflow-auto">
      <div v-if="false" class="text-gray-400 text-center p-3">
          You haven't befriended anyone yet
      </div>
      <div v-else>
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/men/75.jpg"
              title="John Doe"
              />
          <FollowingItem
              image="https://randomuser.me/api/portraits/thumb/women/75.jpg"
              title="Alice of Bob"
              />
      </div>
  </div>
</template>

<style scoped>
</style>