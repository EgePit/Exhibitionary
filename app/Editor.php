<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    /**
     * Get the cities for the city.
     */
    public function cities()
    {
        return $this->belongsToMany('App\City', 'editor_city', 'editor_id', 'city_id');
    }

    /**
     * Get the exhibitions for the city.
     */
    public function exhibitions()
    {
        return $this->belongsToMany('App\Exhibition', 'editor_exhibition', 'editor_id', 'exhibition_id');
    }
}
