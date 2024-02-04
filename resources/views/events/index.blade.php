@extends('layouts.app')

@auth
    @section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les évenements 📅') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Bienvenue dans notre espace dédié aux rencontres entre parents solos ! Découvrez des évènements conviviaux : cafés détente, sorties ludiques avec les enfants, soirées à thème. Notre but : créer une communauté où chaque parent solo se sent soutenu, compris et entouré d'amitié. Rejoignez-nous pour une vie sociale épanouissante, pleine de soutien et de rires partagés.") }}
        </p>
    @endsection
@endauth

@section('content')
    @auth
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <br><a href=" ">
                            <x-primary-button>
                                <a href="{{ route('event.create') }}">
                                    Créer un nouvel évènement
                                </a>
                            </x-primary-button>
                        </a><br><br>

                        @if($events->isEmpty())
                            <p>Pas d'évènement en perspective... Deviens l'instigateur, lance le tien ! </p>
                        @else

                            <!-- DEBUT CALENDRIER -->
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight" >*** NOS EVENEMENTS:</h2><br>

                            <div id="calendar"></div><br>
                            <hr>
                            <!-- FIN CALENDRIER -->

                            <table class="min-w-full bg-white border border-gray-300">
                                <thead>
                                <tr>
                                    <th class="py-2 px-2 border-b">Evénement</th>
                                    <th class="py-2 px-2 border-b">Date</th>
                                    <th class="py-2 px-2 border-b">Heure</th>
                                    <th class="py-2 px-2 border-b">Lieu</th>
                                    <th class="py-2 px-2 border-b">Min pers</th>
                                    <th class="py-2 px-2 border-b">Max pers</th>
                                    <th class="py-2 px-2 border-b">Les personnes</th>
                                    <th class="py-2 px-2 border-b">Type</th>
                                    <th class="py-2 px-2 border-b">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td class="py-2 px-2 border-b">{{ $event->event_name }}</td>
                                        <td class="py-2 px-2 border-b">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                                        <td class="py-2 px-2 border-b">{{ $event->time }}</td>
                                        <td class="py-2 px-2 border-b">{{ $event->location }}</td>
                                        <td class="py-2 px-2 border-b">{{ $event->min_people }}</td>
                                        <td class="py-2 px-2 border-b">{{ $event->max_people}}</td>
                                        <td class="py-2 px-2 border-b">@if($event->people_type == 'between_parents')
                                                Entre parents
                                            @else
                                                Entre parents et enfants
                                            @endif
                                        </td>
                                        <td class="py-2 px-2 border-b">@if($event->type == 'outdoor')
                                                En plein air
                                            @else
                                                En intérieur
                                            @endif</td>
                                        <td class="py-2 px-2 border-b">
                                            <a href="{{ route('event.show', ['event' => $event->id]) }}"
                                               class="underline text-sm text-gray-600 hover:text-gray-900">
                                                Voir plus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endauth

    @guest
        <x-guest-layout>
            <br>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Les évenements:') }}
            </h2>
            <br>
            <div>
                @if($events->isEmpty())
                    <p>Pas d'évènement en perspective... </p>
                @else
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-2 border-b">Evénement</th>
                            <th class="py-2 px-2 border-b">Lieu</th>
                            <th class="py-2 px-2 border-b">Min pers</th>
                            <th class="py-2 px-2 border-b">Max pers</th>
                            <th class="py-2 px-2 border-b">Les personnes</th>
                            <th class="py-2 px-2 border-b">Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td class="py-2 px-2 border-b">{{ $event->event_name }}</td>
                                <td class="py-2 px-2 border-b">{{ $event->location }}</td>
                                <td class="py-2 px-2 border-b">{{ $event->min_people }}</td>
                                <td class="py-2 px-2 border-b">{{ $event->max_people}}</td>
                                <td class="py-2 px-2 border-b">@if($event->people_type == 'between_parents')
                                        Entre parents
                                    @else
                                        Entre parents et enfants
                                    @endif
                                </td>
                                <td class="py-2 px-2 border-b">@if($event->type == 'outdoor')
                                        En plein air
                                    @else
                                        En intérieur
                                    @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </x-guest-layout>

    @endguest
@endsection
