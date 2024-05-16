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
      <div class="col-md-8 transparent-bg"><div class="nomeForm">HOME</div>
        
          <div class="row justify-content-center">
              
          </div>
          
      </div>
  </div>



</body>

<?php require 'footer.html'; ?>
