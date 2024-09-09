<?php require 'index.php';

require_once('config/dataManager.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>


<script>
setTitolo('My Farm');

//per modal di modifica edfici
$(document).ready(function () {      
    // Quando il modal viene mostrato, imposta i dati nei campi del form


    // Funzione per salvare le modifiche
    $('#saveChanges').click(function () {
        //var id = $('#idAdd').val();
        var nomeEdificio = $('#nomeEdificio').val();
        var indirizzo = $('#indirizzo').val();
        var tipoAnimale = $('#tipoAnimale').val();
        var temperatura = $('#temperatura').val();
        var umidita = $('#umidita').val();

        console.log({
    nomeEdificio: nomeEdificio,
    indirizzo: indirizzo,
    tipoAnimale: tipoAnimale,
    temperatura: temperatura,
    umidita: umidita
});

        // Implementa la logica di verifica e aggiornamento qui, ad esempio usando AJAX
        $.ajax({
            url: 'add_building.php', // URL del file PHP per aggiornare i dati
            type: 'POST',
            dataType: 'json',
            data: {
                //id: id,
                nomeEdificio: nomeEdificio,
                indirizzo: indirizzo,
                tipoAnimale: tipoAnimale,
                temperatura: temperatura,
                umidita: umidita
            },
            success: function (response) {
                console.log('Server response:', response); // Aggiungi questo per debug
       
                //var data = JSON.parse(response);
                if (response.status === 'success') {
                    alert(response.message);
                    $('#addBuildingModal').modal('hide');
                    location.reload();
                } else {
                    alert(response.message);
                   
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
        console.log('AJAX Error:', textStatus, errorThrown); // Debug
        alert('Errore durante l\'aggiunta dell\'edificio.');
    }
        });
    });
  });

  //modal che aggiunge edifio
$(document).ready(function () {   
    // Quando il modal viene mostrato, imposta i dati nei campi del form
    $('#ModificaBuildingModal').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget); // Button that triggered the modal
        
        // Estrai i dati dall'attributo data-* del pulsante e impostali nei campi del modal
        var modal = $(this);
        //modal.find('#nomeEdificioModifica').val(button.data('id'));
        var id = button.data('id');
        
        modal.find('#idModifica').val(button.data('id'));
        modal.find('#nomeEdificioModifica').val(button.data('nome'));
        
        modal.find('#indirizzoModifica').val(button.data('indirizzo'));
        modal.find('#tipoAnimaleModifica').val(button.data('tipoanimale'));
        modal.find('#temperaturaModifica').val(button.data('temperatura'));
        modal.find('#umiditaModifica').val(button.data('umidita'));
        //console.log($('#idModifica').val());
        
    });

    // Funzione per salvare le modifiche
    $('#saveChangesModifica').click(function () {

        var id = $('#idModifica').val();
        var nome = $('#nomeEdificioModifica').val();
        var indirizzo = $('#indirizzoModifica').val();
        var tipoAnimale = $('#tipoAnimaleModifica').val();
        var temperatura = $('#temperaturaModifica').val();
        var umidita = $('#umiditaModifica').val();
        console.log(id,nome,indirizzo,tipoAnimale,temperatura,umidita)

   
        // Implementa la logica di verifica e aggiornamento qui, ad esempio usando AJAX
        $.ajax({
            url: 'updateEdificio.php', // URL del file PHP per aggiornare i dati
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                nome: nome,
                indirizzo: indirizzo,
                tipoAnimale: tipoAnimale,
                temperatura: temperatura,
                umidita: umidita
            },
            success: function (response) {
                console.log('Server response:', response); // Aggiungi questo per debug
       
                //var data = JSON.parse(response);
                if (response.status === 'success') {
                    alert(response.message);
                    $('#ModificaBuildingModal').modal('hide');
                    location.reload();
                } else {
                    alert(response.message);
                   
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
        console.log('AJAX Error:', textStatus, errorThrown); // Debug
        alert('Errore durante il salvataggio delle modifiche.');
    }
        });
    });
  });

//modal che elimina edifio
$(document).ready(function () {   
    // Quando il modal viene mostrato, imposta i dati nei campi del form
    $('#deleteBuldingModal').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget); // Button that triggered the modal
        
        // Estrai i dati dall'attributo data-* del pulsante e impostali nei campi del modal
        var modal = $(this);
     
        var id = button.data('id');
        
        modal.find('#idElimina').val(button.data('id'));
       
        //console.log($('#idModifica').val());
        
    });

    // Funzione per salvare le modifiche
    $('#saveChangesDelete').click(function () {

        var id = $('#idElimina').val();
        console.log(id)

   
        // Implementa la logica di verifica e aggiornamento qui, ad esempio usando AJAX
        $.ajax({
            url: 'deleteEdificio.php', // URL del file PHP per aggiornare i dati
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (response) {
                console.log('Server response:', response); // Aggiungi questo per debug
       
                //var data = JSON.parse(response);
                if (response.status === 'success') {
                    alert(response.message);
                    $('#deleteBuldingModal').modal('hide');
                    location.reload();
                } else {
                    alert(response.message);
                   
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
        console.log('AJAX Error:', textStatus, errorThrown); // Debug
        alert('Errore durante il salvataggio delle modifiche.');
    }
        });
    });
  });

</script>






<body class="bodyPagine">

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-12 transparent-bg"><div class="nomeForm titolo">MY FARM</div>
          <p style="text-align: center;">In questa sezione è possibile aggiungere,modificare ed eliinare gli edifici della tua azienda</p>
          <p style="text-align: center; " class=" sottotitolo">Edifici presenti</p>
          <div class="row justify-content-center">
        
          

            <table class="table table-responsive  table-striped  ">
                <thead>
                    <tr>
                        <th id="" hidden></th>
                        <th id="">Nome Edificio </th>
                        <th id="">Indirizzo</th>
                        <th id="">Tipo animale</th>
                        <th id="">Temperatura limite</th>
                        <th id="">Umidità limite</th>
                    
                    </tr>
                </thead>
            <tbody>
            <?php
            $p_IVA ='';
            $p_IVA = $_SESSION['P_Iva'];
            $edifici= array();
            $manager = new Data_Manager();
            $edifici = json_decode($manager -> getAllEdifici($p_IVA), true);
        foreach ($edifici as $edificio) {
            
            echo "<tr>";
                /*foreach ($giocatore as $valore) {
                    echo "<td>$valore</td>";
                }*/
            echo "<td id='id' hidden>".$edificio['idEdificio']."<td id='nomeEdificioTable'>".$edificio['nomeEdificio']."</td><td id= 'indirizzoTable'>".$edificio['indirizzo']."</td><td id= 'tipoAnimaleTable'>".$edificio['tipoAnimale']."</td>
            <td id='tLimite'>".$edificio['temperatura']."</td><td id='uLimite'>".$edificio['umidita']."</td>

            <td><button type='button' class= 'btn btn-primary action_btn scritte' data-toggle='modal' data-target='#ModificaBuildingModal'
            data-id='".$edificio['idEdificio']."'
            data-nome='".$edificio['nomeEdificio']."'
            data-indirizzo='".$edificio['indirizzo']."'
            data-tipoanimale='".$edificio['tipoAnimale']."'
            data-temperatura='".$edificio['temperatura']."'
            data-umidita='".$edificio['umidita']."'
            >
            Modifica
            </button></td>
            <td><button type='button' class= 'btn btn-primary action_btn scritte' data-toggle='modal' data-target='#deleteBuldingModal' data-id='".$edificio['idEdificio']."'>
            Elimina
            </button></td>
            </tr>";
        }
?>     
            </tbody>
        </table>
        </div>
        <button type="button" class=" btn btn-primary action_btn scritte" data-toggle="modal" data-target="#addBuildingModal">
        Aggiungi Edificio
        </button>

    <!-- Modal AGGIUNGI EDIFICIO --> 
    <div class="modal fade" id="addBuildingModal" tabindex="-1" role="dialog" aria-labelledby="addBuildingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addBuildingForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBuildingModalLabel">Aggiungi Edificio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group" hidden>
                            <label for="id">Id</label>
                            <input type="text" class="form-control" id="idAdd" name="idAdd">
                        </div>
                        <div class="form-group">
                            <label for="nomeEdificio">Nome Edificio</label>
                            <input type="text" class="form-control" id="nomeEdificio" name="nomeEdificio" required>
                        </div>
                        <div class="form-group">
                            <label for="indirizzo">Indirizzo</label>
                            <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoAnimale" >Tipo Animale</label>
                            <input type="text" class="form-control" id="tipoAnimale" name="tipoAnimale" required>
                        </div>
                        <div class="form-group">
                            <label for="temperatura" >Temperatura</label>
                            <input type="number" class="form-control" id="temperatura" name="temperatura"  required>
                        </div>
                        <div class="form-group">
                            <label for="umidita" readonly>Umidità</label>
                            <input type="number" class="form-control" id="umidita" name="umidita" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnModifica" data-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary btnModifica" id="saveChanges">Salva modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal MODIFICA EDIFICIO --> 
     <div class="modal fade" id="ModificaBuildingModal" tabindex="-1" role="dialog" aria-labelledby="ModificaBuildingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="EliminaBuildingForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModificaBuildingModalLabel">Modifica Edificio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="form-group" hidden>
                            <label for="id">Id</label>
                            <input type="text" class="form-control" id="idModifica" name="idModifica">
                        </div>
                    
                        <div class="form-group">
                            <label for="nomeEdificio">Nome Edificio</label>
                            <input type="text" class="form-control" id="nomeEdificioModifica" name="nomeEdificioModifica" required>
                        </div>
                        <div class="form-group">
                            <label for="indirizzo">Indirizzo</label>
                            <input type="text" class="form-control" id="indirizzoModifica" name="indirizzoModifica" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoAnimale">Tipo Animale</label>
                            <input type="text" class="form-control" id="tipoAnimaleModifica" name="tipoAnimaleModifica" required>
                        </div>
                        <div class="form-group">
                            <label for="temperatura">Temperatura</label>
                            <input type="number" class="form-control" id="temperaturaModifica" name="temperaturaModifica" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="umidita">Umidità</label>
                            <input type="number" class="form-control" id="umiditaModifica" name="umiditaModifica" readonly required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnModifica" data-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary btnModifica" id="saveChangesModifica">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal AGGIUNGI EDIFICIO --> 
     <div class="modal fade" id="deleteBuldingModal" tabindex="-1" role="dialog" aria-labelledby="deleteBuldingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Elimina Edificio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group" hidden>
                            <label for="id">Id</label>
                            <input type="text" class="form-control" id="idElimina" name="idElimina">
                        </div>
                     Sicuro di voler eliminare l'edificio dalla tua azienda?
                
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnModifica" data-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary btnModifica" id="saveChangesDelete">Elimina</button>
                    </div>
            </div>
        </div>
    </div>

   



</body>

<?php require 'footer.html'; ?>
