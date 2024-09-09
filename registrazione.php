<?php require 'index.php'; ?>


<script>


setTitolo('Registrazione');

//!!!!!!!!!!!!!!!!!FUNZIONA METETRE A POSTO SOLO TUTTO E FARE I CONTROLLI NECESSARI  !!!!!!!!!!!!!!!!!!!!!!!!!!!!
function validaForm(event) {

  //alert("In");

            var inputNome = document.getElementById("inputNome").value;
            var inputCognome = document.getElementById("inputCognome").value;
            var inputEmail = document.getElementById("inputEmail").value;
            var inputPassword = document.getElementById("inputPassword").value;
            var inputP_Iva = document.getElementById("inputP_Iva").value;
            var inputTelefono = document.getElementById("inputTelefono").value;
            var inputIndirizzo = document.getElementById("inputIndirizzo").value;
            //operatore di coalescenza nulla ?? per controllare se una variabile è nulla o indefinita.
            //eseguita se almeno una delle variabili è nulla
            

         
            
            //a stringa contenga almeno un numero e almeno un simbolo speciale, e sia lunga al massimo 16 caratteri, senza spazi.
            var regexPassword = /^(?=.*\d)(?=.*[\W\_])(?!.*\s).{6,16}$/;
            if (!regexPassword.test(inputPassword)) {
              
            alert("La password contiene caratteri non validi. Deve contenere almeno un numero, un simbolo e deve essere lunga almeno 6 caratteri.");
            event.preventDefault(); // Impedisce l'invio del modulo se la validazione fallisce
            }

            

            if (inputNome == "" || inputCognome == ""  || inputEmail == "" || 
            inputPassword == ""  || inputP_Iva == "" ||//|| inputnTessera== ""|| inputTelefono== ""
            inputIndirizzo== ""  ) {
            alert("Inserire tutti i campi richiesti.");
            event.preventDefault(); // Impedisce l'invio del modulo se la validazione fallisce
            }
        }

</script>

<body class="bodyPagine">

  <div class=" container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8 transparent-bg"><div class="nomeForm">REGISTRAZIONE</div>
        <form onsubmit= "validaForm(event)" action="registrazioneOk.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-4 ">
              <label for="inputNome">Nome</label>
              <input type="text" class="form-control" name="inputNome" id="inputNome" placeholder="Nome">
            </div>
            <div class="form-group col-md-4">
              <label for="inputCognome">Cognome</label>
              <input type="text" class="form-control" name="inputCognome" id="inputCognome" placeholder="Cognome">
            </div>
            
            <div class="form-group col-md-4">
              <label for="inputEmail">Email</label>
              <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
            </div>
            
            
            <div class="form-group col-md-4">
              <label for="inputP_Iva">P.IVA</label>
              <input type="text" class="form-control" name="inputP_Iva" id="inputP_Iva" placeholder="P. IVA">
            </div>
            <div class="form-group col-md-4">
              <label for="inputNomeAzienda">Nome Azienda</label>
              <input type="text" class="form-control" name="inputNomeAzienda" id="inputNomeAzienda" placeholder="Nome Azienda">
            </div>
            <div class="form-group col-md-4">
              <label for="inputTelefono">Telefono</label>
              <input type="tel" class="form-control" name="inputTelefono" id="inputTelefono" placeholder="Telefono">
            </div>
            <div class="form-group col-md-4">
              <label for="inputIndirizzo">Indirizzo</label>
              <input type="text" class="form-control" name="inputIndirizzo" id="inputIndirizzo" placeholder="Indirizzo">
            </div>
          </div>
          <div class="row justify-content-center">   
         
            <div class="col-auto container_btn">
            <button type="submit" class="btn btn-primary btnRegistrati">Registrati</button>
            </div>
          </div>
        </form>
          <div class="row justify-content-center">
              <div class="col-auto container_btn">
                <button type="text" onclick="window.location.href='login.php'" class="btn btn-primary btnLogin">Effettua Login</button>
              </div>
          </div>
          
      </div>
  </div>



</body>

<?php require 'footer.html'; ?>
