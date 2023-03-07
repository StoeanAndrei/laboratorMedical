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
<h3 style="text-align: center">Modificare date medic</h3>

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

$ore = $_POST['ore'];

$query = "SELECT GM.OreConsult, GM.ID_Grad, M.ID_Medic
FROM  medici AS M
JOIN grade_medici AS GM
ON M.ID_Grad = GM.ID_Grad
WHERE M.Nume = '$numem' AND M.Prenume = '$prenumem';";

$prv = mysqli_query($connection, $query)
or die('Nu se pot prelua date!');

$count = mysqli_num_rows($prv);

while ($row1 = mysqli_fetch_array($prv)) {   
    if ($ore == '')
        $ore = $row1[0];
    else
        $ore = $ore + $row1[0];
    $idGrad = $row1[1];
    $idMedic = $row1[2];
}

    $query2 = "UPDATE grade_medici SET
    OreConsult = '$ore'
    WHERE ID_Grad = '$idGrad'";

    if (mysqli_query($connection, $query2))
        $prv2 = 1;
    else
        die('Nu se pot incarca datele in baza de date a gradelor medicilor!');

    echo '
    <p class="paragraph">Orele de lucru ale medicilor au fost modificate cu succes!</p>
    <br>';

    $query3 = "SELECT M.Nume, M.Prenume, M.Specializare, GM.OreConsult
	    FROM  medici AS M
      JOIN grade_medici AS GM
      ON M.ID_Grad = GM.ID_Grad";

      $prv3 = mysqli_query($connection, $query3)
or die('Nu se pot prelua date!');

      $count1 = mysqli_num_rows($prv3);

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

        while ($row3 = mysqli_fetch_array($prv3)) {
            echo '<td>', $i, '</td>';
            echo '<td>', $row3[0], '</td>';
            echo '<td>', $row3[1], '</td>';
            echo '<td>', $row3[2], '</td>';
            echo '<td>', $row3[3], '</td>';
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