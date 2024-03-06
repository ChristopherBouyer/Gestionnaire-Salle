@extends('layouts.app')

@section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 98%; /* Modification ici pour prendre toute la largeur */
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            font-size: 1.5rem;
            color: #3490dc;
            margin-bottom: 1.5rem;
        }

        .success-message {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #1a202c;
            color: #ffffff;
        }

        .btn-edit, .btn-delete {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #f39c12;
            color: #ffffff;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .btn-edit:hover {
            background-color: #d08c10;
        }

        .btn-delete:hover {
            background-color: #cc4537;
        }

        .add-button {
            display: inline-block;
            padding: 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            color: #ffffff;
            background-color: #3490dc;
            transition: background-color 0.3s;
            width: 100%; /* Modification ici pour prendre toute la largeur */
            text-align: center; /* Pour centrer le texte */
        }

        .add-button:hover {
            background-color: #2779bd;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto bg-white p-4 shadow-md mb-4">
        <h2 class="text-2xl font-semibold">Liste des salles</h2>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nom salle</th>
                    <th>Nombre de places prises</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salles as $salle)
                    <tr>
                        <td>{{ $salle->nom }}</td>
                        <td>{{ $salle->actual_user }}/{{ $salle->max_user }}</td>
                        <td>
                            <div class="space-x-2">
                                <a href="{{ route('gestion-salles.edit', $salle->id) }}" class="btn-edit">Modifier</a>
                                <form action="{{ route('gestion-salles.destroy', $salle->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">Aucune salle disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('gestion-salles.create') }}" class="add-button mt-4">Ajouter une salle</a>
    </div>
@endsection
