<?php
    session_start();
    include "losenord.php";
    include "validera.php";

    if (isset($_SESSION['adminlevel'])) { // Kontrollerar att användaren är inloggad
        
        include "header.php";

        $db = mysqli_connect('localhost', 'jehe0038', $losenord, 'jehe0038')
        //or die("Fel: Kunde inte ansluta till databasen");
        or die("Oops! Något blev fel.");

        $datum = validera($_POST['Datum']);
        $tid = validera($_POST['Tid']);
        $aktivitet = validera($_POST['Aktivitet']);

        if (($datum != null) and ($tid != null) and ($aktivitet != null)) { //Behövs denna? Beror på webbläsarstödet för attributet required i input
            $datumtid = $datum . " " . $tid . ":00"; // Slår ihop datum och tid för att skapa en datetime att inserta i databasen

            $stmt = $db->prepare("INSERT INTO ForeningensAktiviteter (Datum, Aktivitet) VALUES (?, ?)");
            $stmt->bind_param("ss", $datumtid, $aktivitet);
            $stmt->execute();

            if ($stmt) {
                $_SESSION['tillagdmeddelande'] = "<p class='alert_green'>Aktiviteten har lagts till!</p>"; // Gör att jag kan echo:a meddelandet på adminsidan...
                header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
                //echo "<div class='resultatdiv'><p>Tillagt! </p>";
                //echo "<a href='admin.php'>Tillbaka till adminsidan</a></div>";
            }
            else {
                $_SESSION['tillagdmeddelande'] = "<p class='alert_red'>Oops! Något gick fel.</p>"; // Gör att jag kan echo:a meddelandet på adminsidan...
                header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
                //echo "<div class='resultatdiv'> Oops! Något gick fel. </br>";
                //echo "<a href='admin.php'>Tillbaka till adminsidan</a></div>";
            }
        }
        else {
            $_SESSION['tillagdmeddelande'] = "<p class='alert_red'>Oops! Något gick fel.</p>"; // Gör att jag kan echo:a meddelandet på adminsidan...
            header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
            //echo "<div class='resultatdiv'>Fel: samtliga fält måste vara ifyllda";
            //echo "<br/><a href='admin.php'>Tillbaka till adminsidan</a></div>";
        }

        $stmt->close();
        mysqli_close($db);
        include "logindiv.php";
        include "footer.php";
    }
    else { // Om användaren inte är inloggad
        header('Location:index.php');
    }


?>