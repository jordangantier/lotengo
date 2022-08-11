<?php
$servername = "localhost";
$database = "lotengo";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Falló la conexión: " . mysqli_connect_error());
}

//echo "Conectado con éxito!<br>";

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

echo ('@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;@imagenes;numero<br>');
//Genera los 10000 boletos
for ($i = 1; $i <= 15000; $i++) {

    //Pone todos los boletos generados como deshabilitados.
    $habilitado = 0;

    //Genera la serie
    $serie = sprintf("%05d", $i);

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
    $jsonNums = json_encode($numeros);

    //Genera el array de números

    $nums1 = null;
    foreach ($numeros[1] as $num) {
        $nums1 .= $num . '.jpg;';
    }
    $nums1 = substr($nums1, 0, -1);

    $nums2 = null;
    foreach ($numeros[2] as $num) {
        $nums2 .= $num . '.jpg;';
    }
    $nums2 = substr($nums2, 0, -1);

    $nums3 = null;
    foreach ($numeros[3] as $num) {
        $nums3 .= $num . '.jpg;';
    }
    $nums3 = substr($nums3, 0, -1);


    //Generación de Hash.
    $hasher = $concurso . '|' . $serie . '|' . $numeros[1][0] . '|' . $numeros[2][0] . '|' . $numeros[3][0];
    $hash = openssl_encrypt($hasher, $ciphering, $encryption_key, $options, $encryption_iv);

    $sql = "INSERT INTO boletos (habilitado, concurso, serie, hasher, hash, numeros, contador, created_at) VALUES ($habilitado, $concurso, $serie, '$hasher', '$hash', '$jsonNums', 15, CURRENT_TIMESTAMP())";
    if (mysqli_query($conn, $sql)) {
        echo $nums1 . ';';
        echo $nums2 . ';';
        echo $nums3 . ';';
        echo $serie . '<br>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
