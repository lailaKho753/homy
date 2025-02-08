<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureReading extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at']; // Make sure created_at is a Carbon instance
    public function store(Request $request)
    {
        // Validate the incoming request (optional)
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'created_at' => 'required|date_format:d-m-Y H:i:s', // Adjust the format to match the incoming data
        ]);
    
        // Process the temperature data (e.g., save it to the database)
        $temperatureReading = new TemperatureReading([
            'temperature' => $validated['temperature'],
            'created_at' => $validated['created_at'],
        ]);
        $temperatureReading->save();
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Temperature saved successfully',
            'data' => $temperatureReading
        ]);
    }
    
}


