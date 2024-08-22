<?php 

require_once('config/dataManager.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $nomeEdificio = $_POST['nomeEdificio'];
    $indirizzo = $_POST['indirizzo'];
    $tipoAnimale = $_POST['tipoAnimale'];
    $temperatura = $_POST['temperatura'];
    $umidita = $_POST['umidita'];
    $P_Iva = $_SESSION['P_Iva'];
  
    $manager = new Data_Manager();
    try {
        
        $manager->insertEdificio($nomeEdificio, $indirizzo, $tipoAnimale, $temperatura, $umidita, $P_Iva);
        $response = [
            'status' => 'success',
            'message' => 'Edificio aggiunto con successo!'
        ];
    }
     catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Errore durante l\'inserimento dell\'edificio ' 
        ];
    }
    // Invia la risposta JSON
    header('Content-Type: application/json'); 
    echo json_encode($response);

}



/*
    $nomeEdificio = 'edificio1';
    $indirizzo = 'strada due';
    $tipoAnimale = 'mucca';
    $temperatura = 33;
    $umidita = 56;
    $P_Iva = $_SESSION['P_Iva'];
    $manager = new Data_Manager();
   $manager -> insertEdificio($nomeEdificio,$indirizzo,$tipoAnimale,$temperatura,$umidita,$P_Iva);

  */

   
?>