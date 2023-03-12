<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\BlockModelTraits;
use Illuminate\Pipeline\Pipeline;
use Session;
use Auth;

class Block extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BlockModelTraits;

    protected $table = 'blocks';

    protected $fillable = ['unique_code', 'user_id', 'society_id', 'name', 'slug', 'total_flats', 'description', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ["user_id"];

    const EXCERPT_LENGTH = 250;
}
