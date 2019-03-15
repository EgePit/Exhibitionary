<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public $timestamps = false;

    /**
     * Get the city for the editor.
     */
    public function editors()
    {
        return $this->belongsToMany('App\Editor', 'editor_city', 'city_id', 'editor_id');
    }

    /**
     * Get the exhibitions for the editor.
     */
    public function exhibitions()
    {
        return $this->belongsToMany('App\Exhibition', 'exhibition_city', 'city_id', 'exhibition_id');
    }

    public function institutions()
    {
        return $this->hasMany('App\Institution', 'city_id');
    }

    public function districts()
    {
        return $this->hasMany('App\District', 'city_id');
    }
}
