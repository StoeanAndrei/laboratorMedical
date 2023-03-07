<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'laboratormedical';

    $connection = mysqli_connect($host, $user, $password)
or die('Nu se poate conecta la server!');
    $selection = mysqli_select_db($connection, $database)
or die('Nu se poate gasi baza de date!');
    //mysql_close($connection);

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $parola = $_POST['parola'];

    $nume = stripcslashes($nume);
    $prenume = stripcslashes($prenume);
    $parola = stripcslashes($parola);

    $nume = mysqli_real_escape_string($connection, $nume);
    $prenume = mysqli_real_escape_string($connection, $prenume);
    $parola = mysqli_real_escape_string($connection, $parola);

    $prv = mysqli_query($connection, "SELECT Nume, Prenume, Specializare
    FROM medici
    WHERE Nume = '$nume' AND Prenume = '$prenume' AND Parola = '$parola';")
or die('Nu se pot prelua date!');

    $count = mysqli_num_rows($prv);

    if ($count == 1) {
        echo '<!DOCTYPE html>
        <html>
        <head>
        <title>MedicalLAB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="stil.css">
        <link rel="shortcut icon" type="image/png" href="hospital.png">
        </head>
        <body>
        
        <h1 style="text-align: center">Laborator Medical</h1>
        <h3 style="text-align: center">Pagina medicului</h3>
        
        <form action="main_medic.php" method="post">
          <div class="imgcontainer">
            <img src="prima.jpg" alt="Avatar" class="avatar">
          </div>
          
          </div>
        </form>
        
        </body>
        </html>';
    }

    if ($count == 0) {
        echo 'Medic inexistent. Te rugam sa incerci din nou!';
    }
    
    ?>