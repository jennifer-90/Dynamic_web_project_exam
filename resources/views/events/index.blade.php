@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Les évenements') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("Bienvenue dans notre espace dédié aux rencontres chaleureuses entre parents solos ! Découvrez des évènements conçus pour vous : des cafés décontractés, des sorties ludiques avec les enfants, et des soirées à thème. Notre objectif : construire une communauté où chaque parent solo se sent soutenu, compris et entouré d'amitié. Participez à des activités qui favorisent des liens durables, partagez vos expériences et trouvez du réconfort dans une communauté comprenant les défis et les joies de la parentalité en solo. Rejoignez-nous pour une vie sociale épanouissante, remplie de soutien et de rires partagés.") }}
    </p>
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
