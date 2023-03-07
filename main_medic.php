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
<h3 style="text-align: center">Pagina medicului</h3>

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

      $nume = $_POST['nume'];
      $prenume = $_POST['prenume'];
      $parola = $_POST['parola'];
      
      $query1 = "SELECT M.Nume, M.Prenume, M.Specializare, GM.OreConsult
	    FROM  medici AS M
        JOIN grade_medici AS GM
        ON M.ID_Grad = GM.ID_Grad
        WHERE M.Nume = '$nume' AND M.Prenume = '$prenume' AND M.Parola = '$parola';";

      $prv1 = mysqli_query($connection, $query1)
or die('Nu se pot prelua date!');

      $count = mysqli_num_rows($prv1);

      if ($count == 1) {
      echo '<pre class = "tabs8">';
      while ($row1 = mysqli_fetch_array($prv1)) {
        echo 'Nume:                  &nbsp;&nbsp;', $row1[0], '<br>';
        echo 'Prenume:               &nbsp;&nbsp;', $row1[1], '<br>';
        echo 'Specializare:          &nbsp;&nbsp;', $row1[2], '<br>';
        echo 'Nr. ore de consult     &nbsp;&nbsp;', $row1[3], '<br>';
        echo '<br>';
      }
      echo '</pre>';

    echo '<br>
    <p>
        Fiecare medic are dreptul de a face modificari asupra bazei de date
        a acestui laborator medical. Asadar, aveti dreptul sa faceti urmatoarele actiuni:
    </p>
    <ul class="container" style="font-size: 18px; color: black;">
        <li><a href="add_pacient.html">Adaugare pacient nou</a></li>
        <li><a href="add_buletinanalize2.php">Adaugare analize pentru un pacient</a></li>
        <li><a href="add_medic.html">Adaugare medic nou</a></li>
        <li><a href="add_analiza.html">Adaugare tip nou de analiza</a></li>
        <li><a href="modificare_pacient.php">Modificare date pacient</a></li>		
        <li><a href="modificare_medic.php">Modificare ore de lucru</a></li>
        <li><a href="delete_pacient.html">Eliminare pacient</a></li>
    </ul>
    </div>
    ';
    }

    if ($count == 0) {
        echo 'Medic inexistent. Te rugam sa incerci din nou!';
    }

    echo '
    <div class="container">
    <p class="paragraph">Pentru a vedea numarul de pacienti asignati fiecarui
     medic, apasa butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href=\'complex1.php\'">Numar pacienti</button>
    </div>
    <br>
    <div class="container">
    <p class="paragraph">Pentru a vedea suma totala platita de fiecare pacient 
    pentru analizele sale, in ordine descrescatoare, apasa butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href=\'complex2.php\'">Valoare analize</button>
  </div>
  <br>
  <div class="container">
    <p class="paragraph">Pentru a vedea pacientii cu o anumita suma 
    cheltuita pentru analize, te rugam sa completezi campul de mai jos
    apoi sa apesi butonul corespunzator!
    </p>
    <br><br><br>
    <label for="valuare"><b>Valoare cautata</b></label>
    <input type="text" placeholder="Introduceti Valoare" name="valuare" required />
    <br>
    <button type="button" onclick="location.href=\'complex3.php\'">Cautare pacienti</button>
  </div>
  <br>
  <div class="container">
    <p class="paragraph">Pentru a afisa toti pacientii cu varste mai mari de 20 de ani
     pentru fiecare specializare, 
    te rugam sa apesi butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href=\'complex4.php\'">Pacienti adulti</button>
  </div>
  <br>
  <div class="container">
    <p class="paragraph">Pentru a vedea pacientii cu o suma 
    cheltuita pentru analize de 300 de lei,
    apoi sa apesi butonul corespunzator!
    </p>
    <br>
    <button type="button" onclick="location.href=\'complex5.php\'">Pacienti cu cheltuieli de 300 de lei</button>
  </div>
  <br>
  <div class="container">
    <p class="paragraph">Pentru a afisa toti pacientii cu cheltuieli mai mari de 300 de lei
    te rugam sa apesi butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href=\'complex6.php\'">Pacienti cu reducere</button>
  </div>
    ';

echo '
</form>
</body>
</html>';
?>