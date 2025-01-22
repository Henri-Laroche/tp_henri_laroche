<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends Factory<ShortLink>
 */
class ShortLinkFactory extends Factory
{
    protected $model = ShortLink::class; // Modèle associé à cette factory

    public function definition(): array
    {
        return [
            'users_id' => User::factory(), // Crée un utilisateur lié
            'original_url' => $this->faker->url, // Génère une URL aléatoire
            'short_url' => Str::random(7), // Génère une chaîne aléatoire de 7 caractères
            'click_count' => 0, // Par défaut, aucun clic
        ];
    }
}
