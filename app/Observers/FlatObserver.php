<?php

namespace App\Observers;

use App\Models\Flat;
use App\Models\Plot;
use App\Models\Block;
use App\Models\Society;
use Illuminate\Support\Str;
use Session;
use Auth;

class FlatObserver
{
    /**
     * Handle the Flat "created" event.
     * register at app\Providers\EventServiceProvider.php
     * @param  \App\Models\Flat  $flat
     * @return void
     */
    public function created(Flat $flat)
    {
        $flat->slug = Str::slug($flat->name) . "-" . time();
        $str = "FLT";
        $flat->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $flat->id;
        $flat->save();
    }

    /**
     * Handle the Flat "updated" event.
     *
     * @param  \App\Models\Flat  $flat
     * @return void
     */
    public function updated(Flat $flat)
    {
        //
    }

    /**
     * Handle the Flat "deleted" event.
     *
     * @param  \App\Models\Flat  $flat
     * @return void
     */
    public function deleted(Flat $flat)
    {
        //
    }

    /**
     * Handle the Flat "restored" event.
     *
     * @param  \App\Models\Flat  $flat
     * @return void
     */
    public function restored(Flat $flat)
    {
        //
    }

    /**
     * Handle the Flat "force deleted" event.
     *
     * @param  \App\Models\Flat  $flat
     * @return void
     */
    public function forceDeleted(Flat $flat)
    {
        //
    }
}
