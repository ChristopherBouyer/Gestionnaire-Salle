<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Salle;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('rfidData') && $request->has('arduinoID')) {
            $rfidData = $request->input('rfidData');
            $arduinoID = $request->input('arduinoID');

            $salle = Salle::where('system_id', $arduinoID)->first();

            if ($salle) {
                $student = Student::where('badge', $rfidData)->first();

                if ($student) {
                    if ($student->salles()->where('salle_id', $salle->id)->exists()) {
                        $student->salles()->updateExistingPivot($salle->id, ['departure' => now()]);
                        $salle->actual_user -= 1;
                        $salle->save();
                        return response()->json(['name' => $student->name, 'exit' => true], 200);
                    } else {
                        if ($salle->actual_user < $salle->max_user) {
                            $student->salles()->attach($salle->id, ['arrival' => now()]);
                            $salle->actual_user += 1;
                            $salle->save();
                            return response()->json(['name' => $student->name, 'exit' => false], 200);
                        } else {
                            return response()->json(['error' => 'max_user'], 400);
                        }
                    }
                } else {
                    return response()->json(['error' => 'User not found'], 404);
                }
            } else {
                return response()->json(['error' => 'Salle not found'], 404);
            }
        } else {
            return response()->json(['error' => 'not_provided'], 400);
        }
    }
}
