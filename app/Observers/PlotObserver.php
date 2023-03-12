<?php

namespace App\Observers;

use App\Models\Plot;

class PlotObserver
{
    /**
     * Handle the Plot "created" event.
     *
     * @param  \App\Models\Plot  $plot
     * @return void
     */
    public function created(Plot $plot)
    {
        //
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
