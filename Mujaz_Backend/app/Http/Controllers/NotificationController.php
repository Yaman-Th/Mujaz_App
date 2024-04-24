<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; 

class NotificationController extends Controller
{
    public function saveFCMToken(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer',
            'deviceToken' => 'required|string|max:2000',
        ]);

        // Save device token to database
        Notification::updateOrCreate(
            ['user_id' => $validatedData['userId']],
            ['device_token' => $validatedData['deviceToken']]
        );

        return response()->json(['message' => 'Device token saved successfully']);
    }
}
