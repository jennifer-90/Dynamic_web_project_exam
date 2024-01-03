@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Les Evenements') }}
    </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <br><a href=" ">
                        <x-primary-button>Créer un nouvel évènement</x-primary-button>
                    </a><br><br>

                    @if($events->isEmpty())
                        <p>Pas d'évènement en perspective... Deviens l'instigateur, lance le tien ! </p>
                    @else
                        @foreach($events as $event)

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
