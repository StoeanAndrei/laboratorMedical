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
<h3 style="text-align: center">Analizele pacientului</h3>

<form action="analize_pacient.php" method="post">
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <p class="paragraph">Salut!</p>
    <p class="paragraph">Pentur a-ti vedea analizele,
      te rog sa introduci numele tau de familie si codul numeric personal,
      apoi apasa butonul de mai jos.</p>
    <br>
    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="nume" required>

    <label for="cnp"><b>CNP</b></label>
    <input type="password" placeholder="Introduceti CNP" name="cnp" required>
        
    <button type="submit">Analizele mele</button>
  </div>
</form>

</body>
</html>
