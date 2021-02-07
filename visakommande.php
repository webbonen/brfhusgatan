<?php
    include "losenord.php";
    $db = mysqli_connect('localhost', 'jehe0038', $losenord, 'jehe0038')
    //or die("Fel: Kunde inte ansluta till databasen");
    or die ("Oops! Något gick fel.");
    
    $now = date('Y-m-d H:i:s');
    
    $myquery = "SELECT * FROM ForeningensAktiviteter WHERE Datum >= '$now' ORDER BY Datum ASC LIMIT 5";
    $result = mysqli_query($db, $myquery);

    if ($result) { // Om den hittar några rader
        while ($row = mysqli_fetch_array($result)) { // Medan det finns rader är den lika med det, sen blir den false
            $d =strtotime($row['Datum']);  // Tar datumet från databasen och gör om det till tid
            echo "<tr>";
            echo "<td>". date('Y-m-d', $d) . "</td>"; // Visar datum-delen
            echo "<td>". date('H:i', $d) . "</td>"; // Visar tid-delen
            echo "<td>". $row['Aktivitet'] . "</td>";
            echo "</tr>";
        }
    }
    else {
        //die ("Fel: Förfrågan kunde inte utföras");
        die ("Oops! Något gick fel."); 
    }

mysqli_close($db);

?>