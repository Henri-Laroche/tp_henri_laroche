<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class DashboardController extends Controller
{
    public function index(): View|Factory|Application
    {
        // Récupérer uniquement les liens de l'utilisateur connecté
        $shortLinks = ShortLink::where('users_id', auth()->id())
            ->paginate(5);  // Afficher 5 liens par page

        // Retourner la vue avec les liens de l'utilisateur
        return view('dashboard', compact('shortLinks'));
    }
}



