<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('user.index', compact('students'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:students',
            'badge' => 'required|unique:students|max:25',
        ]);

        $newstudent = Student::create([
            'name' => $request->name,
            'badge' => $request->badge,
        ]);

        return redirect('/user')->with('success', 'Utilisateur ajouté avec succès!');
    }

    public function edit(Student $student)
    {
        return view('user.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|unique:students,name,' . $student->id,
            'badge' => 'unique:students,badge,' . $student->id,
        ]);

        $student->update([
            'name' => $request->name,
            'badge' => $request->badge,
        ]);

        return redirect('/user')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/user')->with('success', 'Utilisateur supprimé avec succès!');
    }
}
