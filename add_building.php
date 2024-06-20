<?php require 'index.php';

require_once('config/dataManager.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeEdificio = $_POST['nomeEdificio'];
    $indirizzo = $_POST['indirizzo'];
    $tipoAnimale = $_POST['tipoAnimale'];
    $temperatura = $_POST['temperatura'];
    $umidita = $_POST['umidita'];

   $manager = new Data_Manager();
   $manager -> insertEdificio($nomeEdificio,$indirizzo,$tipoAnimale,$temperatura,$umidita);
}
?>

