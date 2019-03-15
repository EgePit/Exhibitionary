<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * Get the city_id record associated with the district.
     */
    public function city_id()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    /**
     * Get the exhibitions for the city.
     */
    public function exhibitions()
    {
        return $this->belongsToMany('App\Exhibition', 'district_exhibition', 'district_id', 'exhibition_id');
    }
}
