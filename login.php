<?php include 'index.php'; ?>
<?php

  

if(isset($_SESSION['pagina_di_provenienza']) && $_SESSION['pagina_di_provenienza'] === "/progettoICT/LoginOk.php") {
    // La richiesta proviene dalla pagina desiderata
    echo "<script>
    $(document).ready(function(){
    $('#myModal').modal('show');
    });
    </script>";
} 
// Elimina la variabile di sessione dopo averla utilizzata (opzionale)
unset($_SESSION['pagina_di_provenienza']);
?>
<!-- Modale Bootstrap -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Intestazione del modale -->
            <div class="modal-header">
                <h4 class="modal-title">Accesso negato</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Corpo del modale -->
            <div class="modal-body">
           
                Password o username errati!
                
            </div>
            <!-- Footer del modale -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>


<script>
        setTitolo('Login');
</script>

        <body class="bodyPagine">
        <div class=" container mt-5 ">
          <div class="row justify-content-center">
            <div class="col-md-8 transparent-bg"><div class="nomeForm scritte2"><b>LOGIN</b></div>
              <form onsubmit= "validaForm(event)" action="LoginOk.php" method="post">
                <div class="form-row justify-content-center">
                
                  
                <div class="form-group col-md-6">
                    <label for="inputP_Iva" class="scritte2 nomeForm">P. IVA</label>
                    <input type="text" class="form-control" name="inputP_Iva" id="inputP_Iva" placeholder="P.IVA" value="<?php echo (isset($_SESSION['ricordami']) && $_SESSION['ricordami'] == 1 && isset($_SESSION['password'])) ? $_SESSION['P_Iva'] : ''; ?>">
                </div>
                </div>
                <div class="form-row justify-content-center">
                  <div class="form-group col-md-6 ">
                    <label for="inputPassword" class="scritte2">Password</label>
                    <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" value="<?php echo (isset($_SESSION['ricordami']) && $_SESSION['ricordami'] == 1 && isset($_SESSION['password'])) ? $_SESSION['password'] : ''; ?>">
                  </div>
                </div>
                <div class="form-row justify-content-center">
                 <!-- <input type="hidden" name="ricordami" value="0"> Valore predefinito -->
                  <div class="form-check">
                    <input type="checkbox" name="ricordami" class="form-check-input" id="exampleCheck1" value="1" <?php echo isset($_SESSION['ricordami']) && $_SESSION['ricordami'] == 1 ? 'checked' : ''; ?> >
                    <label class="form-check-label scritte2" for="exampleCheck1">ricordami</label>
                  </div>
                </div>
                <div class="form-row justify-content-center">   
              
                  <div class="col-auto container_btn">
                  <button type="submit" class="btn btn-primary btnRegistrati scritte2">LOGIN</button>
                  </div>
                </div>
              </form>

                </div>
            </div>
        </div>
        </body>
   
<?php include 'footer.html'; ?>
