<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SocietyRepositoryInterface;
use App\Repositories\SocietyRepository;
use App\Interfaces\BlockRepositoryInterface;
use App\Repositories\BlockRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SocietyRepositoryInterface::class, SocietyRepository::class);
        $this->app->bind(BlockRepositoryInterface::class, BlockRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
