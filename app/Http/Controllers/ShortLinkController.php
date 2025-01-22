<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortLink = ShortLink::create([
            'users_id' => auth()->id(),
            'original_url' => $request->original_url,
            'short_url' => Str::random(7), // Génération d'un code aléatoire de 7 caractères
        ]);

        return redirect()->route('dashboard')->with('success', 'Lien court créé : ' . $shortLink->short_url);
    }

    public function destroy($id): RedirectResponse
    {
        $shortLink = ShortLink::where('id', $id)
            ->where('users_id', auth()->id())
            ->firstOrFail();

        $shortLink->delete();

        return redirect()->route('dashboard')->with('success', 'Lien court supprimé avec succès.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Récupérer le lien correspondant à l'ID et à l'utilisateur connecté
        $shortLink = ShortLink::where('id', $id)
            ->where('users_id', auth()->id())
            ->firstOrFail();

        // Mettre à jour l'URL originale
        $shortLink->update([
            'original_url' => $request->original_url,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Lien court mis à jour avec succès.');
    }

    public function redirect($shortUrl): Response|RedirectResponse
    {
        // Chercher le lien court dans la base de données
        $shortLink = ShortLink::where('short_url', $shortUrl)->first();


        if (!$shortLink) {
            // Retourne une URL
            return response()->view('redirect.redirect', [], 302);
        }

        // Incrémentation du compteur de clics
        $shortLink->increment('click_count');

        // Redirection vers l'URL d'origine avec code HTTP 301 (redirection permanente)
        return redirect()->to($shortLink->original_url);
    }


}
