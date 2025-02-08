<?php

namespace App\Http\Controllers;

use App\Models\TemperatureReading;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
// TemperatureController.php
    public function store(Request $request)
    {
        // Validate the incoming request (optional)
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'created_at' => 'required|string', // or a Date validation if needed
        ]);

        // Process the temperature data (e.g., save it to the database)
        $temperature = new Temperature([
            'temperature' => $validated['temperature'],
            'created_at' => $validated['created_at']
        ]);
        $temperature->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Temperature saved successfully',
            'data' => $temperature
        ]);
    }

}

