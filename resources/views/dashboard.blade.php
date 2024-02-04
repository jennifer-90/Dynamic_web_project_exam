@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Mon journal de bord 📖') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        Le Journal de Bord est votre espace personnel où vous pouvez suivre et gérer vos activités et participations aux événements. C'est comme un carnet virtuel qui conserve toutes les informations importantes concernant les événements auxquels vous avez participé.
    </p>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="alert alert-success">
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6">
                        <h2 class="text-3xl font-bold mb-4">&#128198;&#9200; Mes participations:</h2>

                            @if(auth()->user()->events->count() > 0)
                                <table class="min-w-full border">
                                    <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b">Mes événements</th>
                                        <th class="py-2 px-4 border-b">Les dates</th>
                                        <th class="py-2 px-4 border-b">Participants</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(auth()->user()->events as $event)
                                        <tr>

                                            <td class="py-2 px-4 border-b">&#9989;
                                                <a href="{{ route('event.show', ['event' => $event->id]) }}"
                                                   class="text-blue-500 underline">
                                                    {{ $event->event_name }}
                                                </a>
                                            </td>

                                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>

                                            <td class="py-2 px-4 border-b">
                                                @if($event->participants->count() > 0)
                                                    {{ $event->participants->count() }} personne(s)
                                                @else
                                                                                        Aucun participant pour le moment.
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                            <p class="text-gray-600">
                                Vous ne participez pas encore à des événements. Rejoignez ou créez une
                                activité:
                                <a href="{{ route('events.index') }}" class="text-blue-500 underline">
                                    <x-primary-button> >> ICI <<</x-primary-button>
                                </a>
                            </p>

                        @endif
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

