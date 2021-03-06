<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherMapValidationRequest;
use App\Models\Log;
use App\Services\WeatherMapService;
use GuzzleHttp\Exception\GuzzleException;

class MainController extends Controller
{
    private $weatherMapService;

    public function __construct(WeatherMapService $weatherMapService)
    {
        $this->weatherMapService = $weatherMapService;
    }

    public function index()
    {
        try {
            $result = $this->weatherMapService->getWeather('erevan');

            return view('home', compact('result'));
        } catch (\ErrorException $e) {
        }

    }

    public function weathermap(WeatherMapValidationRequest $request)
    {
        try {
            $result = $this->weatherMapService->getWeather($request->city);
        } catch (\ErrorException $e) {
            dd($e);
        }
        return view('weather', compact('result'));
    }

    public function getAll(Log $log){
        try {
            $logs = $log->paginate(15);
        } catch (\ErrorException $e) {
            dd($e);
        }
        return view('all', compact('logs'));
    }
}
