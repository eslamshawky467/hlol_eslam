<?php

namespace App\Interfaces;

interface BannerInterface
{
    public function DeleteAll($Data);
    public function ChangeStatus(int $id);
    public function ChangeStatusAll($Data);
    public function ShowBanner($id);
}
