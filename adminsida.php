<?php 
    include "header.php";
?>
<div class="aktivitetsdiv">
    <table>
        <?php 
            if ($_SESSION['adminlevel'] === "1") {
                echo "<h2>Samtliga aktiviteter</h2>"; // Eftersom de bara visar och ej administrerar
            }
            else if ($_SESSION['adminlevel'] === "2" || "3") {
                echo "<h2>Administrera föreningens aktiviteter</h2>";
                echo "<button id='laggtilldivknapp'>Lägg till ny aktivitet</button>"; // Knapp för popupruta
            }

            if (isset($_SESSION['tillagdmeddelande'])) { // Om meddelandevariabeln är satt i laggtill.php
                echo $_SESSION['tillagdmeddelande']; // Visar meddelandet
                // Unsettar variabeln sen eftersom jag inte vill att det ska visas här vid varje sidladdning, bara direkt efter
                unset($_SESSION['tillagdmeddelande']);
            }

            if (isset($_SESSION['raderadmeddelande'])) { // Om felmeddelandevariabeln är satt i radera.php
                echo $_SESSION['raderadmeddelande']; // Visar felmeddelandet
                // Unsettar variabeln sen eftersom jag inte vill att det ska visas här vid varje sidladdning, bara direkt efter
                unset($_SESSION['raderadmeddelande']);
            }
        ?>

        <tr>
            <th>Datum</th>
            <th>Tid</th>
            <th>Aktivitet</th>
            <th></th>
        </tr>
        <tr>
            <?php include "visaalla.php" ?>
        </tr>
    </table>
</div>


<div class="tillaggsdiv popupbakgrund"> <!--Blurrad bakgrundsdiv-->
    <div class="formulardiv popup"><!--Popupruta-->
        <form action="laggtill.php" method="POST">
            <p>Datum (obligatoriskt): <input type="date" name="Datum" required/></p>
            <p>Tid (obligatoriskt): <input type="time" name="Tid" required/></p>
            <p>Aktivitet (max 30 tecken): <input type="text" name="Aktivitet" maxlength="30" required/></p>
            <input type="submit" id="laggtillknapp" value="Lägg till"/>
        </form>
        <button id="avbrytknapp1">Avbryt</button>
    </div>
</div>

<?php 
    include "logindiv.php";
    include "footer.php";
?>