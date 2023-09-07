<?php

namespace App\Services;

use App\DTO\FileDTO;
use App\Models\File;
use App\Traits\FileTrait;
use App\Events\CreateFileEvent;
use Illuminate\Support\Facades\Storage;

class FileService
{
    use FileTrait;

    public function CreateFileDTO($file, $model, $folder, $name)
    {

        return new FileDTO(
            $file,
            $folder,
            $name,
            get_class($model),
            $model->id
        );

    }
    public function CreateFile($file, $model, $folder,$name)
    {
        $data = $this->CreateFileDTO($file, $model, $folder,$name);

        $file_name = $this->saveFile($data->file, $data->folder, $data->subFolder);
        $file_type = $this->FileType($data->file->clientExtension());

        $images = new File();
        $images->file_name = $file_name;
        $images->Fileable_id = $data->id;
        $images->Fileable_type = $data->class;
        $images->type = $file_type;
        $images->save();
    }


    public function DeleteFile($model, $folder)
    {
        (Storage::disk('public')->deleteDirectory($folder));
        $model->file()->delete();
        return true;
    }
}
