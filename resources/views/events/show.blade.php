@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Détails de l\'événement') }}
    </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="alert alert-success">
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <h3 class="text-4xl font-extrabold uppercase mb-4">*** {{ $event->event_name }} ***</h3>

                <table class="w-full border">
                    <tr>
                        <td class="py-2 px-4 border-b">Date</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Heure</td>
                        <td class="py-2 px-4 border-b">{{ $event->time }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Lieu</td>
                        <td class="py-2 px-4 border-b">{{ $event->location }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Description du lieu</td>
                        <td class="py-2 px-4 border-b">{{ $event->location_description }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Nombre minimum de personnes</td>
                        <td class="py-2 px-4 border-b">{{ $event->min_people }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Nombre maximum de personnes</td>
                        <td class="py-2 px-4 border-b">{{ $event->max_people }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Type d'événement</td>
                        <td class="py-2 px-4 border-b">{{ $event->type }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Type de participants</td>
                        <td class="py-2 px-4 border-b">{{ $event->people_type }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">Créateur</td>
                        <td class="py-2 px-4 border-b">{{ $event->creator->name }}</td>
                    </tr>
                </table>
                <br>

                <!-- LE TABLEAU DES PARTICIPANTS: -->
                <hr>
                <div class="mt-6">
                    <h3 class="text-4xl font-extrabold uppercase mb-4">>> Les participants à cet évènement:</h3>

                    @if($event->participants->count() > 0)
                        <table class="w-full border">
                            @foreach($event->participants as $participant)
                                <tr>
                                    <td class="py-2 px-4 border-b">&#129497;
                                        @if(auth()->user()->id === $participant->id)
                                            {{ $participant->name }} &#11088; - Moi - &#11088;
                                        @else
                                            {{ $participant->name }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="text-gray-600">Hmm, l'événement n'a encore aucun participant. Soyez le premier à
                                                 illuminer cette fête en confirmant votre participation !</p>
                    @endif
                </div>


                <!-- LES BOUTONS: -->

                <div class="mt-6">

                    <x-primary-button class="ml-4">
                        <a href="{{ route('events.index') }}">
                            Retour à la liste des événements
                        </a>
                    </x-primary-button>
                    <br>

                    <div class="mt-6">
                        @if(auth()->user()->events->contains($event))
                            <form action="{{ route('events.detach', ['event' => $event->id]) }}" method="POST"
                                  class="inline">
                                @csrf
                                <x-primary-button type="submit" class="ml-4">
                                    Ne plus participer
                                </x-primary-button>
                            </form>
                        @else
                            <form action="{{ route('events.participate', ['event' => $event->id]) }}" method="POST"
                                  class="inline">
                                @csrf
                                <x-primary-button type="submit" class="ml-4">
                                    Participer
                                </x-primary-button>
                            </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>

@endsection
