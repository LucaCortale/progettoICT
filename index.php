<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>Indice</title>
    <script>
        // Funzione per impostare il titolo della pagina
        function setTitolo(titolo) {
            document.title = titolo;
        }

    </script>
</head>

    <header>
        
                <div class="navbarprova">
                    <a href="home.php"><div class="logo"><img href="home.php" src="image/logo.png"></div></a>
                        <ul class="links scritte">
                            <li><a href="home.php">Home</a></li>
                            <?php 
                            
                            session_start();
                          
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                              
                                
                                echo"<li><a href='gestione.php'>Gestione</a></li>";
                                
                            }else{echo"<li><a href='info.php'>Info</a></li>";
                            } 
                            
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                    // L'utente è autenticato
                                   // echo"DENTROOOOOO";
                                    $nomeAzienda = $_SESSION['nomeAzienda'];
                                    echo"<li><a href='logout.php'>logout</a></li></ul><a href='myFarm.php' class=' btn btn-primary action_btn scritte' id='action_btn' > $nomeAzienda </a>";
                                    
                                }else{echo"</ul><a href='registrazione.php' class='btn btn-primary action_btn scritte' id='action_btn'>Login/Registrati</a>";
                                } ?>
                        
                        <div class="toggle_btn">
                            <i class="fa-solid fa-bars"></i>
                        </div>

                    <div class="dropdown_menu scritte">
                            <li><a href="home.php">Home</a></li>
                            <?php 
                            session_start();
                          
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                  
                                    
                                    echo"<li><a href='gestione.php'>Gestione</a></li>";
                                    
                                }else{echo"<li><a href='info.php'>Info</a></li>";
                                } 

                            //session_start();
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                    // L'utente è autenticato
                                    //echo"DENTROOOOOO";
                                    $nomeAzienda = $_SESSION['nomeAzienda'];
                                    echo"<li href='myFarm.php'>".$nomeAzienda."</li>";
                                    
                                }else{echo"<li> <a href='registrazione.php' >Login/Registrati </a></li>";
                                } ?>
                    </div>

                </div>
                
    </header>
    
    
            <script>
                const toggleBtn = document.querySelector(".toggle_btn")
                const toggleBtnIcon = document.querySelector(".toggle_btn i")
                const dropDownMenu = document.querySelector(".dropdown_menu")

                toggleBtn.onclick = function(){
                    dropDownMenu.classList.toggle("open")
                    const isOpen = dropDownMenu.classList.contains("open")
                    
                    toggleBtn,classList = isOpen
                    ? "fa-solid fa-xmark"
                    : "fa-solid fa-bars"
                }

            </script>
            <div class="page-container">
                <div class="content-wrap">
            
        
</html>
