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
            var inputConfermaPassword = document.getElementById("inputConfermaPassword").value;
            var inputnTessera = document.getElementById("inputnTessera").value;
            var inputUsername = document.getElementById("inputUsername").value;
            var inputTelefono = document.getElementById("inputTelefono").value;
           
            //operatore di coalescenza nulla ?? per controllare se una variabile è nulla o indefinita.
            //eseguita se almeno una delle variabili è nulla
            

         
            
            //a stringa contenga almeno un numero e almeno un simbolo speciale, e sia lunga al massimo 16 caratteri, senza spazi.
            var regexPassword = /^(?=.*\d)(?=.*[\W\_])(?!.*\s).{6,16}$/;
            if (!regexPassword.test(inputPassword)) {
              
            alert("La password contiene caratteri non validi. Deve contenere almeno un numero, un simbolo e deve essere lunga almeno 6 caratteri.");
            event.preventDefault(); // Impedisce l'invio del modulo se la validazione fallisce
            }

            if (inputPassword != inputConfermaPassword) {
            alert("Le password non coincidono. Inserire password uguali. ");
            event.preventDefault(); // Impedisce l'invio del modulo se la validazione fallisce
            }

            if (inputNome == "" || inputCognome == ""  || inputEmail == "" || 
            inputPassword == ""  || inputConfermaPassword == "" ||//|| inputnTessera== ""|| inputTelefono== ""
            inputUsername== ""  ) {
            alert("Inserire tutti i campi richiesti.");
            event.preventDefault(); // Impedisce l'invio del modulo se la validazione fallisce
            }
        }

</script>

<body>

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
              <label for="inputConfermaPassword">Conferma Password</label>
              <input type="password" class="form-control" id="inputConfermaPassword" placeholder="Conferma Password">
            </div>
            <div class="form-group col-md-4">
              <label for="inputnTessera">N. tessara GIF</label>
              <input type="text" class="form-control" id="inputnTessera" placeholder="nTessera">
            </div>
            <div class="form-group col-md-4">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username">
            </div>
            <div class="form-group col-md-4">
              <label for="inputTelefono">Telefono</label>
              <input type="tel" class="form-control" id="inputTelefono" placeholder="Telefono">
            </div>
            <div class="form-group col-md-4">
              <label for="inputIndirizzo">Indirizzo</label>
              <input type="text" class="form-control" id="inputIndirizzo" placeholder="Indirizzo">
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
