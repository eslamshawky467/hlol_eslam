<?php

namespace App\Interfaces;

interface CustomInterface
{
    public function ForeverDelete(int $id);
    public function Restore($id);
    public function DeleteAll($Data);
    public function ArchiveAll($Data);
    public function RestoreAll($Data);
}
