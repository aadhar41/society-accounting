<?php

use App\Models\Block;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Flat;
use App\Models\Plot;
use App\Models\Society;
use App\Models\User;

if (!function_exists('getCountries')) {
    function getCountries()
    {
        return Country::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getState')) {
    function getState()
    {
        return State::active()->orderBy('state_title', 'asc')->get()->pluck("state_title", "id");
    }
}

if (!function_exists('getCities')) {
    function getCities()
    {
        return City::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getSocieties')) {
    function getSocieties()
    {
        return Society::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getBlocks')) {
    function getBlocks()
    {
        return Block::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getPlots')) {
    function getPlots()
    {
        return Plot::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getFlats')) {
    function getFlats()
    {
        return Flat::active()->orderBy('name', 'asc')->get()->pluck("name", "id");
    }
}

if (!function_exists('getPropertyTypes')) {
    function getPropertyTypes()
    {
        return [1 => "self occupied", 2 => "Rented", 3 => "Locked", 4 => "Unsold", 5 => "ceiled"];
    }
}

if (!function_exists('getSocietyBlocks')) {
    function getSocietyBlocks($id = "")
    {
        return Block::active()->orderBy('name', 'asc')->where(['society_id' => $id])->get()->pluck("name", "id");
    }
}

if (!function_exists('getBlockPlots')) {
    function getBlockPlots($id = "")
    {
        return Plot::active()->orderBy('name', 'asc')->where(['block_id' => $id])->get()->pluck("name", "id");
    }
}

if (!function_exists('getPlotsFlats')) {
    function getPlotsFlats($id = "")
    {
        return Flat::active()->orderBy('name', 'asc')->where(['plot_id' => $id])->get()->pluck("name", "id");
    }
}