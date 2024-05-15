<?php
require_once('dbconnection.php');
require_once('classi.php');

class Data_Manager {
    private $conn;

    public function __construct() {
        $db = new DB_Connection();
        $this->conn = $db->conn;
    }

    // Metodo per inserire un nuovo utente nel database
    public function insertUser($nome,$cognome,$email,$password,$username) {
        
        $sql = "INSERT INTO UTENTE (nome, cognome,username, email, password,salt) VALUES (?, ?,?, ?, ?,?)";
        if ($statement = $this->conn->prepare($sql) ) {
            $salt = bin2hex(random_bytes(16));
            $password_with_salt = $password.$salt;
            $hashed_password = password_hash($password_with_salt, PASSWORD_DEFAULT);


            $statement->bind_param("ssssss",$nome,$cognome,$username,$email,$hashed_password,$salt);
            $statement->execute();
            echo "TOOP";
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->close();
        $this->conn->close();
    }

    // Metodo per recuperare tutti gli utenti dal database
    public function getAllUsers() {
        $sql = "SELECT * FROM UTENTE";
        $result = $this->conn->query($sql);
        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function getCircoloUtente($nome,$cognome) {
        $circolo = "Nessun Circolo";
        
        $sql = "SELECT circolo FROM utente as u WHERE u.nome = ? && u.cognome = ?";
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("ss",$nome,$cognome);
            $statement->execute();
            //echo "TOOP";
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->bind_result($circolo);

        // Ciclo sui risultati
        if ($statement->fetch()) {
            
            return $circolo;
            
        }else{
            //echo "$circolo";
            return $circolo;
        }
        
    }

    public function getPass($username,$password) {
        
        $salt="";
        $id_utente="";
       

        $sql = "SELECT id_utente, username, password, salt FROM utente WHERE username = ?";
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("s",$username);
            $statement->execute();
            
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->bind_result($id_utente,$username,$password,$salt);
        while ($statement->fetch()) {
            // Creare un array associativo con i risultati
                $row = array(
                    'username' => $username,
                    'password' => $password,
                    'salt' => $salt
        
                );
                // Aggiungere l'array alla lista dei risultati
                $result_array[] = $row;
            }
            $statement->close();
            $this->closeConnection();
        // Restituire l'array dei risultati
            $json_data = json_encode($result_array);
            return  $json_data;
     
        // Combina la password con il salt memorizzato nel database
   
        
    }

    // Metodo per aggiornare i dati di un utente nel database
    public function updateUser($id, $nome, $cognome, $email) {
        $sql = "UPDATE users SET nome='$nome', cognome='$cognome', email='$email' WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Metodo per eliminare un utente dal database
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }



    public function getAllTornei() {
        $sql = "SELECT nomeTorneo FROM TORNEO";
        $result = $this->conn->query($sql);
        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        $this->closeConnection();
        return $users;
        
    }

    public function getAllPartite() {
        $sql = "SELECT * FROM PARTITE";
        $result = $this->conn->query($sql);
        $partite = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $partite[] = $row;
            }
        }
        return $partite;
    }

    public function getAllPartiteGiocatore($nome,$cognome) {
        $sql = "SELECT nomeGiocatore,cognomeGiocatore,hcp,punteggio,circolo 
                FROM partite as p WHERE p.nomeGiocatore = ? && p.cognomeGiocatore = ?";
        
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("ss",$nome,$cognome);
            $statement->execute();
            //echo "TOOP";
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $nomeGiocatore="";
        $cognomeGiocatore="";
        $hcp="";
        $punteggio="";
        $circolo="";

        $statement->bind_result($nomeGiocatore,$cognomeGiocatore,$hcp,$punteggio,$circolo);

       $result_array = array(); // Array per memorizzare i risultati

    while ($statement->fetch()) {
    // Creare un array associativo con i risultati
    if($circolo == null){ $circolo = "nessun circolo";}
        $row = array(
            'nome' => $nome,
            'cognome' => $cognome,
            'hcp' => $hcp,
            'punteggio' => $punteggio,
            'circolo'=>$circolo

        );
        // Aggiungere l'array alla lista dei risultati
        $result_array[] = $row;
    }

    $statement->close();
    $this->closeConnection();
// Restituire l'array dei risultati
    return $result_array;
        
    
    }

    public function closeConnection(){
        $this->conn->close();
        
    }
}
?>
