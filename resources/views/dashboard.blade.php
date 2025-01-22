@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-6">
        <h2 class="text-2xl text-black font-bold mb-4">Mes liens courts</h2>

        {{-- Formulaire pour créer un lien court --}}
        <form action="{{ route('short-links.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="url" name="original_url" placeholder="Entrer une URL" class="border p-2 rounded" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Créer</button>
        </form>

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Liste des liens courts --}}
        @if ($shortLinks->isEmpty())
            <p class="text-gray-500 ">Aucun lien court trouvé.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                <tr>
                    <th class="border text-black border-gray-300 p-2">Lien Court</th>
                    <th class="border text-black border-gray-300 p-2">URL</th>
                    <th class="border text-black border-gray-300 p-2">Clicks</th>
                    <th class="border text-black border-gray-300 p-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shortLinks as $link)
                    <tr>
                        <td class="border border-gray-300 p-2">
                            <a href="{{ url($link->short_url) }}" target="_blank" class="text-blue-500">
                                {{ url($link->short_url) }}
                            </a>
                        </td>
                        <td class="border text-black border-gray-300 p-2">{{ $link->original_url }}</td>
                        <td class="border text-black border-gray-300 p-2">{{ $link->click_count }}</td>
                        <td class="border text-white border-gray-300 p-2">
                            {{-- Supprimer --}}
                            <form action="{{ route('short-links.destroy', $link->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white p-1 rounded">Supprimer</button>
                            </form>

                            {{-- Modifier --}}
                            <form action="{{ route('short-links.update', $link->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')  <!-- Utiliser PUT pour la mise à jour -->
                                <input type="url" name="original_url" value="{{ old('original_url', $link->original_url) }}" class="border p-2 rounded" required>
                                <button type="submit" class="bg-yellow-500 text-white p-1 rounded">Modifier</button>
                            </form>

                            {{-- Copier dans le presse-papiers --}}
                            <button onclick="navigator.clipboard.writeText('{{ url($link->short_url) }}')" class="bg-green-500 text-white p-1 rounded">
                                Copier
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-2">
                {{ $shortLinks->links() }}
            </div>
        @endif
    </div>
@endsection
