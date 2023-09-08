<?php

namespace App\Interfaces;

interface ServiceSectionInterface
{
    public function ChangeStatus(int $id);
    public function ChangeStatusAll($Data);
    public function ShowService($id);
    public function ForceDeleteAll($Data);
}
