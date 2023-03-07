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
    $cnp = $_POST['cnp'];

    $nume = stripcslashes($nume);
    $cnp = stripcslashes($cnp);

    $nume = mysqli_real_escape_string($connection, $nume);
    $cnp = mysqli_real_escape_string($connection, $cnp);

    $prv = mysqli_query($connection, "SELECT Nume, Prenume FROM pacienti WHERE Nume = '$nume' AND CNP = '$cnp';")
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
        <h3 style="text-align: center">Analizele mele</h3>
        
        <form action="analize_pacienti.php" method="post">
          <div class="imgcontainer">
            <img src="prima.jpg" alt="Avatar" class="avatar">
          </div>
          
          </div>
        </form>
        
        </body>
        </html>';
    }

    if ($count == 0) {
        echo 'Pacient inexistent. Te rugam sa incerci din nou!';
    }
    
    ?>