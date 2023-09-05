<?php

namespace App\Traits;

trait FileTrait
{

    public function saveFile($file, $folder, $subFolder)
    {

        $file_extension = $file->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'uploads/' . $folder . '/' . $subFolder;
        $file->storeAs($path, $file_name, 'public');
        $Fullpath = $path . '/' . $file_name;
        return $Fullpath;


    }


    public function FileType($ex)
    {

        $imgTypes = array('jpg', 'png', 'gif', 'jpeg', 'svg', 'apng', 'avif', 'jfif', 'pjpeg', 'pjp', 'webp');
        $excelType = array('xls', 'xlsx', 'ods');
        $wordTypes = array('docx', 'dot', 'dotx', 'odt');

        if (in_array($ex, $imgTypes)) {
            return 'image';
        } elseif (in_array($ex, $excelType)) {
            return 'excel';
        } elseif (in_array($ex, $wordTypes)) {
            return 'word';
        } else {
            return 'pdf';
        }


    }

    public function downloadFile($file_name)
    {
        $path = storage_path('app/public/' . $file_name);
        return response()->download($path);

    }

}
