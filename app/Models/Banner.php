<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status','link'];
    public function file()
    {
        return $this->morphMany(File::class, 'Fileable');
    }
}
