<?php
if (isset($_POST['umidita']) && isset($_POST['temperatura']) && isset($_POST['statofan']) && isset($_POST['statopump'])) {
    $umidita = $_POST['umidita'];
    $temperatura = $_POST['temperatura'];
    $statoFan = $_POST['statofan'];
    $statoFan = $_POST['statopump'];

    $date = date("M_Y");
    
    // Salva i dati in un file di testo
    file_put_contents("dati_sensore_umidita_".$date.".txt", $umidita.PHP_EOL, FILE_APPEND);
    file_put_contents("dati_sensore_temperatura_".$date.".txt", $temperatura.PHP_EOL, FILE_APPEND);
    file_put_contents("dati_stato_ventola_".$date.".txt", $statoFan.PHP_EOL, FILE_APPEND);
    file_put_contents("dati_stato_pompa_".$date.".txt", $statoFan.PHP_EOL, FILE_APPEND);
    
    echo "Dati ricevuti e salvati.";
} else {
    echo "Nessun dato ricevuto.";
}
?>
