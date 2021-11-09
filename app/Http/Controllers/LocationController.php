<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\LocationRequest;
use App\Http\Services\locationService;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct()
    {
        $this->locationService = new locationService();
    }

    public function showDistance(LocationRequest $request)
    {

        $fromLatLong =  $this->locationService->geLatitudeLongitude($request->from_location);
        $toLatLong =  $this->locationService->geLatitudeLongitude($request->to_location);

        if(!$fromLatLong){
           return $this->error('Unable to get from location data, specify a more accurate location');
        }

        if(!$toLatLong){
            return $this->error('Unable to get to location data, specify a more accurate location');
        }

        $distance = [
            'km' => $this->locationService->distance($fromLatLong['latitude'], $fromLatLong['longitude'], $toLatLong['latitude'], $toLatLong['longitude'], 'K'),
            'miles' => $this->locationService->distance($fromLatLong['latitude'], $fromLatLong['longitude'], $toLatLong['latitude'], $toLatLong['longitude'], 'M'),
            'nautical_miles' => $this->locationService->distance($fromLatLong['latitude'], $fromLatLong['longitude'], $toLatLong['latitude'], $toLatLong['longitude'], 'N'),
        ];

        $request['distance'] = $distance;
        return $this->success($request->all());

    }




}
