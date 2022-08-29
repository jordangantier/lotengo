<?php

namespace App\Http\Controllers;

use App\Models\Participante;

class ParticipanteController extends Controller
{
    public function index()
    {
        $participantes = Participante::select('id', 'ci_nit', 'nombre', 'telefono', 'email', 'fecha_nac')->get();

        if (json_decode($participantes) == []) {
            $data = ['msg' => 'Participante no registrado en el sistema.'];
            return response()->json($data, 200);
        }
        return $participantes;
    }
}
