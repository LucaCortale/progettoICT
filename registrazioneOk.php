<?php
require_once('config/dataManager.php');

// Creare un nuovo utente
$manager = new Data_Manager();

$nome = $_POST["inputNome"];
$cognome = $_POST["inputCognome"];
$email = $_POST["inputEmail"];
$password = $_POST["inputPassword"];
$p_iva = $_POST["inputP_Iva"];
$nomeAzienda = $_POST["inputNomeAzienda"];
$telefono = $_POST["inputTelefono"];
$indirizzo = $_POST["inputIndirizzo"];

//echo $username."<br>".$password;
$manager->insertUser($nome,$cognome,$email,$password,$p_iva,$telefono,$indirizzo,$nomeAzienda);
//$manager->closeConnection(); // Chiudi la connessione al database
header('Location: login.php');
?>
