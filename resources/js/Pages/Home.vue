<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GroupItem from '@/Components/App/GroupItem.vue';

defineProps({
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Social Hub" />

    <div class="w-full grid grid-cols-12 gap-3">
        <div class="col-span-3 py-6 px-3">
            <h2 class="text-2xl font-bold">My Groups</h2>
            <div class=" py-8">
                <div v-if="false" class="text-gray-400 flex text-center">
                    You haven't joined any group
                </div>
                <div v-else>
                    <GroupItem
                        image="https://picsum.photos/100"
                        title="Laravel Developers"
                        description="group for a php framework"
                        />
                    <GroupItem
                        image="https://picsum.photos/100"
                        title="Vue.js Developers"
                        description="group for a JS framework"
                        />
                </div>
            </div>
        </div>
        <div class="col-span-6">
            Posts
        </div>
        <div class="col-span-3">
            Followers
        </div>
    </div>

</template>
