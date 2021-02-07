<?php
    session_start();
    include "losenord.php";
    include "validera.php";

    $username = validera($_POST['UserName']);
    $password = $_POST['Password'];
    $hashedpassword = hash('sha256', $password);

//    echo $username;
//    echo $password;
//    echo $hashedpassword;

    $db = mysqli_connect('localhost', 'jehe0038', $losenord, 'jehe0038')
    //or die("Fel: Kunde inte ansluta till databasen");
    or die("Oops! Något gick fel.");


    $stmt = $db->prepare("SELECT Password, Adminlevel FROM ForeningensAdmins WHERE Username = ? AND Password = ?");

    $stmt->bind_param("ss", $username, $hashedpassword);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($storedpassword, $adminlevel);
    if($stmt->num_rows == 1) { // Om användarnamn och lösenord stämde överens med det som finns lagrat bör det finnas en rad att hämta
        $stmt->fetch();
        $_SESSION['adminlevel'] = $adminlevel;
        $_SESSION['username'] = $username;
        header('Location: admin.php');
    } else { // Om de ej stämde överens finns inga rader att hämta
        $_SESSION['felmeddelande'] = "Fel användarnamn eller lösenord"; // Gör att jag kan echo:a felmeddelandet på adminsidan...
        header('Location: admin.php'); // ...som användaren skickas tillbaka till här.
    
        //    echo "Fel: Inga rader fanns <br/>";
    }

    $stmt->close();
    mysqli_close($db);

?>