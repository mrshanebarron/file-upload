<?php

namespace MrShaneBarron\FileUpload\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Modelable;

class FileUpload extends Component
{
    use WithFileUploads;

    #[Modelable]
    public $files = [];

    public bool $multiple = false;
    public int $maxFiles = 10;
    public int $maxFileSize = 10240; // KB
    public array $acceptedTypes = [];
    public string $placeholder = 'Drop files here or click to upload';
    public bool $showPreview = true;
    public bool $disabled = false;

    public function mount(
        bool $multiple = false,
        int $maxFiles = 10,
        int $maxFileSize = 10240,
        array $acceptedTypes = [],
        string $placeholder = 'Drop files here or click to upload',
        bool $showPreview = true,
        bool $disabled = false,
    ): void {
        $this->multiple = $multiple;
        $this->maxFiles = $maxFiles;
        $this->maxFileSize = $maxFileSize;
        $this->acceptedTypes = $acceptedTypes;
        $this->placeholder = $placeholder;
        $this->showPreview = $showPreview;
        $this->disabled = $disabled;
    }

    public function removeFile($index): void
    {
        if (is_array($this->files)) {
            unset($this->files[$index]);
            $this->files = array_values($this->files);
        } else {
            $this->files = [];
        }
    }

    public function getAcceptAttribute(): string
    {
        return implode(',', $this->acceptedTypes);
    }

    public function render()
    {
        return view('sb-file-upload::livewire.file-upload');
    }
}
