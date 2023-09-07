<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable=['section_id','name_ar','name_en','status'];

    public function file()
    {
        return $this->morphMany(File::class, 'Fileable');
    }

}
