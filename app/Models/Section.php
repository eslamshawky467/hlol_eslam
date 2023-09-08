<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    protected $with = ['translations'];
    public $translatedAttributes = ['section_name'];
    protected $fillable = ['image', 'parent_id', 'active'];

    public function _Parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function Children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function file()
    {
        return $this->morphMany(File::class, 'Fileable');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
