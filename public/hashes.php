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
$sql = "SELECT `hash` FROM `boletos` ORDER BY `id`";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    echo $row['hash'] . "<br>";
}

mysqli_close($conn);
