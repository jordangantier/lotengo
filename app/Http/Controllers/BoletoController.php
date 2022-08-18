<?php

namespace App\Http\Controllers;

use App\Models\Boleto;

class BoletoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boletos = Boleto::select('serie')->where('habilitado', 0)->where('concurso', 1)->get();
        return $boletos;
    }
}
