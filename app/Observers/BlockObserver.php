<?php

namespace App\Observers;

use App\Models\Block;
use App\Models\Society;
use Illuminate\Support\Str;
use Session;
use Auth;

class BlockObserver
{
    /**
     * Handle the Block "created" event.
     * register at app\Providers\EventServiceProvider.php
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function created(Block $block)
    {
        $block->slug = Str::slug($block->title) . "-" . time();
        $str = "BLCK";
        $block->unique_code = str_pad($str, 10, "0", STR_PAD_RIGHT) . $block->id;
        $block->save();
    }

    /**
     * Handle the Block "updated" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function updated(Block $block)
    {
        //
    }

    /**
     * Handle the Block "deleted" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function deleted(Block $block)
    {
        //
    }

    /**
     * Handle the Block "restored" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function restored(Block $block)
    {
        //
    }

    /**
     * Handle the Block "force deleted" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function forceDeleted(Block $block)
    {
        //
    }
}
