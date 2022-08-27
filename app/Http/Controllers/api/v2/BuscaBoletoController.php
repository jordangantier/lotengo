<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Boleto;

class BuscaBoletoController extends Controller
{
    public function index()
    {
        $result = Boleto::select('id', 'contador')
            ->whereBetween('id', [1, 2500])
            ->where('habilitado', 1)
            ->get();
        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontraron boletos habilitados.'];
            return response()->json($data, 200);
        }
        return $result;
    }

    public function show($numero)
    {
        $result = Boleto::select('id', 'contador')
            ->whereBetween('id', [1, 2500])
            ->where('habilitado', 1)
            ->whereJsonContains('numeros->1', json_decode($numero))
            ->get();
        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontraron boletos con este número.'];
            return response()->json($data, 200);
        }
        return $result;
    }

    public function update($numero)
    {
        $result = Boleto::select('id', 'contador')
            ->whereBetween('id', [1, 2500])
            ->where('habilitado', 1)
            ->whereJsonContains('numeros->1', json_decode($numero))
            ->get();
        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontró el número en ninguno de los boletos.'];
            return response()->json($data, 200);
        }
        foreach ($result as $numero) {
            $descontar = Boleto::find($numero->id);
            $descontar->contador = $numero->contador - 1;
            $descontar->update();
        }
        $data = ['msg' => 'Se actualizó el contador de números acertados.'];
        return response()->json($data, 200);
        //return $result;
    }
}
