<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\SocietyModelTraits;
use Illuminate\Pipeline\Pipeline;
use Session;
use Auth;

class Block extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blocks';

    protected $fillable = ['unique_code', 'user_id', 'society_id', 'name', 'slug', 'total_flats', 'description', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ["user_id"];

    const EXCERPT_LENGTH = 250;

    /**
     * Function for eloquent relationship.
     * Associated Blocks.
     * @return "returns eloquent relationship"
     */
    public function plots()
    {
        // return $this->hasMany('App\Models\Plot', 'block_id')->where('status', '1');
        return $this->hasMany(Plot::class)->where('status', '1');
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
     * Associated Society.
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
