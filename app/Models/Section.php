<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
class Section extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    protected $hidden = ['translations'];
    public $translatedAttributes = ['section_name'];
    protected $fillable = ['image', 'parent_id', 'active'];

    protected $casts = [
        'parent_id' => 'integer',
        'price'=>'double',
    ];

    public function _Parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function file()
    {
        return $this->morphMany(File::class,'Fileable');
    }

}
