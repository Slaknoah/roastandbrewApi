<?php


namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cafe extends Model
{
    use SoftDeletes, Sluggable, HasFactory;

    protected $table = 'cafes';

    protected $guarded = [];

    /**
     * A cafe belongs to a Company
     */
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
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
                'source' => [ 'location_name', 'address', 'city', 'state' ]
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
