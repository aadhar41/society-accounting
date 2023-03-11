<?php

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Society;
use App\Models\User;

if (!function_exists('getCountries')) {
    function getCountries()
    {
        return Country::active()->orderBy('name', 'asc')->get()->pluck("name","id");
    }
}

if (!function_exists('getState')) {
    function getState()
    {
        return State::active()->orderBy('state_title', 'asc')->get()->pluck("state_title","id");
    }
}

if (!function_exists('getCities')) {
    function getCities()
    {
        return City::active()->orderBy('name', 'asc')->get()->pluck("name","id");
    }
}