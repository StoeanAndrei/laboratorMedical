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
<h3 style="text-align: center">Modificare date pacient</h3>

<form action="modifica_pacient2.php" method="post">
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>
  <div class="container">
  <p class="paragraph">In tabelul de mai jos, sunt afisati toti pacientii nostri.</p>
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
      
        $query1 = "SELECT Nume, Prenume, CNP
	    FROM  pacienti";

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
        echo '<td>CNP</td>';
        echo '</tr><tr>';

        while ($row1 = mysqli_fetch_array($prv1)) {
            echo '<td>', $i, '</td>';
            echo '<td>', $row1[0], '</td>';
            echo '<td>', $row1[1], '</td>';
            echo '<td>', $row1[2], '</td>';
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
    <p class="paragraph">Pentru a putea modifica datele unui pacient din baza de date a laboratorului,
      te rog sa completezi numele, prenumele si CNPul pacientului dorit.</p>
    <br>
    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="numem" required>

    <label for="nume"><b>Prenume</b></label>
    <input type="text" placeholder="Introduceti Prenume" name="prenumem" required>

    <label for="nume"><b>CNP</b></label>
    <input type="text" placeholder="Introduceti CNP" name="cnpm" required>
    
    <br><br><br>
    <p class="paragraph">Completeaza campurile de mai jos pentru a modifica
        datele dorite pentru modificat, apoi apasa butonul din josul paginii.</p>
    <br>

    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="nume">

    <label for="nume"><b>Prenume</b></label>
    <input type="text" placeholder="Introduceti Prenume" name="prenume">

    <label for="nume"><b>CNP</b></label>
    <input type="text" placeholder="Introduceti CNP" name="cnp">
    
    <label for="nume"><b>Sex</b></label>
    <input type="text" placeholder="Introduceti Sex" name="sex">

    <label for="nume"><b>Varsta</b></label>
    <input type="text" placeholder="Introduceti Varsta" name="varsta">

    <label for="nume"><b>Inaltime</b></label>
    <input type="text" placeholder="Introduceti Inaltime" name="inaltime">

    <label for="nume"><b>Greutate</b></label>
    <input type="text" placeholder="Introduceti Greutate" name="greutate">

    <label for="nume"><b>Email</b></label>
    <input type="text" placeholder="Introduceti Email" name="email">

    <label for="nume"><b>Telefon</b></label>
    <input type="text" placeholder="Introduceti Telefon" name="telefon">

    <label for="nume"><b>Judet</b></label>
    <input type="text" placeholder="Introduceti Judet" name="judet">

    <label for="nume"><b>Localitate</b></label>
    <input type="text" placeholder="Introduceti Localitate" name="localitate">
    
    <label for="nume"><b>Strada</b></label>
    <input type="text" placeholder="Introduceti Strada" name="strada">
    
    <label for="nume"><b>Numar</b></label>
    <input type="text" placeholder="Introduceti Numar" name="numar">

    <br><br><br>
    <button type="submit">Modifica datele pacientului</button>
    <br><br><br>
  </div>
</form>

</body>
</html>';
