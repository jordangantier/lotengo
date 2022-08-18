<?php

namespace App\Http\Controllers;

use App\Models\Participante;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participantes = Participante::select('id', 'ci_nit', 'nombre', 'telefono', 'email', 'fecha_nac')->get();
        if ($participantes == '[]') {
            $participantes = json_decode('[{"msg":"Participante no registrado en el sistema."}]');
        }
        return $participantes;
    }
}
