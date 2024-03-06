@extends('layouts.app')

@section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto; /* Ajout de l'espace en haut */
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

        form {
            margin-top: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 1rem;
        }

        .custom-button {
            background-color: #007b5e;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
            border: none; /* Ajout de cette ligne pour supprimer le style du bouton par défaut */
        }

        .custom-button:hover {
            background-color: #00583e; /* Nouvelle couleur de fond au survol */
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto bg-white p-4 shadow-md mb-4">
        <h2 class="text-2xl font-semibold">Mettre à jour l'utilisateur {{ $user->name }}</h2>

        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'utilisateur:</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="badge" class="block text-sm font-medium text-gray-700">Badge:</label>
                <input type="text" name="badge" value="{{ $user->badge }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <button type="submit" class="custom-button">Mettre à jour</button>
        </form>
    </div>
@endsection
