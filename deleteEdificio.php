<?php 

require_once('config/dataManager.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $id = $_POST['id'];
  
    $manager = new Data_Manager();
    try {
        $manager->deleteEdificio($id);
        $response = [
            'status' => 'success',
            'message' => 'Edificio eliminato con successo!'
        ];
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Errore durante l\'inserimento dell\'edificio: ' . $e->getMessage()
        ];
    }
    // Invia la risposta JSON
    header('Content-Type: application/json'); 
    echo json_encode($response);

}
 
?>