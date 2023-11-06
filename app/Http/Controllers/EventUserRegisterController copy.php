<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegister;
use App\Models\Event;
use App\Models\EventUserRegister;

class EventUserRegisterController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        // Assuming you are passing event_id and user_register_id in the request
        $request->validate([
            // 'event_id' => 'required|exists:events,id',
            // 'user_register_id' => 'required|exists:user_registers,line_token',
            'event_id' => 'required|string|max:255',
            'user_register_id' => 'required|string|max:255',
            'status' => 'nullable|string', // Add validation if needed
        ]);
        // dd($request);

        // // Check if the user is already registered for the event
        // $existingRegistration = EventUserRegister::where('event_id', $request->event_id)
        //     ->where('user_register_id', $request->user_register_id)
        //     ->first();

        // if ($existingRegistration) {
        //     // User is already registered, handle accordingly
        //     return redirect()->back()->with('error', 'You are already registered for this event.');
        // }
        
        dd($request->event_id);

        // If not already registered, create a new registration
        EventUserRegister::create([
            'event_id' => $request->event_id,
            'user_register_id' => $request->user_register_id,
            'status' => $request->status, // Use the status from the request or set a default
        ]);
        // EventUserRegister::create($request->all());

        return redirect()->back()->with('success', 'Event registration successful.');
    }
}
