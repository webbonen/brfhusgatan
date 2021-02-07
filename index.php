<?php
    session_start();
    include "header.php";
?>

<div class="aktivitetsdiv">
    <table>
        <h2 class="kommanderubrik">Kommande aktiviteter</h2>
        <?php 
            if (isset($_SESSION['adminlevel']))  { // Kollar om inloggad
                echo "Nedan ser du som administratör vilka aktiviteter som besökarna kan se.";
                echo "<a class='tilladminsida' href='admin.php'>Gå till adminsidan</a>";
            }
        ?>
        <tr>
            <th>Datum</th>
            <th>Tid</th>
            <th>Aktivitet</th>
        </tr>
        <tr>
            <?php include "visakommande.php"; ?>
        </tr>
    </table>
</div>

<?php 
    include "logindiv.php";
    include "footer.php";
?>