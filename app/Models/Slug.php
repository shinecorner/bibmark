<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = 'slugs';

    protected $fillable = [
      'slug', 'slugable_type', 'slugable_id'
    ];

    static $rules = [
        'slug' => 'required|unique:slugs|max:255',
        'slugable_type' => 'required|max:255',
        'slugable_id' => 'required'
    ];

    static $updateRules = [
        'slug' => 'required|max:255',
        'slugable_type' => 'required|max:255',
        'slugable_id' => 'required'
    ];

    /**
     * Get the owning slugable model.
     */
    public function slugable()
    {
        return $this->morphTo();
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
