<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GestionSallesController extends Controller
{
    public function index()
    {
        $salles = Salle::orderBy('is_reserved', 'asc')->get();

        return view('gestion-salles.index', compact('salles'));
    }


    public function show($id)
    {
        $salle = Salle::with('users')->findOrFail($id);

        $logs = DB::table('user_salle')
            ->join('students', 'user_salle.student_id', '=', 'students.id')
            ->where('user_salle.salle_id', $id)
            ->get(['user_salle.*', 'students.name as student_name']);

        return view('gestion-salles.show', compact('salle', 'logs'));
    }


    public function create()
    {
        return view('gestion-salles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:salles',
            'system_id' => 'required|unique:salles',
            'max_user' => 'required|integer|min:1',
        ]);

        Salle::create([
            'nom' => $request->nom,
            'system_id' => $request->system_id,
            'max_user' => $request->max_user,
            'actual_user' => 0
        ]);

        return redirect('/')->with('success', 'Salle ajoutée avec succès!');
    }

    public function edit(Salle $salle)
    {
        return view('gestion-salles.edit', compact('salle'));
    }

    public function update(Request $request, Salle $salle)
    {
        $isReserved = $request->input('is_reserved', 0);

        $request->validate([
            'nom' => 'required|unique:salles,nom,' . $salle->id,
            'max_user' => 'required|integer|min:1',
        ]);

        $salle->update([
            'nom' => $request->nom,
            'max_user' => $request->max_user,
            'is_reserved' => $isReserved
        ]);

        return redirect('/')->with('success', 'Salle mise à jour avec succès!');
    }

    public function destroy(Salle $salle)
    {
        $salle->delete();

        return redirect('/')->with('success', 'Salle supprimée avec succès!');
    }
}
