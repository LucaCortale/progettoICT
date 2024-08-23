<?php
if (isset($_POST['umidita']) && isset($_POST['temperatura']) && isset($_POST['statofan'])) {
    $umidita = $_POST['umidita'];
    $temperatura = $_POST['temperatura'];
    $statoFan = $_POST['statofan'];
    
    // Salva i dati in un file di testo
    file_put_contents('dati_sensore_umidita.txt', $umidita.PHP_EOL, FILE_APPEND);
    file_put_contents('dati_sensore_temperatura.txt', $temperatura.PHP_EOL, FILE_APPEND);
    file_put_contents('dati_stato_ventola.txt', $statoFan.PHP_EOL, FILE_APPEND);
    
    echo "Dati ricevuti e salvati.";
} else {
    echo "Nessun dato ricevuto.";
}
?>
