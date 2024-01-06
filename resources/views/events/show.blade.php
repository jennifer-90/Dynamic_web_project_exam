

@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Détails de l\'événement') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>{{ $event->event_name }}</h3>
                    <p>Date : {{ $event->date }}</p>
                    <p>Heure : {{ $event->time }}</p>
                    <p>Lieu : {{ $event->location }}</p>
                    <p>Description du lieu : {{ $event->location_description }}</p>
                    <p>Nombre minimum de personnes : {{ $event->min_people }}</p>
                    <p>Nombre maximum de personnes : {{ $event->max_people }}</p>
                    <p>Type d'événement : {{ $event->type }}</p>
                    <p>Type de participants : {{ $event->people_type }}</p>
                    <p>Créateur : {{ $event->creator->name }}</p><!-- Ne fonctionne pas encore -->
                    <br>
                        <x-primary-button>
                            <a href="{{  route('events.index') }}">
                                Retour à la liste des événements
                            </a>
                        </x-primary-button>
                </div>
            </div>
        </div>
    </div>
@endsection
