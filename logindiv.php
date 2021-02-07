<div class="loginorlogout">
    <?php 
        if (isset($_SESSION['adminlevel'])) { // Om redan inloggad
            echo "<p>Inloggad:</p>
                <p>" . $_SESSION['username'] . "</p>
                <a href='logout.php'>Logga ut</a>";
        }
        else { // Om ej inloggad
            echo '<form action="login.php" method="POST">
            <p>Användarnamn: <input type="text" name="UserName"/></p>
            <p>Lösenord: <input type="password" name="Password"/></p>
            <input type="submit" value="Logga in"/>
            </form>';
        }
        if (isset($_SESSION['felmeddelande'])) { // Om felmeddelandevariabeln är satt i login.php (dvs att inloggningen misslyckades)
            echo "<p>" . $_SESSION['felmeddelande'] . "</p>"; // Visar felmeddelandet
            // Unsettar variabeln sen eftersom jag inte vill att det ska visas här vid varje sidladdning, bara direkt efter en misslyckad inloggning
            unset($_SESSION['felmeddelande']);  
        }
    ?>
</div>