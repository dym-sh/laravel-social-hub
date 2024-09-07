<script setup>
import { ref } from 'vue';
import TextInput from '../TextInput.vue';
import FollowingItem from './FollowingItem.vue';

const searchKeyword = ref('');

</script>

<template>
  <div class="px-3">
    <h2 class="text-2xl font-bold px-3 mb-4">My Friends</h2>
    <TextInput
      :model-value="searchKeyword"
      placeholder="Type to search"
      />
    <div class="px-3 py-8">
        <div v-if="false" class="text-gray-400 flex text-center">
            You haven't befriended any one yet
        </div>
        <div v-else>
            <FollowingItem
                image="https://picsum.photos/100"
                title="John Doe"
                />
            <FollowingItem
                image="https://picsum.photos/100"
                title="Alice of Bob"
                />
        </div>
    </div>
  </div>
</template>

<style scoped>
</style>