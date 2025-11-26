<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodeController extends Controller
{
    // request to mapbox
    // GET /geocode
    public function geocode(Request $request): JsonResponse
    {
        $address = $request->input('address');
        $accessToken = env('MAPBOX_API_KEY');

        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json?access_token={$accessToken}");

        return response()->json($response->json());
    }

    public function getCoordinates(string $city, string $country): array
    {
        $address = $city . ', ' . $country;
        $accessToken = env('MAPBOX_API_KEY');

        try {
            $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
                'access_token' => $accessToken
            ]);

            $data = $response->json();

            if (isset($data['features']) && count($data['features']) > 0) {
                return $data['features'][0]['center']; // [lng, lat]
            }
        } catch (Exception $exception) {
            Log::error('Geocoding error: ' . $exception->getMessage());
        }

        return [10.7579, 59.9111];
    }
}
