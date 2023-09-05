<?php

namespace App\Interfaces;

interface CRUDInterface
{

    public function GetById(int $id);
    public function GetAlls();
    public function StoreNew($Data);
    public function Update($Data);
    public function Delete(int $id);
    public function ForeverDelete(int $id);
    public function Restore($id);
    public function DeleteAll($Data);
    public function ArchiveAll($Data);
    public function RestoreAll($Data);
}
