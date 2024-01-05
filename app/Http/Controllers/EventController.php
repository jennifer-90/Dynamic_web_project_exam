<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {

        $validatedData = $request->validated();

        $event = new Event([
            'event_name'            => $validatedData['event_name'],
            'date'                  => $validatedData['date'],
            'time'                  => $validatedData['time'],
            'location'              => $validatedData['location'],
            'location_description'  => $validatedData['location_description'],
            'min_people'            => $validatedData['min_people'],
            'max_people'            => $validatedData['max_people'],
            'type'                  => $validatedData['type'],
            'people_type'           => $validatedData['people_type'],
        ]);

        $event->save();

        return redirect()->route('event.show', ['event' => $event->id])->with('success', 'Event created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
