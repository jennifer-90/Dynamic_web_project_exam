@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Mes photos') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        "Votre galerie visuelle, un espace dédié à votre créativité. Cette page est votre
        toile numérique pour partager vos moments les plus précieux, vos paysages les plus époustouflants et vos
        sourires les plus éclatants. Imaginez un album vivant, où chaque image raconte une histoire et chaque clic crée des souvenirs partagés. Partagez vos chefs-d'œuvre, recevez des éloges chaleureux et créez des connexions à travers des pixels. C'est votre espace pour illuminer le monde avec vos éclats de bonheur."
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


                    {{ __("Ajoute tes photos ici ! ") }}
                </div>

            </div>
        </div>
    </div>
@endsection

