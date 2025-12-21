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
        :style="dragging ? 'border-color: #3b82f6; background: #eff6ff;' : ''"
        style="position: relative; border: 2px dashed #d1d5db; border-radius: 8px; padding: 32px; text-align: center; transition: border-color 0.2s, background 0.2s;"
    >
        <input
            type="file"
            wire:model="files"
            @if($this->multiple) multiple @endif
            @if($this->disabled) disabled @endif
            @if(count($this->acceptedTypes)) accept="{{ implode(',', $this->acceptedTypes) }}" @endif
            style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;"
        >

        <div>
            <svg style="margin: 0 auto 8px; height: 48px; width: 48px; color: #9ca3af;" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p style="color: #4b5563; margin-bottom: 4px;">{{ $this->placeholder }}</p>
            <p style="font-size: 14px; color: #6b7280;">Up to {{ $this->maxFileSize / 1024 }}MB</p>
        </div>
    </div>

    @if($this->showPreview && $files)
        <div style="margin-top: 16px; display: flex; flex-direction: column; gap: 8px;">
            @foreach((array) $files as $index => $file)
                @if($file)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; background: #f9fafb; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="height: 40px; width: 40px; background: #e5e7eb; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                            <svg style="height: 20px; width: 20px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 14px; font-weight: 500; color: #374151;">{{ $file->getClientOriginalName() }}</p>
                            <p style="font-size: 12px; color: #6b7280;">{{ number_format($file->getSize() / 1024, 1) }} KB</p>
                        </div>
                    </div>
                    <button type="button" wire:click="removeFile({{ $index }})" style="color: #ef4444; background: none; border: none; cursor: pointer;">
                        <svg style="height: 20px; width: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif
            @endforeach
        </div>
    @endif

    @error('files.*')
        <p style="margin-top: 8px; font-size: 14px; color: #dc2626;">{{ $message }}</p>
    @enderror
</div>
