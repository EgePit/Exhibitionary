<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitutionType extends Model
{
    public function institutions()
    {
        return $this->hasMany('App\Institution', 'type_id');
    }
}
