<?php
if (isset($_POST['comando'])) {
    $comando = $_POST['comando'];  // Il comando da inviare

    // Indirizzo IP del tuo Arduino
    $arduinoIP = '192.168.1.12';

    // Funzione per inviare il comando all'Arduino
    function inviaComandoArduino($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Errore nella richiesta cURL: ' . curl_error($ch);
        }

        curl_close($ch);
        return $output;
    }

    // Determina il comando da inviare (on/off) basato sulla richiesta
    if ($comando === "onFan") {
        inviaComandoArduino("http://".$arduinoIP."/ventola?stato=on");
        echo "Ventola accesa!";
    } elseif ($comando === "offFan") {
        inviaComandoArduino("http://".$arduinoIP."/ventola?stato=off");
        echo "Ventola spenta!";
    } elseif ($comando === "onPump") {
        inviaComandoArduino("http://".$arduinoIP."/pompa?stato=on");
        echo "Pompa accesa!";
    } elseif ($comando === "offPump") {
        inviaComandoArduino("http://".$arduinoIP."/pompa?stato=off");
        echo "Pompa spenta!";
    } 
} else {
    echo "Nessun comando ricevuto!";
}
?>