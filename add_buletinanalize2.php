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

<form action="add_buletinanalize.php" method="post">
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <p class="paragraph">In tabelul de mai jos, sunt afisate toate analizele disponibile
        ale laboratorului nostru.</p>';
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'laboratormedical';
  
      $connection = mysqli_connect($host, $user, $password)
  or die('Nu se poate conecta la server!');
      $selection = mysqli_select_db($connection, $database)
  or die('Nu se poate gasi baza de date!');
      //mysql_close($connection);

      $query1 = "SELECT A.Denumire, A.Detaliu, A.Pret, C.Denumire
      FROM analize AS A
      JOIN categorii AS C
      ON A.ID_Categorie = C.ID_Categorie";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot incarca date!');

      echo '</div><br><div class="container"><table>';
      echo '<tr>';

      echo '<td>Nr.Crt.</td>';
      echo '<td>Denumire</td>';
      echo '<td>Descriere</td>';
      echo '<td>Pret</td>';
      echo '<td>Categorie</td>';
      echo '</tr><tr>';

      $i = 1;
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
      echo '</table><br><br>';


echo '
    <p class="paragraph">Pentru a putea adauga analize unui pacient la baza de date a laboratorului,
      te rog sa completezi campurile de mai jos,
      apoi apasa butonul corespunzator.</p>
    <br>
    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="nume" required>

    <label for="nume"><b>Prenume</b></label>
    <input type="text" placeholder="Introduceti Prenume" name="prenume" required>

    <label for="nume"><b>CNP</b></label>
    <input type="password" placeholder="Introduceti CNP" name="cnp" required>

    <label for="nume"><b>Analiza</b></label>
    <input type="text" placeholder="Introduceti Denumire Analiza" name="analiza" required>

    <label for="nume"><b>Rezultat</b></label>
    <input type="text" placeholder="Introduceti Rezultat" name="rezultat" required>

    <button type="submit">Adauga analize</button>
  </div>
</form>

</body>
</html>';
?>
