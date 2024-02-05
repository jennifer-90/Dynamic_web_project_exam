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
        $events = Event::all();
        return view('events.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {


        $validatedData = $request->validated();

        $user = auth()->user();

        $event = $user->events()->create([
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

        // Utilise syncWithoutDetaching pour s'assurer que l'utilisateur n'est pas ajouté plusieurs fois
        $event->users()->syncWithoutDetaching(auth()->user());

        return redirect()->route('event.show', ['event' => $event->id])->with('success', '🟢 Votre évènement est créé ! 🟢 ');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $events = Event::all();
        return view('events.show', compact('event', 'events'));
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

    public function participate(Event $event)
    {
        // Ajoutez l'utilisateur actuel à la liste des participants de l'événement
        auth()->user()->events()->attach($event);

        return redirect()->route('event.show', ['event' => $event->id])->with('success', '🟢 Vous participez à cet événement! 🟢');
    }

    public function detach(Event $event)
    {
        auth()->user()->events()->detach($event);

        return redirect()->route('event.show', ['event' => $event->id])
            ->with('success', '🔴 Vous ne participez plus à cet événement!🔴');
    }


}
