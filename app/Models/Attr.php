<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attr extends Model
{

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value , "-");
    }


    public function group()
    {
        return $this->belongsTo('\App\Models\AttrGroup', 'group_id', 'id');
    } 
}
