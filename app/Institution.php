<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * Get the city_id record associated with the institution.
     */
    public function city_id()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    /**
     * Get the type_id record associated with the institution.
     */
    public function type_id()
    {
        return $this->hasOne('App\InstitutionType', 'id', 'type_id');
    }

    public function exhibition()
    {
        return $this->hasOne('App\Exhibition', 'id', 'Institution_id');
    }
}
