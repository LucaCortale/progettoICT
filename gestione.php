<?php require 'index.php'; 

require_once('config/dataManager.php');
?>
<script>
setTitolo('Gestione');

</script>

<body>

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8 transparent-bg"><div class="nomeForm">GESTIONE</div>
        
          <div class="row justify-content-center">
              
          <?php

                $manager = new Data_Manager();
                $P_Iva = $_SESSION['P_Iva']; // $username dovrebbe essere l'username dell'utente autenticato
                $nomeAzienda=$_SESSION['nomeAzienda'];
                $edifici = json_decode($manager->getAllEdifici($P_Iva), true);
                if ( !empty($edifici)) {
                  echo"<select id='inputTorneo' class= 'form-control'>
                  <option selected>Seleziona Edificio</option>";
                  foreach ($edifici as $edificio) {

                    
                         echo"<option>".$edificio["nomeEdificio"]."</option>";
                          
                      
                  }
                  echo"</select>";
                } else {
                   echo"<select id='inputStat' class= 'form-control'>
                          <option>Nessun edificio disponibile</option>
                          
                          </select>";
                }

            ?>

          </div>
          
      </div>
  </div>



</body>

<?php require 'footer.html'; ?>
