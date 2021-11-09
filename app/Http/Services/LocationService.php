<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Http;


class locationService {

    public function geLatitudeLongitude($address) {
        $array = array();
        $mapApiKey = env('GOOGLE_MAP_API_KEY');
        $googleApiUrl = env('GOOGLE_API_URL');
        $geo = Http::get("{$googleApiUrl}/maps/api/geocode/json?address={$address}&key={$mapApiKey}");

        // We convert the JSON to an array
        $geo = json_decode($geo, true);

        // If everything is cool
        if ($geo['status'] = 'OK') {
           $latitude = $geo['results'][0]['geometry']['location']['lat'];
           $longitude = $geo['results'][0]['geometry']['location']['lng'];
           $array = array('latitude'=> $latitude ,'longitude'=>$longitude);
        }

        return $array;
     }



    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
        return ($miles * 1.609344);
        } else if ($unit == "N") {
        return ($miles * 0.8684);
        } else {
        return $miles;
        }

    }

}
