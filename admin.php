<?php
    session_start();
    if (isset($_SESSION['adminlevel'])) { // Om inloggad
        include "adminsida.php"; // Visa sidinnehållet
        
    }
    else {
        header('Location:index.php'); // Annars skicka till startsidan
    }

?>