<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    /**
     * Attributs qui sont assignables de manière massive en utilisant par exemple la méthode create() du controller.
     * ==> Ce sont les champs autorisés à être remplies à partir de la requête HTTP
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'event_name',
       'date', //Date de l'évènement
       'time', //Heure de l'évènement
       'location', // Lieu de l'évènement
       'location_description', //Description du lieu de l'évènement
       'min_people',
       'max_people',
       'type', // Type de l'évènement (extérieur ou intérieur)
       'people_type', //Types de participants (entre parents ou entre parents-enfants)
       'status', //Status de l'évènement (actif ou inactif)
       'user_id', //Clé étrangère liée à la table 'users'
    ];


    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_events')->withTimestamps();
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
