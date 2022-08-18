<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Transaccion;

use App\Models\Participante;

use App\Models\Boleto;

class TransaccionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['id_participante'] == "") {

            //Guarda un nuevo participante.
            $participante = new Participante();
            $participante['nombre'] = $request->nombre;
            $participante['ci_nit'] = $request->ci_nit;
            $participante['fecha_nac'] = $request->fecha_nac;
            $participante['telefono'] = $request->telefono;
            $participante['email'] = $request->email;
            $participante['created_at'] = Carbon::now();
            $participante->save();
            $id_part = Participante::select('id')->where('ci_nit', $request->ci_nit)->get();

            //Guarda la transacción.
            $transaccion = new Transaccion();
            $transaccion['id_participante'] = $id_part[0]->id;
            $transaccion['monto_acumulado'] = $request['monto_acumulado'];
            $transaccion['qty_boletos'] = $request['qty_boletos'];
            $transaccion['facturas'] = $request['facturas'];
            $transaccion['habilitados'] = $request['habilitados'];
            $transaccion['created_at'] = Carbon::now();
            $transaccion->save();

            //Habilita los boletos en la DB.
            $array = json_decode($transaccion['habilitados']);
            foreach ($array as $value) {
                $habilitar = Boleto::find($value);
                $habilitar->habilitado = 1;
                $habilitar->update();
            }
        } else {
            //Guarda la transacción.
            $transaccion = new Transaccion();
            $transaccion['id_participante'] = $request['id_participante'];
            $transaccion['monto_acumulado'] = $request['monto_acumulado'];
            $transaccion['qty_boletos'] = $request['qty_boletos'];
            $transaccion['facturas'] = $request['facturas'];
            $transaccion['habilitados'] = $request['habilitados'];
            $transaccion['created_at'] = Carbon::now();
            $transaccion->save();

            //Habilita los boletos en la DB.
            $array = json_decode($transaccion['habilitados']);
            foreach ($array as $value) {
                $habilitar = Boleto::find($value);
                $habilitar->habilitado = 1;
                $habilitar->update();
            }
        }
        return json_decode('[{"msg":"OK"}]');
    }
}
