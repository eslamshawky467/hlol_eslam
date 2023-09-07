<?php

namespace App\Interfaces;

interface ClientInterface
{
    public function ChangeStatus(int $id);
    public function ChangeStatusAll($Data);
    public function ShowClient($id);
}
