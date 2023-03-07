<?php
echo '
<!DOCTYPE html>
<html>
<head>
<title>MedicalLAB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stil.css">
<link rel="shortcut icon" type="image/png" href="hospital.png">
</head>
<body>

<h1 style="text-align: center">Laborator Medical</h1>
<h3 style="text-align: center">Adaugare pacient</h3>

<form>
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>
</form>
  <div class="container">';
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
    $cnp = $_POST['cnp'];
    $sex = $_POST['sex'];
    $varsta = $_POST['varsta'];
    $inaltime = $_POST['inaltime'];
    $greutate = $_POST['greutate'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $judet = $_POST['judet'];
    $localitate = $_POST['localitate'];
    $strada = $_POST['strada'];
    $numar = $_POST['numar'];
    $numem = $_POST['numem'];
    $prenumem = $_POST['prenumem'];
      
    $query01 = "SELECT ID_Pacient
    FROM pacienti
    ORDER BY ID_Pacient
    DESC LIMIT 1";

    $prv01 = mysqli_query($connection, $query01)
or die('Nu se pot incarca date!');

    while ($row01 = mysqli_fetch_array($prv01)) {
        $idPacient = $row01[0]+1;
    }

    $query02 = "SELECT ID_Adresa
    FROM adrese_pacienti
    ORDER BY ID_Adresa
    DESC LIMIT 1";

    $prv02 = mysqli_query($connection, $query02)
or die('Nu se pot incarca date!');

    while ($row02 = mysqli_fetch_array($prv02)) {
        $idAdresa = $row02[0]+1;
    }

    $prv1 = 0;
    $prv2 = 0;
    $prv3 = 0;

    $query2 = "INSERT INTO adrese_pacienti
    VALUES ('$idAdresa', '$judet', '$localitate', '$strada', '$numar')";

    if (mysqli_query($connection, $query2))
        $prv2 = 1;
    else
        die('Nu se pot incarca datele in baza de date a adreselor pacientilor!!');

    $query1 = "INSERT INTO pacienti
    VALUES ('$idPacient', '$nume', '$prenume', '$cnp', '$sex',
    '$varsta', '$inaltime', '$greutate', '$email', '$telefon', '$idAdresa')";

    if (mysqli_query($connection, $query1))
        $prv1 = 1;
    else
        die('Nu se pot incarca datele in baza de date a pacientilor!');

    $query03 = "SELECT ID_Buletin
    FROM buletine
    ORDER BY ID_Buletin
    DESC LIMIT 1";

    $prv03 = mysqli_query($connection, $query03)
or die('Nu se pot incarca date!');

    while ($row03 = mysqli_fetch_array($prv03)) {
        $idBuletin = $row03[0]+1;
    }

    $query04 = "SELECT ID_Medic
    FROM medici
    WHERE Nume = '$numem' AND Prenume = '$prenumem'";

    $prv04 = mysqli_query($connection, $query04)
or die('Nu se pot incarca date!');

    while ($row04 = mysqli_fetch_array($prv04)) {
        $idMedic = $row04[0];
    }

    $date = "Analize generale";
    $query3 = "INSERT INTO buletine
    VALUES ('$idBuletin', '$date', '$idMedic', '$idPacient')";

    if (mysqli_query($connection, $query3))
        $prv3 = 1;
    else
        die('Nu se pot incarca datele in baza de date a buletinelor!');

    if ($prv1 == 1 && $prv2 == 1 && $prv3 == 1) {
        echo '
        <p class="paragraph">Pacient adaugat cu succes!</p><br>';
        $query6 = "SELECT P.Nume, P.Prenume, P.Email, A.Judet, A.Localitate, A.Strada
        FROM  pacienti AS P
        JOIN adrese_pacienti AS A
        ON P.ID_Adresa = A.ID_Adresa";
  
        $prv6 = mysqli_query($connection, $query6)
  or die('Nu se pot prelua date!');
  
        $count6 = mysqli_num_rows($prv6);
  
        if ($count6 != 0) {
          $i = 1;
  
          echo '<br><div class="container"><table>';
          echo '<tr>';
  
          echo '<td>Nr.Crt.</td>';
          echo '<td>Nume</td>';
          echo '<td>Prenume</td>';
          echo '<td>Email</td>';
          echo '<td>Judet</td>';
          echo '<td>Localitate</td>';
          echo '<td>Strada</td>';
          echo '</tr><tr>';
        while ($row6 = mysqli_fetch_array($prv6)) {
              echo '<td>', $i, '</td>';
              echo '<td>', $row6[0], '</td>';
              echo '<td>', $row6[1], '</td>';
              echo '<td>', $row6[2], '</td>';
              echo '<td>', $row6[3], '</td>';
              echo '<td>', $row6[4], '</td>';
              echo '<td>', $row6[5], '</td>';
              echo '</tr><tr>';
          $i++;
          }
  
        echo '</tr>';
        echo '</table><br><br>';
      }
        echo '<button onclick="history.go(-2);">Inapoi</button>';
    }

echo '
</div>
</body>
</html>';
?>