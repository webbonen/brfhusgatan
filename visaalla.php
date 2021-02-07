
<?php
    include "losenord.php";
    $db = mysqli_connect('localhost', 'jehe0038', $losenord, 'jehe0038')
//    or die("Fel: Kunde inte ansluta till databasen");
    or die("Oops! Något gick fel.");

    $myquery = "SELECT * FROM ForeningensAktiviteter ORDER BY Datum ASC";
    $result = mysqli_query($db, $myquery);

    if ($result) {
        while ($row = mysqli_fetch_array($result)) { // Medan det finns rader är den lika med det, sen blir den false
            $d =strtotime($row['Datum']); // Tar datumet från databasen och gör om det till tid
            echo "<tr>";
            echo "<td>". date('Y-m-d', $d) . "</td>"; // Visar datum-delen
            echo "<td>". date('H:i', $d) . "</td>"; // Visar tid-delen
            echo "<td>". $row['Aktivitet'] . "</td>";
            if ($_SESSION['adminlevel'] === "3") {
                // Nedanstående lägger till en radera-länk på samtliga aktiviteter.
                // Den skickar också med respektive aktivitets ID för att det ska kunna hämtas och användas i SQL-satsen i radera.php
                echo "<td><a href='radera.php?aktivitetsid=" . $row['ID'] . "'>Radera</a></td>";
                echo "</tr>";
            }
        }
    }
    else {
        //die ("Fel: Förfrågan kunde inte utföras");
        die ("Oops! Något gick fel."); 
    }

mysqli_close($db);

?>