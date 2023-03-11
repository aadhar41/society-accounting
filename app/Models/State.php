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

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    protected $fillable = ['state_title'];

    protected $guarded = [];

    /**
     * Scope created awhile ago
     */
    public function scopeActive($query)
    {
        return $query->where('status', "Active");
    }

    /**
     * Scope created awhile ago
     */
    public function scopeInactive($query)
    {
        return $query->where('status', "Inactive");
    }

    /**
     * New Dynamic Scope
     */
    public function scopeStatus($query, $type)
    {
        return $query->where('status', $type);
    }
}
