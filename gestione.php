<?php require 'index.php'; 

require_once('config/dataManager.php');
?>
<script>
setTitolo('Gestione');

</script>

<body class="bodyPagine">

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8 transparent-bg"><div class="nomeForm titolo">GESTIONE PARAMETRI</div>
      <p style="text-align: center; margin:5px">Selezionare l'edificio di cui si vogliono analizzare i parametri</p>
          <div class="row justify-content-center">
              
          <?php

                $manager = new Data_Manager();
                $P_Iva = $_SESSION['P_Iva']; // $username dovrebbe essere l'username dell'utente autenticato
                $nomeAzienda=$_SESSION['nomeAzienda'];
                $edifici = json_decode($manager->getAllEdifici($P_Iva), true);
                if ( !empty($edifici)) {
                  echo "<form action='gestioneEdificio.php' method='POST'>";
                  echo"<select id='idEdificio' name='idEdificio' class= 'form-control' style='margin:20px'>
                  <option selected>Seleziona Edificio</option>";
                  foreach ($edifici as $edificio) {

                    
                         echo"<option  value='".$edificio["idEdificio"]."'>".$edificio["nomeEdificio"]."</option>";
                          
                      
                  }
                  echo"</select>";
                } else {
                   echo"<select id='inputStat' class= 'form-control'>
                          <option>Nessun edificio disponibile</option>
                          
                          </select>";
                }
                // Pulsante per inviare il form
                //echo "<div><button type='submit' class='btn btn-primary action_btn scritte btnModifica'>Vai alla pagina</button></div>";
                //echo "</form>";

            ?>

          </div>
          <div><button type='submit' class='btn btn-primary action_btn scritte btnModifica'>Seleziona</button></div>
                </form>
          
      </div>
  </div>



</body>

<?php require 'footer.html'; ?>
