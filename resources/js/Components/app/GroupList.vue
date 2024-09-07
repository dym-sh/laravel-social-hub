<script setup>
import { ref } from 'vue';
import TextInput from '../TextInput.vue';
import GroupItem from './GroupItem.vue';

const searchKeyword = ref('');

</script>

<template>
  <div class="px-3">
    <h2 class="text-2xl font-bold px-3 mb-4">My Groups</h2>
    <TextInput
      :model-value="searchKeyword"
      placeholder="Type to search"
      />
    <div class="px-3 py-8">
        <div v-if="false" class="text-gray-400 flex text-center">
            You haven't joined any group
        </div>
        <div v-else>
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developers"
                description="group for a PHP framework"
                />
            <GroupItem
                image="https://picsum.photos/100"
                title="Vue.js Developers"
                description="group for a JS framework"
                />
        </div>
    </div>
  </div>
</template>

<style scoped>
</style>