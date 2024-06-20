<?php require 'index.php';

require_once('config/dataManager.php');
 ?>


<script>
setTitolo('Registrazione');

</script>

<body>

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8 transparent-bg"><div class="nomeForm">MY FARM</div>
          <p style="text-align: center;">In questa sezione è possibile aggiungere gli edifici della tua azienda</p>
          <div class="row justify-content-center">
          <p style="text-align: center;">Edifici presenti</p>
          

               <table class="table table-responsive  table-striped table-bordered ">
            <thead>
                <tr>
                    <th id="id_edificio" hidden></th>
                    <th id="nome">Nome Edificio </th>
                    <th id="indirizzo">Indirizzo</th>
                    <th id="tipoAnimale">Tipo animale</th>
                    <th id="tLimite">Temperatura limite</th>
                    <th id="uLimite">Umidità limite</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
            $p_IVA ='';
            $p_IVA = $_SESSION['P_Iva'];
            $edifici= array();
            $manager = new Data_Manager();
            $edifici = json_decode($manager -> getAllEdifici($p_IVA), true);
        foreach ($edifici as $edifiio) {
            
            echo "<tr>";
                /*foreach ($giocatore as $valore) {
                    echo "<td>$valore</td>";
                }*/
            echo "<td class='nome'>".$edificio['idEdificio']."<td class='nome'>".$edificio['nomeEdificio']."</td><td class= 'nome'>".$edifiio['indirizzo']."</td><td class= 'cognome'>$edifiio->tipoAnimale/td>
            <td class='temperatura'>".$edificio['temperatura']."</td><td class='umidita'>".$edificio['umidita']."</td>
             
            
            </tr>";
        }
?>     
            </tbody>
        </table>
        <button type="button" class=" btn btn-primary action_btn scritte" data-toggle="modal" data-target="#addBuildingModal">
        Aggiungi Edificio
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addBuildingModal" tabindex="-1" role="dialog" aria-labelledby="addBuildingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addBuildingForm" method="post" action="add_building.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBuildingModalLabel">Aggiungi Edificio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomeEdificio">Nome Edificio</label>
                            <input type="text" class="form-control" id="nomeEdificio" name="nomeEdificio" required>
                        </div>
                        <div class="form-group">
                            <label for="indirizzo">Indirizzo</label>
                            <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoAnimale">Tipo Animale</label>
                            <input type="text" class="form-control" id="tipoAnimale" name="tipoAnimale" required>
                        </div>
                        <div class="form-group">
                            <label for="temperatura">Temperatura</label>
                            <input type="number" class="form-control" id="temperatura" name="temperatura" required>
                        </div>
                        <div class="form-group">
                            <label for="umidita">Umidità</label>
                            <input type="number" class="form-control" id="umidita" name="umidita" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#addBuildingForm').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    alert('Edificio aggiunto con successo!');
                    form[0].reset();
                    $('#addBuildingModal').modal('hide');
                    window.location.href = 'myFarm.php';

                }
            });
        });
    });
</script>
   
          </div>
          
      </div>
  </div>



</body>

<?php require 'footer.html'; ?>
