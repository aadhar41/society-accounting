<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Society;
use App\Models\Block;
use App\Models\Plot;
use App\Models\Flat;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('societies')->truncate();
        DB::table('blocks')->truncate();
        DB::table('plots')->truncate();
        DB::table('flats')->truncate();
        DB::table('maintenances')->truncate();
        DB::statement("SET foreign_key_checks=1");

        \App\Models\Society::factory(10)->create()
            ->each(function ($u) {
                $u->blocks()
                    ->saveMany(
                        \App\Models\Block::factory(5)->make()
                    )->each(function ($p) {
                        $p->plots()
                            ->saveMany(
                                \App\Models\Plot::factory(5)->make()
                            )->each(function ($p) {
                                $p->flats()
                                    ->saveMany(
                                        \App\Models\Flat::factory(5)->make()
                                    )->each(function ($p) {
                                        $p->maintenances()
                                            ->saveMany(
                                                \App\Models\Maintenance::factory(2)->make()
                                            );
                                    });
                            });
                    });
            });
    }
}
