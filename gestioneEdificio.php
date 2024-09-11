<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<?php require 'index.php';

require_once('config/dataManager.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//CODICE_ARDUINO
$date = date("M_Y");

$hum = file("dati_sensore_umidita_".$date.".txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$temp = file("dati_sensore_temperatura_".$date.".txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$Fan = file("dati_stato_ventola_".$date.".txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$Pump = file("dati_stato_pompa_".$date.".txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$ultimaHum = end($hum);
$ultimaTemp = end($temp);
$ultimoStatoFan = end($Fan); 
$ultimoStatoPump = end($Pump); 
 ?>


<script>
    
setTitolo('Gestione Edificio');

$(document).ready(function () {  
   
    var statoVentola = $('#statoVentola').val();
    var statoPompa = $('#statoPompa').val();

    function cambiaBtn(valore, elemento) {
        if (valore == 'ATTIVO') {
            elemento.innerText = 'DISATTIVARE';
            //elemento.value = 'DISATTIVO';
        }else{
            elemento.innerText = 'ATTIVARE';
            //elemento.value = 'ATTIVO';
        }
    }  
    cambiaBtn(statoVentola,document.getElementById('btnVentola'));
    cambiaBtn(statoPompa,document.getElementById('btnPompa'));
    //console.log(statoPompa,statoVentola)

    function coloraLabel(valore, elemento) {
        if (valore == 'ATTIVO') {
            elemento.style.color = 'white';
            elemento.style.backgroundColor = 'rgb(50, 181, 70,0.8)';
            
        } else{
            elemento.style.color = 'white';
            elemento.style.backgroundColor = 'rgba(194, 18, 18, 0.8)';
        }
    } 
    //console.log(statoPompa,statoVentola)
    coloraLabel(statoVentola,document.getElementById('statoVentola'));
    coloraLabel(statoPompa,document.getElementById('statoPompa'));



    var temperatura = $('#temperatura').val();
    var umidita = $('#umidita').val();

    var temperaturaRilevata = $('#temperaturaRilevata').val();
    var umiditaRilevata = $('#umiditaRilevata').val();

    //console.log(temperatura,umidita,temperaturaRilevata,umiditaRilevata);
   
    function coloraCampo(valore, limite, elemento) {
        if (valore > limite+2) {
            elemento.style.color = 'white';
            //console.log('colora rosso');
            elemento.style.backgroundColor = 'rgba(194, 18, 18, 0.8)'; //colora rosso
        } if (valore < limite-2){
            elemento.style.color = 'white';
            elemento.style.backgroundColor = 'rgb(50, 181, 70,0.8)'; //colora verde
            //console.log('colora verde');
        }else if(valore <= limite+2 && valore >= limite-2){
            elemento.style.color = 'white';
            elemento.style.backgroundColor = 'rgba(190, 160, 14, 0.8)';//colora giallo
            //console.log('colora giallo');
        }
        // console.log(valore);
        // console.log(limite);
    }
    
    
    coloraCampo(temperaturaRilevata, temperatura, document.getElementById('temperaturaRilevata'));
    coloraCampo(umiditaRilevata, umidita, document.getElementById('umiditaRilevata'));

    }
)
</script>






<body class="bodyPagine">

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-12 transparent-bg"><div class="nomeForm titolo">GESTIONE EDIFICIO</div>
          <p style="text-align: center;">In questa sezione è possibile monitorare i valori rilevati nelle stalle</p>
          
            <?php
            $p_IVA ='';
            $p_IVA = $_SESSION['P_Iva'];
            $manager = new Data_Manager();
            $id = $_POST['idEdificio'] ?? null;
            $edificio = json_decode($manager -> getEdificio($id), true);
            
            ?>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nomeEdificio" >Nome Edificio</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label type="text" style="text-align: center;" id="nomeEdificio" name="nomeEdificio" class="form-control" placeholder="Nome Edificio"><?php echo$edificio[0]['nomeEdificio']?></label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="indirizzo">Indirizzo</label>
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                    <label type="text"style="text-align: center;" id="indirizzo" name="indirizzo" class="form-control" placeholder="Nome Edificio"><?php echo$edificio[0]['indirizzo']?></label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nomeEdificio">Tipo Animale</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label type="text"style="text-align: center;" id="nomeEdificio" name="nomeEdificio" class="form-control" placeholder="Nome Edificio"><?php echo$edificio[0]['tipoAnimale']?></label>
                </div>
            </div>
        </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="temperatura">Temperatura Limite</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" style="text-align: center;" id="temperatura" name="temperatura" class="form-control" placeholder="temperatura" value=<?php echo$edificio[0]['temperatura'] ?>></input>
                    </div>
                </div>
        
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="umidita">Umidità Limite</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" style="text-align: center;" id="umidita" name="umidita" class="form-control" placeholder="umidita" value=<?php echo$edificio[0]['umidita'] ?>></input>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="temperaturaRilevata">Temperatura Rilevata</label>
                    </div>
                </div>
                <!-- Stampa temperatura da arduino-->
                <div class="col-md-3">
                    <div class="form-group">
                            <input type="text" style="text-align: center;" id="temperaturaRilevata" name="temperaturaRilevata" class="form-control" placeholder="temperaturaRilevata" value=<?php echo $ultimaTemp ?>>

                        </input>
                    </div>
                </div>
                <!-- Stampa umidità da arduino-->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="umiditaRilevata">Umidità Rilevata</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" style="text-align: center;" id="umiditaRilevata" name="umiditaRilevata" class="form-control" placeholder="umiditaRilevata" value=<?php echo $ultimaHum ?>>
                        </input>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="statoVentola" >Stato ventilazione</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
            <!-- Stampa stato ventola da arduino-->

                <?php
                //CODICE_ARDUINO 
                    if($ultimoStatoFan == 1){
                            $statoFan = 'ATTIVO'; 
                    }else{
                            $statoFan = 'DISATTIVO';
                    }                      
                ?>
                    <button type="label" style="text-align: center;" id="statoVentola" name="statoVentola" class="form-control" placeholder="statoVentola" value=<?php echo $statoFan ?>>
                    <?php echo $statoFan ?>
                     </button>
                     
                </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                            <button type="button" style="text-align: center; width: 200px;" id="btnVentola" name="btnVentola" class="btn btn-primary action_btn scritte" placeholder="btnVentola">
                            </button>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $("#btnVentola").click(function() {

                                    var statoFan = "<?php // echo $statoFan; ?>";
                                    // Determina il comando da inviare
                                    var comando = (statoFan === 'DISATTIVO') ? "onFan" : "offFan";

                                    // Esegui chiamata AJAX per inviare il comando alla pagina separata
                                    $.post("invioComandoArduino.php", { comando: comando }, function(data) {
                                        // Mostra il risultato della richiesta
                                        alert(data);  // Puoi sostituire l'alert con un altro metodo di notifica
                                    });
                                });
                            });
                        </script>
                    </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="statoPompa" >Stato nebulizzazione</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
        <!-- Stampa stato ventola da arduino-->

                <?php
                //CODICE_ARDUINO 
                    if($ultimoStatoPump == 1){
                            $statoPump = 'ATTIVO'; 
                    }else{
                            $statoPump = 'DISATTIVO';
                    }                      
                ?>

                    <button type="text" style="text-align: center;" id="statoPompa" name="statoPompa" class="form-control" placeholder="statoPompa"value=<?php echo $statoPump ?>>
                        <?php echo $statoPump ?>
                     </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" style="text-align: center; width: 200px;" id="btnPompa" name="btnPompa" class="btn btn-primary action_btn scritte" placeholder="btnPompa" value=<?php echo$statoPump ?>>
                    <?php echo $statoPump ?>
                     </button>
                     <script>
                            $(document).ready(function() {
                                $("#btnPompa").click(function() {

                                    var statoPump = "<?php echo $statoPump; ?>";
                                    // Determina il comando da inviare
                                    var comando = (statoPump === 'DISATTIVO') ? "onPump" : "offPump";

                                    // Esegui chiamata AJAX per inviare il comando alla pagina separata
                                    $.post("invioComandoArduino.php", { comando: comando }, function(data) {
                                        // Mostra il risultato della richiesta
                                        alert(data);  // Puoi sostituire l'alert con un altro metodo di notifica
                                    });
                                });
                            });
                        </script>
                </div>
            </div>
        </div>
        
        <button type="button" class=" btn btn-primary action_btn scritte" data-toggle="" data-target="#">
            Aggiungi Edificio
        </button>
        </div>
        
    </div>

    

   
        


</body>

<?php require 'footer.html'; ?>