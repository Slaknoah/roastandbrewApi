<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Company extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'companies';

    protected $guarded = [];

    /**
     * A company was added by a User
     * @return BelongsTo
     */
    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'id', 'added_by');
    }

    /**
     * A company has many owners
     */
    public function owners() {
        return $this->belongsToMany('App\Models\User', 'companies_owners', 'company_id', 'user_id');
    }

    /**
     * A company has many cafes
     * @return HasMany
     */
    public function cafes() {
        return $this->hasMany('App\Models\Cafe', 'company_id', 'id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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
