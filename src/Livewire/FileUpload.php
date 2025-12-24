<?php

namespace MrShaneBarron\FileUpload\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $files = [];
    public bool $multiple = false;
    public bool $disabled = false;
    public array $acceptedTypes = [];
    public string $placeholder = 'Drag and drop files here, or click to browse';
    public int $maxFileSize = 10240; // KB
    public bool $showPreview = true;

    public function mount(
        bool $multiple = false,
        bool $disabled = false,
        array $acceptedTypes = [],
        string $placeholder = 'Drag and drop files here, or click to browse',
        int $maxFileSize = 10240,
        bool $showPreview = true
    ): void {
        $this->multiple = $multiple;
        $this->disabled = $disabled;
        $this->acceptedTypes = $acceptedTypes;
        $this->placeholder = $placeholder;
        $this->maxFileSize = $maxFileSize;
        $this->showPreview = $showPreview;
    }

    public function removeFile(int $index): void
    {
        if (is_array($this->files)) {
            unset($this->files[$index]);
            $this->files = array_values($this->files);
        } else {
            $this->files = [];
        }
    }

    public function render()
    {
        return view('sb-file-upload::livewire.file-upload');
    }
}
