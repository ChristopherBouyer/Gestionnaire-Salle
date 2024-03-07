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

        h3 {
            font-size: 1.2rem;
            color: #3490dc;
            margin: 1.5rem 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            color: white;
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
    </style>
@endsection

@section('content')
    <div class="container mx-auto dark:bg-gray-800 p-4 shadow-md mb-4">
        <h2 class="text-2xl font-semibold">{{ $salle->nom }}</h2>

        <div class="card-body">
            <p><strong>Capacité :</strong> {{ $salle->max_user }} places</p>
            <p>Utilisation actuelle : {{ $salle->actual_user }}</p>
        </div>
        <h3>Rapport d'utilisation</h3>
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Heure d'entrée</th>
                    <th>Heure de sortie</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->student_name }}</td>
                        <td>{{ $log->arrival }}</td>
                        <td>{{ $log->departure }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Aucune donnée trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>
@endsection
