<div>
    <div
        x-data="{
            dragging: false,
            handleDrop(e) {
                this.dragging = false;
                const files = e.dataTransfer.files;
                @this.uploadMultiple('files', files)
            }
        }"
        x-on:dragover.prevent="dragging = true"
        x-on:dragleave.prevent="dragging = false"
        x-on:drop.prevent="handleDrop($event)"
        class="relative border-2 border-dashed rounded-lg p-8 text-center transition-colors"
        :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
    >
        <input
            type="file"
            wire:model="files"
            {{ $multiple ? 'multiple' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            @if(count($acceptedTypes)) accept="{{ implode(',', $acceptedTypes) }}" @endif
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        >

        <div class="space-y-2">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p class="text-gray-600">{{ $placeholder }}</p>
            <p class="text-sm text-gray-500">Up to {{ $maxFileSize / 1024 }}MB</p>
        </div>
    </div>

    @if($showPreview && $files)
        <div class="mt-4 space-y-2">
            @foreach((array) $files as $index => $file)
                @if($file)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $file->getClientOriginalName() }}</p>
                            <p class="text-xs text-gray-500">{{ number_format($file->getSize() / 1024, 1) }} KB</p>
                        </div>
                    </div>
                    <button type="button" wire:click="removeFile({{ $index }})" class="text-red-500 hover:text-red-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif
            @endforeach
        </div>
    @endif

    @error('files.*')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
