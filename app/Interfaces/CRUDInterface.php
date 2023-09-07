<?php

namespace App\Interfaces;

interface CRUDInterface
{

    public function GetById(int $id);
    public function GetAlls();
    public function StoreNew($Data);
    public function Update($Data);
    public function Delete(int $id);

}
