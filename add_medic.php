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
<h3 style="text-align: center">Adaugare medic</h3>

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
    $parola = $_POST['parola'];
    $specializare = $_POST['specializare'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
      
    $query01 = "SELECT ID_Medic
    FROM medici
    ORDER BY ID_Medic
    DESC LIMIT 1";

    $prv01 = mysqli_query($connection, $query01)
or die('Nu se pot incarca date!');

    while ($row01 = mysqli_fetch_array($prv01)) {
        $idMedic = $row01[0]+1;
    }

    $query02 = "SELECT ID_Grad
    FROM grade_medici
    ORDER BY ID_Grad
    DESC LIMIT 1";

    $prv02 = mysqli_query($connection, $query02)
or die('Nu se pot incarca date!');

    while ($row02 = mysqli_fetch_array($prv02)) {
        $idGrad = $row02[0]+1;
    }

    $prv1 = 0;
    $prv2 = 0;

    $query2 = "INSERT INTO grade_medici
    VALUES ('$idGrad', '0', '0')";

    if (mysqli_query($connection, $query2))
        $prv2 = 1;
    else
        die('Nu se pot incarca datele in baza de date a gradelor medicilor!!');

    $query1 = "INSERT INTO medici
    VALUES ('$idMedic', '$nume', '$prenume', '$parola', '$specializare',
    '$email', '$telefon', '$idGrad')";

    if (mysqli_query($connection, $query1))
        $prv1 = 1;
    else
        die('Nu se pot incarca datele in baza de date a medicilor!');

    if ($prv1 == 1 && $prv2 == 1) {
        echo '
        <p class="paragraph">Medic adaugat cu succes!</p><br>';
        $query9 = "SELECT M.Nume, M.Prenume, M.Email, M.Telefon, GM.OreConsult
	    FROM  medici AS M
        JOIN grade_medici AS GM
        ON M.ID_Grad = GM.ID_Grad;";

        $prv9 = mysqli_query($connection, $query9)
    or die('Nu se pot prelua date!');

        $count9 = mysqli_num_rows($prv9);

        if ($count9 != 0) {
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

            while ($row9 = mysqli_fetch_array($prv9)) {
                echo '<td>', $i, '</td>';
                echo '<td>', $row9[0], '</td>';
                echo '<td>', $row9[1], '</td>';
                echo '<td>', $row9[2], '</td>';
                echo '<td>', $row9[3], '</td>';
                echo '<td>', $row9[4], '</td>';
                echo '</tr><tr>';
            $i++;
            }

        echo '</tr>';
        echo '</table>';
    }
        echo '<br>
        <button onclick="history.go(-2);">Inapoi</button>';
    }

echo '
</div>
</body>
</html>';
?>