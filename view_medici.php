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
<h3 style="text-align: center">Medicii nostri</h3>

<form>
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>
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
      
      $query1 = "SELECT M.Nume, M.Prenume, M.Email, M.Telefon, GM.OreConsult
	    FROM  medici AS M
      JOIN grade_medici AS GM
      ON M.ID_Grad = GM.ID_Grad;";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot prelua date!');

      $count1 = mysqli_num_rows($prv1);

      if ($count1 != 0) {
        $i = 1;

        echo '</div><br><div class="container"><table>';
        echo '<tr>';

        echo '<td>Nr.Crt.</td>';
        echo '<td>Nume</td>';
        echo '<td>Prenume</td>';
        echo '<td>Email</td>';
        echo '<td>Telefon</td>';
        echo '<td>Nr. ore de consult</td>';
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
      echo '</table>';
  }
  
  if ($count1 == 0) {
    echo 'Nu exista medici!';
  }

echo '
</div>
</form>
</body>
</html>';
?>