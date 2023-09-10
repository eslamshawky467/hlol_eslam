<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['section_id', 'name_ar', 'name_en', 'status'];

    public function file()
    {
        return $this->morphMany(File::class, 'Fileable');
    }

    public function section()
    {

        return $this->belongsTo(Section::class, "section_id");
    }

}
