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

    $categorie = $_POST['categorie'];
    $denumire = $_POST['denumire'];
    $detalii = $_POST['detalii'];
    $pret = $_POST['pret'];
  
    $query = "SELECT ID_Categorie
    FROM categorii
    WHERE Denumire = '$categorie'";

    $prv = mysqli_query($connection, $query)
or die('Nu se pot prelua date!');
    
    $count = mysqli_num_rows($prv);
    
    while ($row = mysqli_fetch_array($prv)) {
        $idCategorie = $row[0];
    }

    if ($count == 0) {
        $query1 = "SELECT ID_Categorie
        FROM categorii
        ORDER BY ID_Categorie
        DESC LIMIT 1";

        $prv1 = mysqli_query($connection, $query1)
    or die('Nu se pot prelua date din tabelul cu categorii!');

        while ($row1 = mysqli_fetch_array($prv1)) {
            $idCategorie = $row1[0]+1;
        }

        $query2 = "INSERT INTO categorii
        VALUES ('$idCategorie', '$categorie')";

        $prv2 = mysqli_query($connection, $query2)
    or die('Nu se pot incarca date in tabelul categoriilor!');
    }

    $query3 = "SELECT ID_Analiza
    FROM analize
    ORDER BY ID_Analiza
    DESC LIMIT 1";

    $prv3 = mysqli_query($connection, $query3)
or die('Nu se pot selecta date din tabelul analizelor!');

    while ($row3 = mysqli_fetch_array($prv3)) {
        $idAnaliza = $row3[0]+1;
    }
    
    $query4 = "INSERT INTO analize
    VALUES ('$idAnaliza', '$denumire', '$detalii', '$pret', '$idCategorie')";
    
    $prv4 = mysqli_query($connection, $query4)
or die('Nu se pot incarca date in tabelul analizelor!');
    
    echo '
    <p class="paragraph">Tipul de analiza a fost adaugata la baza de date!</p><br>';
    $query9 = "SELECT Denumire, Detaliu, Pret
    FROM  analize";

    $prv9 = mysqli_query($connection, $query9)
or die('Nu se pot prelua date!');

    $count9 = mysqli_num_rows($prv9);

    if ($count9 != 0) {
        $i = 1;

        echo '</div><br><div class="container"><table>';
        echo '<tr>';

        echo '<td>Nr.Crt.</td>';
        echo '<td>Denumire</td>';
        echo '<td>Detaliu</td>';
        echo '<td>Pret</td>';
        echo '</tr><tr>';

        while ($row9 = mysqli_fetch_array($prv9)) {
            echo '<td>', $i, '</td>';
            echo '<td>', $row9[0], '</td>';
            echo '<td>', $row9[1], '</td>';
            echo '<td>', $row9[2], '</td>';
            echo '</tr><tr>';
        $i++;
        }

    echo '</tr>';
    echo '</table>';
}
    echo '<br><button onclick="history.go(-2);">Inapoi</button><br>';

echo '
</div>
</body>
</html>';
?>