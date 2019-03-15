<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'photo_id');
    }

    public function exhibitions()
    {
        return $this->belongsToMany('App\Exhibition', 'exhibition_images', 'image_id', 'exhibition_id');
    }
}
