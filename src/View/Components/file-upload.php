<?php

namespace MrShaneBarron\file-upload\View\Components;

use Illuminate\View\Component;

class file-upload extends Component
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
