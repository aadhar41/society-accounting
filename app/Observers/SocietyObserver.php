<?php

namespace App\Observers;

use App\Models\Society;
use Illuminate\Support\Str;
use Session;
use Auth;

class SocietyObserver
{
    /**
     * Handle the Society "created" event.
     *
     * @param  \App\Models\Society  $society
     * @return void
     */
    public function created(Society $society)
    {
        $society->slug = Str::slug($society->title) . "-" . time();
        $str = "SCTY";
        $society->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $society->id;
        $society->save();
    }

    /**
     * Handle the Society "updated" event.
     *
     * @param  \App\Models\Society  $society
     * @return void
     */
    public function updated(Society $society)
    {
        //
    }

    /**
     * Handle the Society "deleted" event.
     *
     * @param  \App\Models\Society  $society
     * @return void
     */
    public function deleted(Society $society)
    {
        //
    }

    /**
     * Handle the Society "restored" event.
     *
     * @param  \App\Models\Society  $society
     * @return void
     */
    public function restored(Society $society)
    {
        //
    }

    /**
     * Handle the Society "force deleted" event.
     *
     * @param  \App\Models\Society  $society
     * @return void
     */
    public function forceDeleted(Society $society)
    {
        //
    }
}
