<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrewMethod extends Model
{
    use HasFactory;

    /**
     * Brew method has many cafes
     */
    public function cafes() {
        return $this->belongsToMany('App\Models\Cafe', 'cafes_brew_methods', 'brew_method_id', 'cafe_id')->withTimestamps();
    }
}
