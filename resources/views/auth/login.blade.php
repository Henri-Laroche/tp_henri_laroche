@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl text-black font-bold mb-4">Connexion</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-black font-medium mb-2">Adresse e-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full p-2 border rounded"
                    value="{{ old('email') }}"
                    required>
                @error('email')
                <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-black font-medium mb-2">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full p-2 border rounded"
                    required>
                @error('password')
                <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">
                Se connecter
            </button>
        </form>
    </div>
@endsection
