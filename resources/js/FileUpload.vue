<template>
  <div
    @dragenter.prevent="dragActive = true"
    @dragleave.prevent="dragActive = false"
    @dragover.prevent
    @drop.prevent="handleDrop"
    :class="['border-2 border-dashed rounded-lg p-8 text-center transition-colors', dragActive ? 'border-blue-500 bg-blue-50' : 'border-gray-300 hover:border-gray-400']"
  >
    <input ref="inputRef" type="file" :multiple="multiple" :accept="accept" @change="handleChange" class="hidden">

    <div v-if="files.length === 0">
      <svg class="mx-auto w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
      </svg>
      <p class="text-gray-600 mb-2">Drag and drop files here, or</p>
      <button @click="inputRef?.click()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Browse Files</button>
      <p v-if="maxSize" class="text-sm text-gray-500 mt-2">Max file size: {{ formatSize(maxSize) }}</p>
    </div>

    <div v-else class="space-y-3">
      <div v-for="(file, index) in files" :key="index" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <div class="flex-1 min-w-0">
          <p class="font-medium text-gray-900 truncate">{{ file.name }}</p>
          <p class="text-sm text-gray-500">{{ formatSize(file.size) }}</p>
        </div>
        <div v-if="file.progress !== undefined && file.progress < 100" class="w-20">
          <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-blue-600 transition-all" :style="{ width: file.progress + '%' }"></div>
          </div>
        </div>
        <button @click="removeFile(index)" class="p-1 text-gray-400 hover:text-red-500">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
      <button @click="inputRef?.click()" class="text-blue-600 hover:text-blue-800 text-sm">+ Add more files</button>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'SbFileUpload',
  props: {
    modelValue: { type: Array, default: () => [] },
    multiple: { type: Boolean, default: true },
    accept: { type: String, default: '*' },
    maxSize: { type: Number, default: null }
  },
  emits: ['update:modelValue', 'error'],
  setup(props, { emit }) {
    const inputRef = ref(null);
    const dragActive = ref(false);
    const files = ref([]);

    const formatSize = (bytes) => {
      if (bytes === 0) return '0 B';
      const k = 1024;
      const sizes = ['B', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    };

    const validateFile = (file) => {
      if (props.maxSize && file.size > props.maxSize) {
        emit('error', { file, message: `File "${file.name}" exceeds maximum size` });
        return false;
      }
      return true;
    };

    const addFiles = (newFiles) => {
      const validFiles = Array.from(newFiles).filter(validateFile);
      if (props.multiple) {
        files.value = [...files.value, ...validFiles];
      } else {
        files.value = validFiles.slice(0, 1);
      }
      emit('update:modelValue', files.value);
    };

    const handleChange = (e) => { addFiles(e.target.files); e.target.value = ''; };
    const handleDrop = (e) => { dragActive.value = false; addFiles(e.dataTransfer.files); };
    const removeFile = (index) => { files.value.splice(index, 1); emit('update:modelValue', files.value); };

    return { inputRef, dragActive, files, formatSize, handleChange, handleDrop, removeFile };
  }
};
</script>
