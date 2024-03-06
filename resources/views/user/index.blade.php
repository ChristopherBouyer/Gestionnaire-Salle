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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: white;
        }

        h2 {
            font-size: 1.5rem;
            color: #3490dc;
            margin-bottom: 1.5rem;
            text-align: center;
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

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3490dc;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #2779bd;
        }

        .btn-edit {
            background-color: #f39c12;
            color: #ffffff;
        }

        .btn-edit:hover {
            background-color: #d08c10;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .btn-delete:hover {
            background-color: #cc4537;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto dark:bg-gray-800 p-4 shadow-md mb-4">
        <h2 class="text-2xl font-semibold">Liste des étudiants</h2>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nom de l'étudiant</th>
                    <th>Badge</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->badge }}</td>
                        <td>
                            <div class="space-x-2">
                                <a href="{{ route('user.edit', $student->id) }}" class="btn btn-edit">Modifier</a>
                                <form action="{{ route('user.destroy', $student->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('user.create') }}" class="btn btn-primary mt-4">Ajouter un utilisateur</a>
    </div>
@endsection
