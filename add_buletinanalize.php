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
<h3 style="text-align: center">Adaugare analize pacient</h3>

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
    $analiza = $_POST['analiza'];
    $rezultat = $_POST['rezultat'];
      
    $query0 = "SELECT B.ID_Buletin
	FROM pacienti AS P
    JOIN buletine AS B
    ON P.ID_Pacient = B.ID_Pacient
    WHERE P.Nume = '$nume' AND P.Prenume = '$prenume' AND P.CNP = '$cnp';";

    $prv0 = mysqli_query($connection, $query0)
or die('Nu se pot prelua date!');

    $count0 = mysqli_num_rows($prv0);

    while ($row0 = mysqli_fetch_array($prv0)) {
        $idBuletin = $row0[0];
    }

    // merg in analize sa iau ID_Analiza dupa $analiza
    $query2 = "SELECT ID_Analiza
	FROM analize
    WHERE Denumire = '$analiza';";

    $prv2 = mysqli_query($connection, $query2)
or die('Nu se pot prelua date!');

    $count2 = mysqli_num_rows($prv2);

    while ($row2 = mysqli_fetch_array($prv2)) {
        $idAnaliza = $row2[0];
    }

    // merg in detalii_buletin sa iau ultimul+1
    $query3 = "SELECT ID_Detaliu
	FROM detalii_buletin
    ORDER BY ID_Detaliu
    DESC LIMIT 1";

    $prv3 = mysqli_query($connection, $query3)
or die('Nu se pot prelua date!');

    $count3 = mysqli_num_rows($prv3);

    while ($row3 = mysqli_fetch_array($prv3)) {
        $idDetaliu = $row3[0]+1;
    }

    // merg in detalii_buletin sa pun $rezultat
    $query4 = "INSERT INTO detalii_buletin
    VALUES ('$idDetaliu', '$rezultat', '$idAnaliza', '$idBuletin')";

    $prv4 = mysqli_query($connection, $query4)
or die('Nu se pot scrie date!');

    //$count4 = mysqli_num_rows($prv4);

    //if ($prv1 == 1 && $prv2 == 1) {
        echo '
        <p class="paragraph">Analiza adaugata cu succes la buletin!</p><br>';
        echo '</div><br><div class="container"><table>';
      echo '<tr>';

      $query1 = "SELECT B.Date, A.Denumire, C.Denumire, A.Detaliu, DB.Valoare
      FROM buletine AS B
      JOIN pacienti AS P
      JOIN detalii_buletin AS DB
      JOIN analize AS A
      JOIN categorii AS C
      ON P.ID_Pacient = B.ID_Pacient
      AND B.ID_Buletin = DB.ID_Buletin
      AND DB.ID_Analiza = A.ID_Analiza
      AND A.ID_Categorie = C.ID_Categorie
      WHERE P.Nume = '$nume';";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot prelua date!');

      $count1 = mysqli_num_rows($prv1);
      $i = 1;

      echo '<br>
      In urmatorul tabel, sunt ilustrate analizele medicale ale pacientului:
      <br><br><br>
      ';

      echo '<tr>';

      echo '<td>Nr.Crt.</td>';
      echo '<td>Analiza</td>';
      echo '<td>Denumire</td>';
      echo '<td>Categorie</td>';
      echo '<td>Descriere</td>';
      echo '<td>Rezultat</td>';
      echo '</tr><tr>';

      while ($row1 = mysqli_fetch_array($prv1)) {
        echo '<td>', $i, '</td>';
        echo '<td>', $row1[0], '</td>';
        echo '<td>', $row1[1], '</td>';
        echo '<td>', $row1[2], '</td>';
        echo '<td>', $row1[3], '</td>';
        echo '<td>', $row1[4], '</td>';
        echo '</tr><tr>';
        $i++;
      }
      echo '</tr>';
      echo '</table></div>';
        echo '<br><button onclick="history.go(-2);">Inapoi</button><br>';
    //}

echo '
</div>
</body>
</html>';
?>