<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;

class DatosImpresionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toPrint = Transaccion::select('transaccions.id as id_transaccion', 'users.name as usuario', 'nombre', 'ci_nit', 'telefono', 'participantes.email', 'transaccions.created_at as fecha', 'monto_acumulado', 'qty_boletos', 'habilitados')
            ->join('participantes', 'participantes.id', '=', 'transaccions.id_participante')
            ->join('users', 'users.id', '=', 'transaccions.id_user')
            ->orderBy('id_transaccion', 'DESC')
            ->get();

        if ($toPrint == '[]') {
            $toPrint = json_decode('[{"msg":"No hay datos para imprimir."}]');
        }
        return $toPrint;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toPrint = Transaccion::select('transaccions.id as id_transaccion', 'users.name as usuario', 'nombre', 'ci_nit', 'telefono', 'participantes.email', 'transaccions.created_at as fecha', 'monto_acumulado', 'qty_boletos', 'habilitados')
            ->join('participantes', 'participantes.id', '=', 'transaccions.id_participante')
            ->join('users', 'users.id', '=', 'transaccions.id_user')
            ->where('ci_nit', $id)
            ->orderBy('id_transaccion', 'DESC')
            ->limit(1)
            ->get();

        if ($toPrint == '[]') {
            $toPrint = json_decode('[{"msg":"No hay datos para imprimir."}]');
        }
        return $toPrint;
    }
}
