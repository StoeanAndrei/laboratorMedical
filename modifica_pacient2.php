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
<h3 style="text-align: center">Modificare date pacient</h3>

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

$numem = $_POST['numem'];
$prenumem = $_POST['prenumem'];
$cnpm = $_POST['cnpm'];

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

$query = "SELECT P.Nume, P.Prenume, P.CNP, P.Sex, P.Varsta, P.Inaltime,
P.Greutate, P.Email, P.Telefon, A.Judet, A.Localitate, A.Strada, A.Numar,
P.ID_Pacient, A.ID_Adresa
FROM  pacienti AS P
JOIN adrese_pacienti AS A
ON P.ID_Adresa = A.ID_Adresa
WHERE P.Nume = '$numem' AND P.Prenume = '$prenumem' AND P.CNP = '$cnpm';";

$prv = mysqli_query($connection, $query)
or die('Nu se pot prelua date!');

$count = mysqli_num_rows($prv);

while ($row1 = mysqli_fetch_array($prv)) {   
    if ($nume == '')
        $nume = $row1[0];
    if ($prenume == '')
        $prenume = $row1[1];
    if ($cnp == '')
        $cnp = $row1[2];
    if ($sex == '')
        $sex = $row1[3];
    if ($varsta == '')
        $varsta = $row1[4];
    if ($inaltime == '')
        $inaltime = $row1[5];
    if ($greutate == '')
        $greutate = $row1[6];
    if ($email == '')
        $email = $row1[7];
    if ($telefon == '')
        $telefon = $row1[8];
    if ($judet == '')
        $judet = $row1[9];
    if ($localitate == '')
        $localitate = $row1[10];
    if ($strada == '')
        $strada = $row1[11];
    if ($numar == '')
        $numar = $row1[12];
    $idPacient = $row1[13];
    $idAdresa = $row1[14];
}

    $query2 = "UPDATE adrese_pacienti SET
    Judet = '$judet', Localitate = '$localitate',
    Strada = '$strada', Numar = '$numar'
    WHERE ID_Adresa = '$idAdresa'";

    if (mysqli_query($connection, $query2))
        $prv2 = 1;
    else
        die('Nu se pot incarca datele in baza de date a adreselor pacientilor!');

    $query1 = "UPDATE pacienti SET
    Nume = '$nume', Prenume = '$prenume', CNP = '$cnp',
    Sex = '$sex', Varsta = '$varsta', Inaltime = '$inaltime',
    Greutate = '$greutate', Email = '$email', Telefon = '$telefon'
    WHERE ID_Pacient = '$idPacient'";

    if (mysqli_query($connection, $query1))
        $prv1 = 1;
    else
        die('Nu se pot incarca datele in baza de date a pacientilor!');

    echo '
    <p class="paragraph">Datele pacientului au fost modificate cu succes!</p>
    <br>';

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
      echo '</table>';
    }

echo '
</div>
</form>
</body>
</html>';
?>