<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the owning billingable models.
     */
    // public function addressable()
    // {
    //     return $this->morphTo();
    // }

}
