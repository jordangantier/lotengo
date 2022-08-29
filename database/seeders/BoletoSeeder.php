<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Boleto;

class BoletoSeeder extends Seeder
{
    public function run()
    {
        $cantidad_numeros = 93;
        $cantidad_boletos = 15000;
        $cantidad_jugadas = 3;
        $cantidad_series = 6;

        $modulo = $cantidad_boletos % $cantidad_series;
        $boletos_x_serie = ($cantidad_boletos - $modulo) / $cantidad_series;
        $emitibles = $boletos_x_serie * $cantidad_series;

        $ciphering = env('CIPHERING');
        $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption_iv = env('ENCRYPTION_IV');
        $encryption_key = env('ENCRYPTION_KEY');

        //Genera el array de números sorteables.
        $boletos = array();
        for ($i = 1; $i <= $cantidad_numeros; $i++) {
            $boletos[$i] = $i;
        }

        //Genera los boletos
        for ($i = 1; $i <= $cantidad_boletos; $i++) {

            //Coloca los boletos en su determinado concurso.
            if ($i >= 1 && $i <= 2500) {
                $concurso = 1;
            }
            if ($i >= 2501 && $i <= 5000) {
                $concurso = 2;
            }
            if ($i >= 5001 && $i <= 7500) {
                $concurso = 3;
            }
            if ($i >= 7501 && $i <= 10000) {
                $concurso = 4;
            }
            if ($i >= 10001 && $i <= 12500) {
                $concurso = 5;
            }
            if ($i >= 12501 && $i <= 15000) {
                $concurso = 6;
            }

            //Crea los tres arrays de boletos.
            for ($n = 1; $n <= $cantidad_jugadas; $n++) {
                $numeros[$n] = array_rand($boletos, 15);
            }

            //Genera el json con todos los números.
            $array_numeros = json_encode(array('1' => $numeros[1], '2' => $numeros[2], '3' => $numeros[3]));

            //Generación de Hash.
            $hasher = $concurso . '|' . $i . '|' . $numeros[1][0] . '|' . $numeros[2][0] . '|' . $numeros[3][0];
            $hash = openssl_encrypt($hasher, $ciphering, $encryption_key, 0, $encryption_iv);
            //$decrypted = openssl_decrypt($hash, $ciphering, $encryption_key, 0, $encryption_iv);

            /*
            Boleto::create([
                'concurso' => $concurso,
                'serie' => $i,
                'hash' => $hash,
                'hasher' => $hasher,
                'numeros' => $array_numeros,
            ]);
            */
        }
    }
}
