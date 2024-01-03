<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Attributs qui sont assignables de manière massive en utilisant par exemple la méthode create() du controller.
     * ==> Ce sont les champs autorisés à être remplies à partir de la requête HTTP
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'registration_date', //Date d'inscription de l'utilisateur
        'role',// Logged-in-user - Admin - Supervisor
        'user_status', //actif ou inactif
    ];

    /**
     * Attributs qui doivent être cahcés lors de la sérialisation, c'est à dire qu'il ne seront pas inclus lorsque le
     * model sera converti en un tableau ou en format JSON (But: protection de informations sensibles comme le mot de
     * passe par exemple)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ces attributs sont convertis en types natifs tels que Dateime automatiquement par Eloquent.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converti cet attribut en type Datetime
        'password' => 'hashed', //Indique qu'il s'agit d'un mot de passe haché
    ];
}
