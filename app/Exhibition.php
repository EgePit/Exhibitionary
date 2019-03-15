<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    /**
     * Get the cities for the exhibition.
     */
    public function cities()
    {
        return $this->belongsToMany('App\City', 'exhibition_city', 'exhibition_id', 'city_id');
    }

    /**
     * Get the districts for the exhibition.
     */
    public function districts()
    {
        return $this->belongsToMany('App\District', 'district_exhibition', 'exhibition_id', 'district_id');
    }

    /**
     * Get the city for the editor.
     */
    public function editors()
    {
        return $this->belongsToMany('App\Editor', 'editor_exhibition', 'exhibition_id', 'editor_id');
    }

    /**
     * Get the images for the editor.
     */
    public function images()
    {
        return $this->belongsToMany('App\Image', 'exhibition_images', 'exhibition_id', 'image_id');
    }

    public function institution()
    {
        return $this->hasOne('App\Institution', 'id', 'institution_id');
    }
}
