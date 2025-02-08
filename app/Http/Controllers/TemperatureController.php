<?php

namespace App\Http\Controllers;

use App\Models\TemperatureReading;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'created_at' => 'required|date_format:d-m-Y H:i:s', // Adjust the format to match incoming data
        ]);

        // Save the data
        $temperatureReading = TemperatureReading::create($validated);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Temperature saved successfully',
            'data' => $temperatureReading
        ]);
    }
    
    public function getTemperatureData()
    {
        $temperatures = TemperatureReading::orderBy('id', 'desc')
            ->take(10)
            ->get(['temperature', 'created_at']);
    
        // Format created_at and return
        $temperatures->transform(function ($temp) {
            $temp->created_at = $temp->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
            return $temp;
        });
    
        return response()->json($temperatures);
    }
    

}


