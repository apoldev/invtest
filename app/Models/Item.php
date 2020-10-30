<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Item extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'price',
    ];


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value , "-");
    }


    public function getPriceHumanAttribute()
    {
        return number_format($this->price, 2, ',', ' ');
    }

    public function attrs()
    {
        return $this->belongsToMany('App\Models\Attr');
    }
}
