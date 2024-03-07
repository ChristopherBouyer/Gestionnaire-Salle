@extends('layouts.app')

@section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 98%;
            margin: 20px auto;
            padding: 20px;
            box-shadow: none;
            border-radius: 8px;
            color: white;
        }

        h2 {
            font-size: 1.5rem;
            color: #3490dc;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .roomCard {
            border-radius: 8px;
            display: flex;
            align-items: center;
            column-gap: 15px;
            color: black;
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

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #1a202c;
            color: #ffffff;
        }

        .btn-edit,
        .btn-delete {
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
            width: 100%;
            text-align: center;
        }

        .add-button:hover {
            background-color: #2779bd;
        }
    </style>
@endsection

@section('content')
    @auth
        <div class="container mx-auto dark:bg-gray-800 p-4 shadow-md mb-4">
            <h2 class="text-2xl font-semibold">Liste des salles</h2>

            @if (session('success'))
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
                            <td>
                                @if ($salle->is_reserved)
                                    <div class="flex flex-col">
                                        <span class="font-semibold">OCCUPÉE</span>
                                        <span class="italic text-xs">jusqu'à 16h</span>
                                    </div>
                                @else
                                    {{ $salle->actual_user }}/{{ $salle->max_user }}
                                @endif
                                </td>
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
            <div style="width: 200px">
                <a href="{{ route('gestion-salles.create') }}" class="add-button mt-4">Ajouter une
                    salle
                </a>
            </div>
        </div>
    @else
        <div class="container mx-auto p-4 shadow-md mb-4">
            <h2 class="text-2xl font-semibold">Liste des salles</h2>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($salles as $salle)
                    @if ($salle->is_reserved)
                        <div class="roomCard bg-white p-4 shadow-md justify-between ring-1 ring-red-500">
                            <div class="flex gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                                <div class="my-auto">
                                    <h3 class="text-lg font-semibold">{{ $salle->nom }}</h3>
                                    {{-- <p>{{ $salle->actual_user }}/{{ $salle->max_user }}</p> --}}
                                </div>
                            </div>
                            <div class="justify-end flex flex-col gap-1">
                                <div class="bg-red-500 rounded-md p-2">
                                    <span class="text-white font-semibold text-center">OCCUPÉE</span>
                                </div>
                                <span class="text-black italic text-sm text-center">jusqu'à 16h</span>
                            </div>
                        </div>    
                    @else
                        <div class="roomCard bg-white p-4 shadow-md justify-between">
                            <div class="flex gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $salle->nom }}</h3>
                                    <p>{{ $salle->actual_user }}/{{ $salle->max_user }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endauth
@endsection
