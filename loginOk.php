<?php 

require_once('config/dataManager.php');

// Creare un nuovo utente
$manager = new Data_Manager();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
  
$_SESSION['pagina_di_provenienza'] = $_SERVER['REQUEST_URI'];

$P_Iva = $_POST["inputP_Iva"];
$password = $_POST["inputPassword"];
$ricordami = $_POST["ricordami"];



//echo $manager->getPass($username,$password);
$result_array = json_decode($manager->getPass($P_Iva,$password), true);

//if(isset($result_array)){echo $result_array[0]['salt'];}

$password_with_salt_from_db = $password.$result_array[0]['salt']; // $salt_from_db è il salt recuperato dal database
$hashed = $result_array[0]['password'];

// Verifica se la password hashata corrisponde a quella memorizzata nel database
if (password_verify( $password_with_salt_from_db,$hashed)) {
    // Password corretta, concedi l'accesso
    //echo $result_array[0]['password']."passsato";
    $_SESSION['logged_in'] = true;
    $_SESSION['P_Iva'] = $P_Iva; // $username dovrebbe essere l'username dell'utente autenticato
    $_SESSION['nomeAzienda'] = $result_array[0]['nomeAzienda'];

    //$_SESSION['password'] = $password;
    //$_SESSION['ricordami'] = $ricordami ;
    if (isset($ricordami) && $ricordami == 1) {

        $_SESSION['password'] = $password;
        $_SESSION['ricordami'] = 1;

    }else{
        $_SESSION['ricordami'] = 0;
    }
    unset($_SESSION['pagina_di_provenienza']);
    header("Location: home.php");
    exit();
} else {
    // Password non corretta
    //$hashed_password = password_hash($password_with_salt_from_db, PASSWORD_DEFAULT);
    //echo $hashed."<br>".$hashed_password;
    header("Location: login.php");
    exit();
}



?>