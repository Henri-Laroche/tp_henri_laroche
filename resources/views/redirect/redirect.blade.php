@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12 text-center">
        <h1 class="text-xl md:text-6xl font-extrabold text-black mb-6">
            Page de Redirection
        </h1>
            <p class="text-lg text-black mb-4">Vous êtes redirigé automatiquement:
            </p>
        <p class="text-lg text-black mb-4">Ou vous pouvez revenir au tableau de bord.</p>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold mt-4 inline-block">
            Retour à mon tableau de bord
        </a>
    </div>
@endsection
