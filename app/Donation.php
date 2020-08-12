<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    public function org()
    {
        return $this->hasOne('App\Org', 'id', 'org_id');
    }
}
