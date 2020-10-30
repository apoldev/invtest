<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AttrGroup extends Model
{

    protected $fillable = [
        'title',
    ];


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value , "-");
    }

    public function attrs()
    {
        return $this->hasMany('\App\Models\Attr', 'group_id', 'id');
    } 
}
