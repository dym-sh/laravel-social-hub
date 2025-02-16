<script setup>
import { computed, ref, Teleport, watch } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import PostUserHeader from './PostUserHeader.vue';
import { ArrowUturnLeftIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import { useForm, usePage } from '@inertiajs/vue3';
import { ClassicEditor, Bold, Essentials, Italic, Paragraph } from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
import { PaperClipIcon } from '@heroicons/vue/24/solid';
import { BookmarkIcon } from '@heroicons/vue/24/outline';
import { isImage } from '@/helpers';

const editor = ClassicEditor
const editorConfig = {
  toolbar: {
    items: [
      'bold', 'italic',
      //'heading'
      // , '|', 'link', 'bulletedList', 'numberedList'
      // , '|', 'outdent', 'indent',
      // , '|', 'blockQuote'
    ],
  },
  plugins: [ Bold, Essentials, Italic, Paragraph ],
}

const attachmentExtensions = usePage().props.attachmentExtensions

/** {
 * file: File,
 * url: '',
} */
const attachmentFiles = ref([])
const attachmentErrors = ref([])
const formErrors = ref({})

const computedAttachments = computed(
  () => {
    return [
      ...attachmentFiles.value
      , ...(props.post.attachments || [])
    ]
  }
)

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
  modelValue: Boolean
})

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const showExtensionsText = computed(() => {
  for( let myFile of attachmentFiles.value ) {
    const file = myFile.file
    let parts = file.name.split('.')
    let ext = parts.pop().toLowerCase()

    if(!attachmentExtensions.includes(ext)) {
      return true
    }
  }

  return false
})

const emit = defineEmits(['update:modelValue', 'hide'])

watch(()=>props.post, () => {
    form.body = props.post.body || ''
})

const form = useForm({
  id: null,
  body: '',
  attachments: [],
  deleted_file_ids: [],
  _method: 'POST',
})

function closeModal() {
  show.value = false
  emit('hide')
  resetModal()
}

function resetModal() {
  emit('update:modelValue', false)
  form.reset()
  formErrors.value = {}
  attachmentFiles.value = []
  attachmentErrors.value = []
  if(props.post.attachments) {
    props.post.attachments.forEach(file => {
      file.deleted = false
    });
  }

}

function submit() {
  form.attachments = attachmentFiles.value.map( myFile => myFile.file)
  if( props.post.id ) {
    form._method = 'PUT'
    form.post(route('post.update', props.post.id), {
      preserveScroll: true,
      onSuccess: (res) => {
        closeModal()
      },
      onError: (errors) => {
        processErrors(errors)
      }
    })
  } else {
    form.post(route('post.create'), {
      preserveScroll: true,
      onSuccess: (res) => {
        closeModal()
      },
      onError: (errors) => {
        processErrors(errors)
      }
    })
  }
}

function processErrors(errors) {
  formErrors.value = errors
  for( const key in errors ){
    if( key.includes('.') ) {
      const [, index] = key.split('.')
      attachmentErrors.value[index] = errors[key]
    }
  }
}

async function onAttachmentsChoose( event ) {
  for( const file of event.target.files ) {
    const myFile = {
      file,
      url : await readFile(file)
    }

    attachmentFiles.value.push( myFile )
  }
  event.target.value = null
};

async function readFile(file) {
  return new Promise( (res, rej) => {

      if( isImage(file) ) {
        const reader = new FileReader()
        reader.onload = () => {
          res( reader.result )
        }
        reader.onerror = rej
        reader.readAsDataURL(file)
      } else {
        res(null)
      }

  })
}
function removeFile (myFile) {
  if( myFile.file ) {
    attachmentFiles.value
      = attachmentFiles.value
          .filter( f => f !== myFile )
  } else {
    form.deleted_file_ids.push(myFile.id )
    myFile.deleted = true
  }
}

function undoDelete(myFile) {
  myFile.deleted = false
  form.deleted_file_ids
    = form.deleted_file_ids
      .filter(id => id !== myFile.id )
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
            class="flex min-h-full items-center justify-center p-4 text-center"
          >
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded bg-white text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="px-4 py-2 font-medium leading-6 text-gray-900 bg-gray-100 flex justify-between items-center"
                >
                  {{ post.id ? 'Update post' : 'Create Post' }}
                  <button
                    @click="closeModal"
                    class="h-8 w-8 rounded-full hover:bg-black/5 transition flex items-center justify-center">
                    <XMarkIcon class="size-4"/>
                  </button>
                </DialogTitle>
                <div class="p-4">
                  <PostUserHeader :post="post" :show-time="false" class="mb-4"/>
                  <ckeditor
                    v-model="form.body"
                    :editor="editor"
                    :config="editorConfig"
                  />

                  <div v-if="showExtensionsText"
                    class="border-l-4 border-amber-500 py-2 px-3 bg-amber-100 mt-3 text-gray-800">
                    Files must be one of the following extensions:<br>
                    <small>{{attachmentExtensions.join(', ')}}</small>
                  </div>

                  <div v-if="formErrors.attachments"
                    class="border-l-4 border-red-500 py-2 px-3 bg-red-100 mt-3 text-gray-800">
                    {{formErrors.attachments}}
                  </div>

                  <div class="grid gap-3 my-3" :class="[
                      1 === computedAttachments.length
                      ? 'grid-cols-1'
                      : 'grid-cols-2'
                    ]">
                    <div v-for="(myFile, ind) of computedAttachments">
                      <div
                        class="group bg-blue-100 aspect-square flex flex-col items-center justify-center text-center text-gray-500 relative border-2"
                        :class="attachmentErrors[ind] ? 'border-red-500' : ''">

                        <div v-if="myFile.deleted" class="z-10 absolute left-0 bottom-0 right-0 py-2 px-3 text-sm bg-black text-white flex items-center justify-between">
                          To be deleted
                          <ArrowUturnLeftIcon
                            @click="undoDelete(myFile)"
                            class="size-4 cursor-pointer "
                            />
                        </div>

                        <button
                          @click="removeFile(myFile)"
                          class="absolute z-20 right-3 top-3 bg-black/30 w-7 h-7 flex items-center justify-center text-white rounded-full hover:bg-black/40">
                          <XMarkIcon class="size-5" />
                        </button>

                        <img v-if="isImage(myFile.file || myFile)" :src="myFile.url"
                        class="object-contain aspect-square"
                          :class="myFile.deleted ? 'opacity-50' : '' ">

                        <div v-else class="flex flex-col justify-center items-center gap-3 p-3"
                          :class="myFile.deleted ? 'opacity-50' : '' ">
                          <PaperClipIcon class="w-10 h-10"/>
                          <small class="w-[200px] break-words ">
                            {{ (myFile.file || myFile).name }}
                          </small>
                        </div>

                      </div>
                      <small class="text-red-500">
                        {{attachmentErrors[ind]}}
                      </small>
                    </div>

                  </div>


                </div>

                <div class="py-2 px-4 flex justify-between">
                  <button
                    type="button"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 flex gap-2 items-center justify-center relative"
                  >
                    <PaperClipIcon class="size-4"/>
                    Attach files
                    <input @click.stop
                      @change="onAttachmentsChoose"
                      type="file" multiple class="absolute top-0 bottom-0 left-0 right-0 opacity-0">
                  </button>
                  <button
                    type="button"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 flex gap-2 items-center justify-center"
                    @click="submit"
                  >
                    <BookmarkIcon class="size-4"/>
                    Submit
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </Teleport>
</template>
