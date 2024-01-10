@extends('layouts.app')

@auth
    @section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les évenements') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Bienvenue dans notre espace dédié aux rencontres chaleureuses entre parents solos ! Découvrez des évènements conçus pour vous : des cafés décontractés, des sorties ludiques avec les enfants, et des soirées à thème. Notre objectif : construire une communauté où chaque parent solo se sent soutenu, compris et entouré d'amitié. Participez à des activités qui favorisent des liens durables, partagez vos expériences et trouvez du réconfort dans une communauté comprenant les défis et les joies de la parentalité en solo. Rejoignez-nous pour une vie sociale épanouissante, remplie de soutien et de rires partagés.") }}
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
                                        <td class="py-2 px-2 border-b">{{ $event->date }}</td>
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
        </x-guest-layout>
    @endguest
@endsection
