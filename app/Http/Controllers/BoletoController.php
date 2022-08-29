<?php

namespace App\Http\Controllers;

use App\Models\Boleto;

class BoletoController extends Controller
{
    public function index()
    {
        $boletos = Boleto::select('serie')->where('habilitado', 0)->where('concurso', 1)->get();
        if (json_decode($boletos) == []) {
            $data = ['msg' => 'No se encontraron boletos No Habilitados en esta serie.'];
            return response()->json($data, 200);
        }
        return $boletos;
    }
}
