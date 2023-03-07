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
<h3 style="text-align: center">Analizele mele</h3>

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
      $cnp = $_POST['cnp'];
      
      $query1 = "SELECT P.Nume, P.Prenume, P.Email, A.Judet, A.Localitate, A.Strada
			FROM  pacienti AS P
      JOIN adrese_pacienti AS A
      ON P.ID_Adresa = A.ID_Adresa
      WHERE P.Nume = '$nume' AND P.CNP = '$cnp';";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot prelua date!');

      $count1 = mysqli_num_rows($prv1);

      if ($count1 == 1) {

      echo '<pre class = "tabs8">';
      while ($row1 = mysqli_fetch_array($prv1)) {
        echo 'Nume:       &nbsp;&nbsp;', $row1[0], '<br>';
        echo 'Prenume:    &nbsp;&nbsp;', $row1[1], '<br>';
        echo 'Email:      &nbsp;&nbsp;', $row1[2], '<br>';
        echo 'Judet:      &nbsp;&nbsp;', $row1[3], '<br>';
        echo 'Localitate: &nbsp;&nbsp;', $row1[4], '<br>';
        echo 'Strada:     &nbsp;&nbsp;', $row1[5], '<br>';
        echo '<br>';
      }
      echo '</pre>';

      echo '</div><br><div class="container"><table>';
      echo '<tr>';

      $query2 = "SELECT B.Date, A.Denumire, C.Denumire, A.Detaliu, DB.Valoare
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

      $prv2 = mysqli_query($connection, $query2)
or die('Nu se pot prelua date!');

      $count2 = mysqli_num_rows($prv2);
      $i = 1;

      echo '<br>
      In urmatorul tabel, sunt ilustrate analizele medicale ale dumneavoastra
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

      while ($row2 = mysqli_fetch_array($prv2)) {
        echo '<td>', $i, '</td>';
        echo '<td>', $row2[0], '</td>';
        echo '<td>', $row2[1], '</td>';
        echo '<td>', $row2[2], '</td>';
        echo '<td>', $row2[3], '</td>';
        echo '<td>', $row2[4], '</td>';
        echo '</tr><tr>';
        $i++;
      }
      echo '</tr>';
      echo '</table></div>';

      if ($count2 == 0) {
        echo 'Pacientul nu a fost analizat!';
    }
  }
  
  if ($count1 == 0) {
    echo 'Pacient inexistent!';
  }

echo '
<button onclick="history.go(-2);">Inapoi</button>
<br>
<br>
</body>
</html>';
?>