<script setup>
import { ref } from 'vue';
import TextInput from '../TextInput.vue';
import GroupItem from './GroupItem.vue';

const searchKeyword = ref('');

</script>

<template>
  <TextInput
    :model-value="searchKeyword"
    placeholder="Type to search"
    class="w-full mt-4"
    />
  <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
      <div v-if="false" class="text-gray-400 text-center p-3">
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
</template>

<style scoped>
</style>