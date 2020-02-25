<?php

namespace App\Services;

use App\Models\Slug;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SlugService
{
    /**
     * Get all slugs
     * @return array
     */
    public function getAllSlugs()
    {
        return Slug::all();
    }

    /**
     * Validate slug data
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate($data) {
        return Validator::make($data, Slug::$rules);
    }

    /**
     * Add new slug
     * @param $data
     * @return bool
     */
    public function addSlug($data) {
        if (!$this->validate($data)->fails()) {
            $newSlug = new Slug();
            $newSlug->setRawAttributes($data);
            return $newSlug->save();
        }
        return false;
    }

    /**
     * Update slug data
     * @param $data
     * @param $id
     * @return bool
     */
    public function updateSlug($data, $id) {
        if (!$this->validate($data)->fails()) {
            $slug = Slug::find($id);
            $slug->setRawAttributes($data);
            return $slug->save();
        }
        return false;
    }

    /**
     * Check then create or update slug data
     * @param $data
     * @return bool
     */
    public function createOrUpdateSlug($data) {
        /** @var Collection $slugCollection */
        $slugCollection = Slug::where('slugable_type', $data['slugable_type'])
            ->where('slugable_id', $data['slugable_id'])
            ->get();
        if ($slugCollection->count()) {
            return $this->updateSlug($data, $slugCollection->first()->getAttribute('id'));
        } else {
            return $this->addSlug($data);
        }
    }
}
