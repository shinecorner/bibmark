<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharityCampaign extends Model
{
    use SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $table = "charity_campaign";
    protected $guarded = [];
}
