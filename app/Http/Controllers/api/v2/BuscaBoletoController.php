<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Boleto;

use App\Models\Sorteo;

class BuscaBoletoController extends Controller
{
    public function index()
    {
        $result = Boleto::select('id', 'concurso', 'contador1', 'contador2', 'contador3', 'numeros')
            ->whereBetween('id', [1, 7500])
            ->where('habilitado', 1)
            ->get();
        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontraron boletos habilitados.'];
            return response()->json($data, 200);
        }
        return $result;
    }

    public function show($sorteo, $juego, $numero)
    {
        //Establece que contador deberá ser utilizado.
        $nameContador = 'contador' . $juego;

        //Revisa si existe el número de sorteo.
        if ($sorteo == 1) {
            $sort1 = 1;
            $sort2 = 2500;
        } elseif ($sorteo == 2) {
            $sort1 = 2501;
            $sort2 = 5000;
        } elseif ($sorteo == 3) {
            $sort1 = 5001;
            $sort2 = 7500;
        } else {
            $data = ['msg' => 'No se encontró este sorteo.'];
            return response()->json($data, 200);
        }

        //Revisa si se encontró el número de juego
        if (!$juego || $juego < 1 || $juego > 3) {
            $data = ['msg' => 'No se encontró el número de juego.'];
            return response()->json($data, 200);
        }

        //Busca los boletos habilitados para la serie y el sorteo.
        $result = Boleto::select('id', $nameContador)
            ->whereBetween('id', [$sort1, $sort2])
            ->where('habilitado', 1)
            ->whereJsonContains('numeros->' . $juego, json_decode($numero))
            ->get();

        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontraron boletos habilitados.'];
            return response()->json($data, 200);
        }
        return $result;
    }

    public function update($sorteo, $juego, $numero)
    {
        //Establece que contador deberá ser utilizado.
        $nameContador = 'contador' . $juego;

        //Revisa si existe el número de sorteo y asigna el rango de boletos para dicho sorteo.
        if ($sorteo == 1) {
            $sort1 = 1;
            $sort2 = 2500;
        } elseif ($sorteo == 2) {
            $sort1 = 2501;
            $sort2 = 5000;
        } elseif ($sorteo == 3) {
            $sort1 = 5001;
            $sort2 = 7500;
        } else {
            $data = ['msg' => 'No se encontró este sorteo.'];
            return response()->json($data, 200);
        }

        //Revisa si se encontró el número de juego.
        if (!$juego || $juego < 1 || $juego > 3) {
            $data = ['msg' => 'No se encontró el número de juego.'];
            return response()->json($data, 200);
        }

        //Busca todas las coincidencias en la tabla de boletos.
        $result = Boleto::select('id', $nameContador)
            ->whereBetween('id', [$sort1, $sort2])
            ->where('habilitado', 1)
            ->whereJsonContains('numeros->' . $juego, json_decode($numero))
            ->get();

        if (json_decode($result) == []) {
            $data = ['msg' => 'No se encontró el número en ninguno de los boletos.'];
            return response()->json($data, 200);
        }

        //Actualiza el contador de la jugada a la cantidad de números faltantes para hacer bingo.
        foreach ($result as $num) {
            $descontar = Boleto::find($num->id);
            $descontar->$nameContador = $num->$nameContador - 1;
            $descontar->update();
        }

        //Guarda el número en la tabla de sorteos.
        $sorteos = new Sorteo;
        $sorteos->sorteo = $sorteo;
        $sorteos->jugada = $juego;
        $sorteos->numero = $numero;
        $sorteos->save();

        $data = ['msg' => 'Se actualizó el contador de números acertados.'];
        return response()->json($data, 200);
    }
}
