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
        return $participantes;
    }
}
