<?php
    header('Content-Type: application/json');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'config/dataManager.php';
    //error_log("ID: $id, Nome: $nome, Cognome: $cognome, Email: $email, Username: $username, Telefono: $telefono, nTessera: $nTessera, Circolo: $circolo");
    //print_r($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'] ?? null;
      $nomeEdificio = $_POST['nome']?? null;
      $indirizzo = $_POST['indirizzo']?? null;
      $tipoAnimale = $_POST['tipoAnimale']?? null;
      $tLimite = $_POST['temperatura']?? null;
      $uLimite = $_POST['umidita']?? null;

      
      $manager = new Data_Manager();
     
 
      if ($manager->isUnique('nome_edificio', $nomeEdificio, $id)) { //&& $manager->isUnique('indirizzo', $indirizzo, $id)) {
         if ($manager->updateEdificio($id, $nomeEdificio,$indirizzo, $tipoAnimale, $tLimite, $uLimite)) {
            
            $response['status'] = 'success';
            $response['message'] = 'Modifiche salvate con successo!';
         } 
     } else {
         
         $response['status'] = 'error';
        $response['message'] = 'Nome edificio già esistente.';
     }
   } else {
    $response['status'] = 'error';
    $response['message'] = 'Richiesta non valida.';
     
 }
 echo json_encode($response);
    
   
