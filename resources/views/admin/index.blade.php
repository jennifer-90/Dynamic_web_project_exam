
@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Les profils') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Role</th>
                <th>Statut</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->registration_date }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->user_status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection

