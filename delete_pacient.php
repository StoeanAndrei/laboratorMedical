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
<h3 style="text-align: center">Stergere pacient</h3>

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
      
    $query0 = "SELECT ID_Pacient, ID_Adresa
    FROM pacienti
    WHERE Nume = '$nume' AND Prenume = '$prenume' AND CNP = '$cnp'";

    $prv0 = mysqli_query($connection, $query0)
or die('Nu se pot gasi datele din tabelul pacientilor!');

    //$count0 = mysqli_num_rows($prv0);

    while ($row0 = mysqli_fetch_array($prv0)) {
        $idPacient = $row0[0];
        $idAdresa = $row0[1];
    }

    $query2 = "SELECT ID_Buletin
    FROM buletine
    WHERE ID_Pacient = '$idPacient'";

    $prv2 = mysqli_query($connection, $query2)
or die('Nu se pot extrage datele din tabelul buletinelor pacientilor!');

    //$count2 = mysqli_num_rows($prv2);

    $idBuletin = 0;

    while ($row2 = mysqli_fetch_array($prv2)) {
        $idBuletin = $row2[0];
    }

    $query3 = "DELETE
    FROM detalii_buletin
    WHERE ID_Buletin = '$idBuletin'";

    $prv3 = mysqli_query($connection, $query3)
or die('Nu se pot sterge datele din tabelul detaliilor buletinelor ale pacientilor!');

    //$count3 = mysqli_num_rows($prv3);

    $query4 = "DELETE
    FROM buletine
    WHERE ID_Buletin = '$idBuletin'";

    $prv4 = mysqli_query($connection, $query4)
or die('Nu se pot sterge datele din tabelul buletinelor pacientilor!');

    //$count4 = mysqli_num_rows($prv4);

    $query5 = "DELETE FROM pacienti
    WHERE Nume = '$nume' AND Prenume = '$prenume' AND CNP = '$cnp'";

    $prv5 = mysqli_query($connection, $query5)
or die('Nu se pot sterge datele din tabelul pacientilor!');

    //$count5 = mysqli_num_rows($prv5);

    $query1 = "DELETE
    FROM adrese_pacienti
    WHERE ID_Adresa = '$idAdresa'";

    $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot sterge datele din tabelul adreselor pacientilor!');

    //$count1 = mysqli_num_rows($prv1);

    //if ($count1 == 1 && $count1 == 1 && $count2 == 1 && $count3 == 1 && $count4 == 1 && $count5 == 1) {
        echo '
        <p class="paragraph">Pacientul a fost eliminat!</p><br>';
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
        echo '<br><button onclick="history.go(-3);">Inapoi</button>';
    //}

echo '
</div>
</body>
</html>';
?>