<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    ///
    /*
    the protected $guarded = []; line is to override mass assignment checks - since Profile is only being used after careful validate()ion, this is safe.
    */
    ///
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
