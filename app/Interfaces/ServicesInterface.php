<?php

namespace App\Interfaces;

interface ServicesInterface
{
    public function CreateDTO($Data);
    public function CreateOrUpdate($Data);
    public function FindById(int $id);
}