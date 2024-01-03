<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Event extends Model
{
    use HasFactory;

    /**
     * Attributs qui sont assignables de manière massive en utilisant par exemple la méthode create() du controller.
     * ==> Ce sont les champs autorisés à être remplies à partir de la requête HTTP
     *
     * @var array<int, string>
     */
    protected $fillable = [

    ];
}
