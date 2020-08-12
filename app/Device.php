<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function org()
    {
        return $this->belongsTo('App\Org', 'org_id');
    }

}
