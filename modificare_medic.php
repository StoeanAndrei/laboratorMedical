<?php
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
<h3 style="text-align: center">Modificare date medic</h3>

<form action="modificare_medic2.php" method="post">
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>
  <div class="container">
  <p class="paragraph">In tabelul de mai jos, sunt afisati toti medicii nostri.</p>
    </div><br>';

      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'laboratormedical';

      $connection = mysqli_connect($host, $user, $password)
  or die('Nu se poate conecta la server!');
      $selection = mysqli_select_db($connection, $database)
  or die('Nu se poate gasi baza de date!');
      //mysql_close($connection);
      
        $query1 = "SELECT M.Nume, M.Prenume, M.Specializare, GM.OreConsult
	    FROM  medici AS M
      JOIN grade_medici AS GM
      ON M.ID_Grad = GM.ID_Grad";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot prelua date!');

      $count1 = mysqli_num_rows($prv1);

      if ($count1 != 0) {
        $i = 1;

        echo '<br><div class="container"><table>';
        echo '<tr>';

        echo '<td>Nr.Crt.</td>';
        echo '<td>Nume</td>';
        echo '<td>Prenume</td>';
        echo '<td>Specializare</td>';
        echo '<td>Ore lucrate</td>';
        echo '</tr><tr>';

        while ($row1 = mysqli_fetch_array($prv1)) {
            echo '<td>', $i, '</td>';
            echo '<td>', $row1[0], '</td>';
            echo '<td>', $row1[1], '</td>';
            echo '<td>', $row1[2], '</td>';
            echo '<td>', $row1[3], '</td>';
            echo '</tr><tr>';
        $i++;
        }

      echo '</tr>';
      echo '</table>';
  }
  
  if ($count1 == 0) {
    echo 'Nu exista pacienti!';
  }

  echo '
  </div><br><br>
  <div class="container">
    <p class="paragraph">Pentru a putea adauga ore de lucru unui medic din baza de date a laboratorului,
      te rog sa completezi numele si prenumele medicului dorit.</p>
    <br>
    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="numem" required>

    <label for="nume"><b>Prenume</b></label>
    <input type="text" placeholder="Introduceti Prenume" name="prenumem" required>

    <br><br><br>
    <p class="paragraph">Completeaza campul de mai jos pentru a adauga
        orele reale de lucru ale mdeicului ales, apoi apasa butonul din josul paginii.</p>
    <br>

    <label for="nume"><b>Ore lucrate</b></label>
    <input type="text" placeholder="Introduceti numar de ore" name="ore">

    <br><br><br>
    <button type="submit">Modifica datele medicului</button>
    <br><br><br>
  </div>
</form>

</body>
</html>';
