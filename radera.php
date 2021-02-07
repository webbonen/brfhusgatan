<?php
session_start();
include "losenord.php";
    if (isset($_SESSION['adminlevel'])) {
        include "header.php";

        $db = mysqli_connect('localhost', 'jehe0038', $losenord, 'jehe0038')
        //or die("Fel: Kunde inte ansluta till databasen");
        or die("Oops! Något blev fel.");

        $valdaktivitet = $_GET['aktivitetsid']; // Hämtar medskickat ID för den valda aktiviteten
        $myquery = "DELETE FROM ForeningensAktiviteter WHERE ID = $valdaktivitet";
        $result = mysqli_query($db, $myquery);
        if ($result) { // Om det gick bra att radera
            $_SESSION['raderadmeddelande'] = "<p class='alert_green'>Aktiviteten raderad!</p>"; // Gör att jag kan echo:a meddelandet på adminsidan...
                header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
            //echo "<div class='resultatdiv'><p>Aktiviteten raderad!</p>";
            //echo "<a href='admin.php'>Tillbaka till adminsidan</a></div>";
        }
        else {
            $_SESSION['raderadmeddelande'] = "<p class='alert_red'>Oops! Något gick fel.</p>"; // Gör att jag kan echo:a meddelandet på adminsidan...
            header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
            //echo "<div class='resultatdiv'><p>Oops! Något gick fel.</p>";
            //echo "<a href='admin.php'>Tillbaka till adminsidan</a></div>";
        }
        mysqli_close($db);
        include "logindiv.php";
        include "footer.php";
    }
    else {
        header('Location:index.php');
    }
?>