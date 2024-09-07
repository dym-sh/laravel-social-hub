<script setup>
import PostItem from './PostItem.vue';

const post1 = {
  user: {
    id: 1,
    name: 'John Smith',
    avatar: 'https://randomuser.me/api/portraits/med/men/79.jpg',
  },
  body: `09:30:30 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x3)
09:30:45 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x4)
09:32:14 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x5)
09:32:38 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x6)
09:33:22 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x7)
09:34:24 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x8)
09:34:46 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x9)
09:35:06 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x10)
09:35:23 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x11)
09:36:10 [vite] full reload resources\views\app.blade.php
09:36:10 [vite] page reload resources/views/app.blade.php
09:36:10 [vite] page reload storage/framework/views/de8d0689ddb6fb9c8be3b28b19204d1b.php
09:37:16 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css
09:37:29 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x2)
09:37:57 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x3)
`,
  group: null,
  attachments: [
    {id:1,
      name:'test1.png',
      url:'https://picsum.photos/1000',
      mime:'image/png',
    },
    {id:2,
      name:'test2.png',
      url:'https://picsum.photos/1000',
      mime:'image/png',
    },
    {id:3,
      name:'my Document.docx',
      url:'#',
      mime:'application/msword',
    },
  ],
  created_at: '2024-01-01 01:01'
}


const post2 = {
  user: {
    id: 1,
    name: 'Jane Doe',
    avatar: 'https://randomuser.me/api/portraits/med/women/50.jpg',
  },
  body: `09:30:30 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x3)
09:30:45 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x4)
09:32:14 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x5)
09:32:38 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x6)
09:33:22 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x7)
09:34:24 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x8)
09:34:46 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x9)
09:35:06 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x10)
09:35:23 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x11)
09:36:10 [vite] full reload resources\views\app.blade.php
09:36:10 [vite] page reload resources/views/app.blade.php
09:36:10 [vite] page reload storage/framework/views/de8d0689ddb6fb9c8be3b28b19204d1b.php
09:37:16 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css
09:37:29 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x2)
09:37:57 [vite] hmr update /resources/js/Components/app/PostItem.vue, /resources/css/app.css (x3)
`,
  group: {
    id:1,
    name:'Laravel Developers'
  },
  created_at: '2024-01-01 01:01'
}
</script>

<template>
  <div class=" h-full overflow-hidden flex flex-col">
    <div class="overflow-auto space-y-4">
      <PostItem :post="post1" />
      <PostItem :post="post2" />
      <PostItem :post="post2" />
      <PostItem :post="post2" />
    </div>
    <div>

    </div>
  </div>
</template>

<style scoped>
</style>