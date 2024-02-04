@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Ma page Admin ⭐') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("Bienvenue dans notre espace d'administration, le cœur de notre communauté ! Ici, nos administrateurs ont le pouvoir magique de personnaliser l'expérience de chaque utilisateur. Bien qu'ils aient des pouvoirs étendus, des limitations garantissent la stabilité et la sécurité. Par exemple, un administrateur ne peut pas modifier son propre statut, assurant une gestion équitable. Merci de faire partie de notre communauté ! 🌟") }}
    </p>
@endsection

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Afficher un message d'erreur -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- FORMULAIRE DE MODIFICATION -->


                    <div>
                        @foreach($users as $user)
                            <form method="post" action="{{ route('admin.updateUser', ['id' => $user->id]) }}" class="edit-form" data-user-id="{{ $user->id }}" style="display: none;">

                                @csrf

                                <!-- Nom -->
                                <div>
                                    <x-input-label for="name_{{ $user->id }}" :value="__('Nom')"/>
                                    <x-text-input id="name_{{ $user->id }}" name="name_{{ $user->id }}" type="text" class="mt-1 block w-full"
                                                  :value="$user->name" disabled/>
                                </div>

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email_{{ $user->id }}" :value="__('Email')"/>
                                    <x-text-input id="email_{{ $user->id }}" name="email_{{ $user->id }}" type="email" class="mt-1 block w-full"
                                                  :value="$user->email" disabled/>
                                </div>

                                <!-- Modif role -->

                                <div>
                                    <x-input-label for="role_{{ $user->id }}" :value="__('Role')"/>
                                    <select id="role_{{ $user->id }}" name="role" class="mt-1 block w-full" required>
                                        <option value="Logged-in-user" @if($user->role == 'Logged-in-user') selected @endif>Utilisateur connecté</option>
                                        <option value="Supervisor" @if($user->role == 'Supervisor') selected @endif>Superviseur</option>
                                    </select>
                                </div>

                                <br>

                                <x-primary-button>>> Enregistrer</x-primary-button>
                            </form>
                        @endforeach
                    </div>


                    <br>
                    <hr class="my-8">
                    <!-- FIN DU FORMULAIRE DE MODIFICATION -->


                    <!-- AFFICHAGE DES USERS -->
                    <!--EN TETE-->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-2 border-b">Id</th>
                            <th class="py-2 px-2 border-b">Nom</th>
                            <th class="py-2 px-2 border-b">Email</th>
                            <th class="py-2 px-2 border-b">Role</th>
                            <th class="py-2 px-2 border-b">Statut</th>
                            <th class="py-2 px-2 border-b">Date d'inscription</th>
                            <th class="py-2 px-2 border-b">Dernière connexion</th>
                            <th class="py-2 px-2 border-b">MODIFIER</th>
                            <th class="py-2 px-2 border-b">SUPPRIMER</th>
                            <th class="py-2 px-2 border-b">#</th>
                        </tr>
                        </thead>

                        <!--VALEUR TABLEAU -->

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-2 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-2 border-b">@if($user->role == 'Logged-in-user')
                                        Utilisateur connecté
                                    @elseif($user->role == 'Admin')
                                        Administrateur &#128081;
                                    @elseif($user->role == 'Supervisor')
                                        Superviseur &#129352;
                                    @else
                                        Invité
                                    @endif
                                </td>
                                <td class="py-2 px-2 border-b">{{ ($user->user_status == 1) ? 'actif':'non-actif' }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->created_at->timezone('Europe/Brussels')->format('d/m/Y - H:i') }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->lastlogin ? date('d/m/Y - H:i', strtotime($user->lastlogin)) : '/' }}</td>


                                <!------------------------------------------------------------>
                                <td class="py-2 px-2 border-b">
                                    <button
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        onclick="showEditForm({{ $user->id }})"> &#9999;&#65039;
                                    </button>
                                </td><!-- modifier -->

                                <td class="py-2 px-2 border-b">
                                    <button class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        &#128465;&#65039;
                                    </button><!-- supprimer -->
                                </td>
                                <!------------------------------------------------------------>

                                <td class="py-2 px-2 border-b">{{ ($user->id == auth()->user()->id) ? '- Moi -' : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>



                    <script>

                        $(document).ready(function () {
                            // Masquer tous les formulaires d'édition lors du chargement de la page
                            $('.edit-form').hide();
                        });


                        function showEditForm(userId) {
                            console.log('showEditForm called for userId:', userId);

                            // Masquer tous les formulaires d'édition
                            $('.edit-form').hide();

                            // Afficher le formulaire d'édition spécifique à l'utilisateur en utilisant l'ID
                            $('.edit-form[data-user-id="' + userId + '"]').show();
                        }
                    </script>


                </div>
            </div>
        </div>
    </div>
@endsection
