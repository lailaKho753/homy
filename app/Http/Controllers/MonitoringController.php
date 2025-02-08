<?php

namespace App\Http\Controllers;

use App\Models\TemperatureReading;

class MonitoringController extends Controller
{
    public function showMonitoring()
    {
        // Fetch the last 10 temperature readings
        $temperatureData = TemperatureReading::latest()->take(10)->pluck('temperature');
        
        // Fetch the timestamps for the last 10 temperature readings
        $labels = TemperatureReading::latest()->take(10)->pluck('created_at')->map(function ($timestamp) {
            return $timestamp->format('H:i'); // Format the timestamp for the x-axis
        });
    
        return view('monitoring.index', [
            'temperatureData' => $temperatureData,
            'labels' => $labels,
        ]);
    }
}
