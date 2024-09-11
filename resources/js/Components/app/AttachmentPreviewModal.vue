<script setup>
import { computed } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import { PaperClipIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { isImage } from '@/helpers';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
  attachments: {
    type: Array,
    required: true,
  },
  index: Number,
  modelValue: Boolean,
})

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const currentIndex = computed({
  get: () => props.index,
  set: (value) => emit('update:index', value)
})

const attachment = computed(() => {
  return props.attachments[currentIndex.value]
})

const emit = defineEmits(['update:modelValue', 'update:index', 'hide'])


function closeModal() {
  show.value = false
  emit('hide')
}

function prev() {
  if( 0 === currentIndex.value ) {
    return
  }
  currentIndex.value--
}
function next() {
  if( props.attachments.length-1 === currentIndex.value ) {
    return
  }
  currentIndex.value++
}

</script>


<template>
  <Teleport to="body">
    <TransitionRoot appear :show="show" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-50">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div
            class="h-screen w-screen"
          >
            <TransitionChild
              as="template"
              class="h-full w-full"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full transform overflow-hidden bg-slate-800 text-left align-middle shadow-xl transition-all"
              >
                <button
                  @click="closeModal"
                  class="absolute right-3 top-3 z-30 size-10 rounded-full hover:bg-black/20 transition flex items-center justify-center text-gray-100">
                  <XMarkIcon class="size-6"/>
                </button>
                <div class="p-4 relative group h-full bg-slate-800">
                  <div
                    @click="prev"
                    class="absolute w-16 h-full left-0 bg-black/5 opacity-0 group-hover:opacity-100 text-white items-center justify-center cursor-pointer flex">
                    <ChevronLeftIcon class="w-12"/>
                  </div>
                  <div
                    @click="next"
                    class="absolute w-16 h-full right-0 bg-black/5 opacity-0 group-hover:opacity-100 text-white items-center justify-center cursor-pointer flex">
                    <ChevronRightIcon class="w-12"/>
                  </div>

                  <div class="w-full h-full p-3 flex items-center justify-center">
                    <img v-if="isImage(attachment)"
                      :src="attachment.url"
                      class="max-w-full max-h-full">

                    <div v-else class="p-32 flex flex-col justify-center items-center text-gray-100">
                      <PaperClipIcon class="size-12" />
                      <small>{{ attachment.name }}</small>
                    </div>
                  </div>
                </div>

              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </Teleport>
</template>
