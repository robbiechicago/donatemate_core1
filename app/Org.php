<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'org_id');
    }

    public function donations()
    {
        return $this->hasMany('App\Donation', 'org_id')->orderBy('id', 'DESC');
    }

    public function devices()
    {
        return $this->hasMany('App\Device', 'org_id');
    }
}
