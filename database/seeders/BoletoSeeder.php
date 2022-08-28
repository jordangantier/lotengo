<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Boleto;

class BoletoSeeder extends Seeder
{
    public function run()
    {
        //Marcas generadas
        $boletos = array();
        for ($i = 1; $i <= 93; $i++) {
            $boletos[$i] = $i;
        }

        // Storingthe cipher method 
        $ciphering = "AES-128-CTR";
        // Using OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options   = 0;
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '7076405498371295';
        // Storing the encryption key 
        $encryption_key = "WHEKE.DEV@Las Brisas";

        //Genera los 10000 boletos
        for ($i = 1; $i <= 15000; $i++) {

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
            for ($n = 1; $n <= 3; $n++) {
                $numeros[$n] = array_rand($boletos, 15);
            }

            //Genera el json con todos los números.
            $array_numeros = json_encode(array($numeros[1], $numeros[2], $numeros[3]));

            //Generación de Hash.
            $hasher = $concurso . '|' . $i . '|' . $numeros[1][0] . '|' . $numeros[2][0] . '|' . $numeros[3][0];
            $hash = openssl_encrypt($hasher, $ciphering, $encryption_key, $options, $encryption_iv);

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
