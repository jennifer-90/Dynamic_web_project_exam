@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Création d\'un évènement') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif


                    <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="event_name">Nom de l'évènement :</label><br>
                        <input type="text" name="event_name" id="event_name" class="border rounded w-full py-2 px-3
                        mb-2" maxlength="30" pattern="^[a-zA-Z0-9\séèêàùûôëïüÿçÉÈÊÀÙÛÔËÏÜŸÇ\-]*$"
                               title="Seuls les lettres, chiffres et espaces sont autorisés.">
                        @error('event_name')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="date">Date de l'évènement :</label><br>
                        <input type="date" name="date" id="date" class="border rounded w-full py-2 px-3 mb-2"
                               min="{{ date('Y-m-d') }}">
                        @error('date')
                        <div>&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="time">Heure de l'évènement (format 24 heures) :</label><br>
                        <input type="time" name="time" id="time" class="border rounded w-full py-2 px-3 mb-2">
                        @error('time')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="location">Lieu :</label><br>
                        <input type="text" name="location" id="location" class="border rounded w-full py-2 px-3 mb-2"
                               pattern="^[a-zA-Z0-9\séèêàùûôëïüÿçÉÈÊÀÙÛÔËÏÜŸÇ\-]*$" title="Seules les lettres et espaces sont autorisés.">
                        @error('location')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="location_description">Description du lieu :</label><br>
                        <textarea name="location_description" id="location_description" rows="4" class="border
                        rounded w-full py-2 px-3 mb-2" maxlength="300"></textarea>
                        @error('location_description')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="min_people">Nombre minimum de personnes :</label><br>
                        <input type="number" name="min_people" id="min_people"
                               class="border rounded w-full py-2 px-3 mb-2" min="1">
                        @error('min_people')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="max_people">Nombre maximum de personnes :</label><br>
                        <input type="number" name="max_people" id="max_people" class="border rounded w-full py-2 px-3
                         mb-2">
                        @error('max_people')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="type">Type d'évènement :</label><br>
                        <select name="type" id="type" class="border rounded w-full py-2 px-3 mb-2">
                            <option value="outdoor">En plein air</option>
                            <option value="indoor">En intérieur</option>
                        </select>
                        @error('type')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <label for="people_type">Type de participants :</label><br>
                        <select name="people_type" id="people_type" class="border rounded w-full py-2 px-3 mb-2">
                            <option value="between_parents">Entre parents</option>
                            <option value="parents_children">Parents et enfants</option>
                        </select>
                        @error('people_type')
                        <div class="text-red-500">&#9888;&#65039; {{ $message }}</div>
                        @enderror<br><br>

                        <x-primary-button>>>Créer</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
