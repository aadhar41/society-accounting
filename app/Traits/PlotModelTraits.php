<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Society;
use App\Models\Block;
use App\Models\Plot;
use App\Models\Flat;
use Illuminate\Support\Str;
use Session;
use Auth;



trait PlotModelTraits
{
    /**
     * Function for eloquent relationship.
     * Associated Flat.
     * @return "returns eloquent relationship"
     */
    public function flats()
    {
        // return $this->hasMany('App\Models\Flat', 'plot_id')->where('status', '1');
        return $this->hasMany(Flat::class)->where('status', '1');
    }

    /**
     * Function for eloquent relationship.
     * Associated User.
     * @return "returns eloquent relationship"
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->select("id", "email", "name");
    }

    /**
     * Function for eloquent relationship.
     * Associated Society.
     * @return "returns eloquent relationship"
     */
    public function society()
    {
        return $this->belongsTo('App\Models\Society', 'society_id')->select("id", "unique_code", "name")->where("status", "1");
    }

    /**
     * Function for eloquent relationship.
     * Associated Block.
     * @return "returns eloquent relationship"
     */
    public function block()
    {
        return $this->belongsTo('App\Models\Block', 'block_id')->select("id", "unique_code", "name")->where("status", "1");
    }

    /**
     * Function for return excerpt of given text.
     * 
     * @return "returns excerpt for given text"
     */
    public function excerpt()
    {
        return Str::limit($this->description, env('EXCERPT_LENGTH', 250));
    }

    /**
     * Scope created awhile ago
     */
    public function scopeActive($query)
    {
        return $query->where('status', "1");
    }

    /**
     * Scope created awhile ago
     */
    public function scopeInactive($query)
    {
        return $query->where('status', "0");
    }

    /**
     * New Dynamic Scope
     */
    public function scopeStatus($query, $type)
    {
        return $query->where('status', $type);
    }
}
