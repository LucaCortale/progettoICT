<?php
require_once('dbconnection.php');
//require_once('classi.php');

class Data_Manager {
    private $conn;

    public function __construct() {
        $db = new DB_Connection();
        $this->conn = $db->conn;
    }

    // Metodo per inserire un nuovo utente nel database
    public function insertUser($nome,$cognome,$email,$password,$p_iva,$telefono,$indirizzo,$nomeAzienda) {
        
        $sql = "INSERT INTO UTENTE (nome, cognome,email, password, salt, p_iva,telefono,indirizzo,nomeAzienda) 
        VALUES (?, ?,?, ?, ?,?,?,?,?)";
        if ($statement = $this->conn->prepare($sql) ) {
            $salt = bin2hex(random_bytes(16));
            $password_with_salt = $password.$salt;
            $hashed_password = password_hash($password_with_salt, PASSWORD_DEFAULT);


            $statement->bind_param("sssssssss",$nome,$cognome,$email,$hashed_password,$salt,$p_iva,$telefono,
            $indirizzo,$nomeAzienda);
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

   

    public function getPass($p_Iva,$password) {
        
        $salt="";
        $nomeAzienda="";
       

        $sql = "SELECT P_IVA, password, salt,nomeAzienda FROM utente WHERE P_IVA = ?";
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("s",$p_Iva);
            $statement->execute();
            
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->bind_result($p_Iva,$password,$salt,$nomeAzienda);
        while ($statement->fetch()) {
            // Creare un array associativo con i risultati
                $row = array(
                    'p_Iva' => $p_Iva,
                    'password' => $password,
                    'salt' => $salt,
                    'nomeAzienda' => $nomeAzienda
        
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

    public function getAllEdifici($p_Iva) { 
        $id_edificio="";
        $nomeEdificio="";
        $indirizzo="";
        $tipoAnimale="";
        $temperaturaLimite="";
        $umiditàLimite="";
        $result_array = array();
        $sql = "SELECT id_edificio,nome_edificio,indirizzo,tipo_animale,temperaturaLimite,umiditàLimite FROM edificio WHERE P_IVA = ?";
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("s",$p_Iva);
            $statement->execute();   
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }
        $statement->bind_result($id_edificio,$nomeEdificio,$indirizzo,$tipoAnimale,$temperaturaLimite,$umiditàLimite);
        while ($statement->fetch()) {
            // Creare un array associativo con i risultati
                $row = array(
                    'idEdificio' =>$id_edificio,
                    'nomeEdificio' => $nomeEdificio,
                    'indirizzo' => $indirizzo,
                    'tipoAnimale' => $tipoAnimale,
                    'temperatura' =>$temperaturaLimite,
                    'umidita' =>$umiditàLimite
                );
                // Aggiungere l'array alla lista dei risultati
                $result_array[] = $row;
            }
            $statement->close();
            $this->closeConnection();
        // Restituire l'array dei risultati
            $json_data = json_encode($result_array);
            return  $json_data;  
    }

    public function getEdificio($id) {
        
        
        $nomeEdificio="";
        $indirizzo="";
        $tipoAnimale="";
        $temperaturaLimite="";
        $umiditàLimite="";
        $result_array = array();

        $sql = "SELECT id_edificio,nome_edificio,indirizzo,tipo_animale,temperaturaLimite,umiditàLimite FROM edificio WHERE id_edificio = ?";
        if ($statement = $this->conn->prepare($sql) ) {
            $statement->bind_param("i",$id);
            $statement->execute();
            
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->bind_result($id,$nomeEdificio,$indirizzo,$tipoAnimale,$temperaturaLimite,$umiditàLimite);
        while ($statement->fetch()) {
            // Creare un array associativo con i risultati
                $row = array(
                    'idEdificio'=>$id,
                    'nomeEdificio' => $nomeEdificio,
                    'indirizzo' => $indirizzo,
                    'tipoAnimale' => $tipoAnimale,
                    'temperatura' =>$temperaturaLimite,
                    'umidita' =>$umiditàLimite

        
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

    public function insertEdificio($nomeEdificio, $indirizzo, $tipoAnimale, $temperatura, $umidita,$P_iva) {
 
        $sql = "INSERT INTO edificio (nome_edificio,indirizzo, tipo_animale, P_IVA,temperaturaLimite,umiditàLimite) VALUES (?, ?,?, ?, ?,?)";
        if ($statement = $this->conn->prepare($sql) ) {
       

            $statement->bind_param("ssssii",$nomeEdificio,$indirizzo,$tipoAnimale,$P_iva,$temperatura,$umidita);
            $statement->execute();
            //echo "TOOP";
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->close();
        $this->conn->close();       



       
    }

    

    public function updateEdificio($id,$nomeEdificio, $indirizzo, $tipoAnimale, $temperatura, $umidita) {
        $sql = "UPDATE edificio SET nome_edificio = ?, indirizzo = ?, tipo_animale = ?, temperaturaLimite = ?, umiditàLimite = ? WHERE id_edificio = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        
        if (!$stmt->bind_param("sssiii", $nomeEdificio, $indirizzo, $tipoAnimale, $temperatura, $umidita, $id)) {
            die("Binding parameters failed: " . $stmt->error);
        }
        
        $result = $stmt->execute();
        if (!$result) {
            die("Execute failed: " . $stmt->error);
        }
    
        if ($stmt->affected_rows === 0) {
            echo "No rows updated.";
        }
    
        $stmt->close();
        
        return $result;
    }
    public function isUnique($field, $value, $id) {
        $count=0;
        $sql = "SELECT COUNT(*) FROM edificio WHERE $field = ? AND id_edificio != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $value, $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count == 0;
    }

    public function deleteEdificio($id) {
 
        $sql = "DELETE FROM edificio WHERE id_edificio= ?";
        if ($statement = $this->conn->prepare($sql) ) {
       

            $statement->bind_param("i",$id);
            $statement->execute();
            //echo "TOOP";
        } else {
            echo "Errore: non è possibile eseguire la query: $sql.".$this->conn->error;
        }

        $statement->close();
        $this->conn->close();       



       
    }

    public function closeConnection(){
        $this->conn->close();
        
    }
}
?>
