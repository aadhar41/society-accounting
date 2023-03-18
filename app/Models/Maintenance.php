<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\MaintenanceTraits;
use Illuminate\Pipeline\Pipeline;
use Session;
use Auth;


class Maintenance extends Model
{
    use HasFactory;
    use SoftDeletes;
    use MaintenanceTraits;

    protected $table = 'maintenances';

    protected $fillable = ['unique_code', 'user_id', 'society_id', 'block_id', 'plot_id', 'flat_id', 'type', 'date', 'year', 'month', 'amount' , 'description', 'attachments', 'payment_status', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ["user_id"];

    const EXCERPT_LENGTH = 250;
}
