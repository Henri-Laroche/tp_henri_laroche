@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 text-center">
        <h1 class="text-6xl font-extrabold text-red-500 mb-6">404</h1>
        <p class="text-lg text-gray-700 mb-4">Le lien que vous recherchez est introuvable ou a été supprimé.</p>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-semibold mt-4 inline-block">
            Retour à mon tableau de bord
        </a>
    </div>
@endsection
