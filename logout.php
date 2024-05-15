<?php

    session_start();
  
// Distruggi tutte le variabili di sessione
//session_destroy();
// Reindirizza l'utente alla pagina di login o a un'altra pagina

//unset($_SESSION['pagina_di_provenienza']);GIA DISTRUTTA
unset($_SESSION['logged_in']);
header('Location: home.php');
exit;
?>
