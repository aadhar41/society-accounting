<?php

namespace App\Observers;

use App\Models\Plot;
use App\Models\Block;
use App\Models\Society;
use Illuminate\Support\Str;
use Session;
use Auth;

class PlotObserver
{
    /**
     * Handle the Plot "created" event.
     * register at app\Providers\EventServiceProvider.php
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function created(Plot $plot)
    {
        $plot->slug = Str::slug($plot->name) . "-" . time();
        $str = "PLT";
        $plot->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $plot->id;
        $plot->save();
    }

    /**
     * Handle the Plot "updated" event.
     *
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function updated(Plot $plot)
    {
        //
    }

    /**
     * Handle the Plot "deleted" event.
     *
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function deleted(Plot $plot)
    {
        //
    }

    /**
     * Handle the Plot "restored" event.
     *
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function restored(Plot $plot)
    {
        //
    }

    /**
     * Handle the Plot "force deleted" event.
     *
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function forceDeleted(Plot $plot)
    {
        //
    }
}
