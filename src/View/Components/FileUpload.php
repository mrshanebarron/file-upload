<?php

namespace MrShaneBarron\FileUpload\View\Components;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-file-upload::components.file-upload');
    }
}
