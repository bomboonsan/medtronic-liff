<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\UserRegister;
use App\Models\Event;
use App\Models\EventUserRegister;

class EventUserRegisterController extends Controller
{
    public function store(Request $request)
    {
        // Assuming you are passing event_id and user_register_id in the request
        $request->validate([
            'event_id' => 'required|string',
            'line_token' => 'required|string',
            'status' => 'nullable|string', // Add validation if needed
        ]);

        $userRegisterId = UserRegister::where('line_token', $request->line_token)
            ->first();
        
        if (!$userRegisterId) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user_register_id = $userRegisterId->id;        

        // Check if the user is already registered for the event
        $existingRegistration = EventUserRegister::where('event_id', $request->event_id)
            ->where('user_register_id', $user_register_id)
            ->first();

        if ($existingRegistration) {
            // User is already registered, handle accordingly
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }

        // If not already registered, create a new registration
        EventUserRegister::create([
            'event_id' => $request->event_id,
            'user_register_id' => $user_register_id,
            'status' => $request->status, // Use the status from the request or set a default
        ]);

        return redirect()->back()->with('success', 'Event registration successful.');
    }

    public function checkEvent(Request $request)
    {
        $lineToken = $request->input('line_token');
        $eventId = $request->input('event_id');


        $userRegisterId = UserRegister::where('line_token', $lineToken)
            ->first();

        if (!$userRegisterId) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user_register_id = $userRegisterId->id;     

        $existingRegistration = EventUserRegister::where('event_id', $eventId)
            ->where('user_register_id', $user_register_id)
            ->first();
        
        return response()->json(['registered' => $existingRegistration !== null]);
    }


    
}
