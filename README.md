# File Upload

A drag-and-drop file upload component for Laravel applications. Supports multiple files, size validation, and progress display. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/file-upload
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-file-upload wire:model="files" />
```

### Single File

```blade
<livewire:sb-file-upload
    wire:model="document"
    :multiple="false"
/>
```

### With Validation

```blade
<livewire:sb-file-upload
    wire:model="images"
    accept="image/*"
    :max-size="5242880"
/>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | array | `[]` | Selected files |
| `multiple` | boolean | `true` | Allow multiple files |
| `accept` | string | `'*'` | Accepted file types |
| `max-size` | number | `null` | Max file size in bytes |

## Vue 3 Usage

### Setup

```javascript
import { SbFileUpload } from './vendor/sb-file-upload';
app.component('SbFileUpload', SbFileUpload);
```

### Basic Usage

```vue
<template>
  <SbFileUpload v-model="files" />
</template>

<script setup>
import { ref } from 'vue';
const files = ref([]);
</script>
```

### Image Upload

```vue
<template>
  <SbFileUpload
    v-model="images"
    accept="image/*"
    :max-size="5 * 1024 * 1024"
    @error="handleError"
  />
</template>

<script setup>
import { ref } from 'vue';

const images = ref([]);

const handleError = ({ file, message }) => {
  alert(message);
};
</script>
```

### Document Upload

```vue
<template>
  <div class="space-y-4">
    <label class="block text-sm font-medium">Upload Documents</label>
    <SbFileUpload
      v-model="documents"
      accept=".pdf,.doc,.docx"
      :max-size="10485760"
    />
    <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB each</p>
  </div>
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | Array | `[]` | Array of File objects |
| `multiple` | Boolean | `true` | Allow multiple files |
| `accept` | String | `'*'` | File type filter (MIME or extensions) |
| `maxSize` | Number | `null` | Maximum file size in bytes |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | `File[]` | Files changed |
| `error` | `{ file, message }` | Validation error |

## Features

- **Drag and Drop**: Visual drop zone
- **File Browser**: Click to browse files
- **Multiple Files**: Upload many files at once
- **Size Validation**: Reject oversized files
- **Type Filtering**: Accept specific file types
- **File Preview**: Show selected files with sizes
- **Remove Files**: Click to remove individual files
- **Progress Display**: Show upload progress

## Styling

Uses Tailwind CSS:
- Dashed border drop zone
- Blue highlight on drag over
- File list with icons
- Remove buttons on hover

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
