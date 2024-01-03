@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Les profils') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Id</th>
                            <th class="py-2 px-4 border-b">Nom</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Date d'inscription</th>
                            <th class="py-2 px-4 border-b">Role</th>
                            <th class="py-2 px-4 border-b">Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->registration_date }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->user_status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

