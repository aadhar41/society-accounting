<?php

namespace App\Observers;

use App\Models\Maintenance;
use Illuminate\Support\Str;
use Session;
use Auth;

class MaintenanceObserver
{
    /**
     * Handle the Maintenance "created" event.
     * register at app\Providers\EventServiceProvider.php
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function created(Maintenance $maintenance)
    {
        $str = "MNTNNC";
        $maintenance->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $maintenance->id;
        // $maintenance->date = date('Y-m-d H:i:s', strtotime($maintenance->date));
        $maintenance->save();
    }

    /**
     * Handle the Maintenance "updated" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function updated(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "deleted" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function deleted(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "restored" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function restored(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "force deleted" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function forceDeleted(Maintenance $maintenance)
    {
        //
    }
}
