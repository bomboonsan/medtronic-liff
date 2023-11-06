<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        // Format the date for each event
        foreach ($events as $event) {
            $event->start_date_formatted = Carbon::parse($event->start_date)->format('d M Y');
            $event->end_date_formatted = Carbon::parse($event->end_date)->format('d M Y');
        }

        return view('dashboard.events.index', compact('events'));
    }

    public function calendar()
    {
        $events = Event::all();

        // Format the date for each event
        foreach ($events as $event) {
            $event->start_date_formatted = Carbon::parse($event->start_date)->format('d M Y');
            $event->end_date_formatted = Carbon::parse($event->end_date)->format('d M Y');
        }
        
        return view('calendar', compact('events'));
    }

    public function create()
    {
        return view('dashboard.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:events,slug',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rule
        ]);


        $thumbnailPath = null;
        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('public/events/thumbnails');  
            // Generate a URL without the 'public' segment          
            $thumbnailUrl = Storage::url($thumbnailPath);
            Event::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'thumbnail' => $thumbnailUrl,
            ]);
        } else {
            Event::create($request->all());
        }
        // dd($request);

        // Event::create($request->all());

        return redirect()->route('events-all')->with('success', 'Event created successfully');
    }

    public function joinevent(Request $request) 
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'line_user_id' => 'required|string', // Adjust the validation rule as needed
        ]);

        // Check if the user is already registered for the event
        $isRegistered = $request->user()->events()->where('event_id', $request->event_id)->exists();

        if (!$isRegistered) {
            // Register the user for the event
            $request->user()->events()->attach($request->event_id);

            // You can also update the 'status' field if needed
            // $request->user()->events()->updateExistingPivot($request->event_id, ['status' => 'registered']);

            return redirect()->back()->with('success', 'Event registration successful');
        } else {
            return redirect()->back()->with('error', 'You are already registered for this event');
        }
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        // Format the date for each event
        $event->start_date_formatted = Carbon::parse($event->start_date)->format('d M Y, h:m a');
        $event->end_date_formatted = Carbon::parse($event->end_date)->format('d M Y, h:m a');
        // $event = Event::find($id);
        return view('dashboard.events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('dashboard.events.edit', compact('event'));
    }

    // public function update(Request $request, $id)
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:events,slug,' . $event->id,
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rule
        ]);
        
        $event = Event::findOrFail($id);

        // Check if a new thumbnail is being uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete the previous thumbnail if it exists
            Storage::disk('public')->delete($event->thumbnail);

            $thumbnailPath = $request->file('thumbnail')->store('public/events/thumbnails');  
            $request->merge(['thumbnail' => $thumbnailPath]);
        } else {
            // No new thumbnail uploaded, use the existing thumbnail path
            $request->merge(['thumbnail' => $event->thumbnail]);
        }

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
