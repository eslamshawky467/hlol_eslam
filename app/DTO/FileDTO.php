<?php

namespace App\DTO;

class FileDTO
{

    public $file;
    public $folder;
    public $subFolder;
    public $class;
    public $id;

    function __construct($file, $folder, $subFolder, $class, $id)
    {
        $this->file = $file;
        $this->folder = $folder;
        $this->subFolder = $subFolder;
        $this->class = $class;
        $this->id = $id;
    }
}
