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
<h3 style="text-align: center">Autentificare Admin</h3>

<form action="main_medic.php" method="post">
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <p class="paragraph">Salut!</p>
    <p class="paragraph">Pentur a putea modifica baza de date a laboratorului,
      te rog sa introduci numele, prenumele si parola din contul tau,
      apoi apasa butonul de mai jos.</p>
    <br>
    <label for="nume"><b>Nume</b></label>
    <input type="text" placeholder="Introduceti Nume" name="nume" required>

    <label for="prenume"><b>Prenume</b></label>
    <input type="text" placeholder="Introduceti Prenume" name="prenume" required>

    <label for="cnp"><b>Parola</b></label>
    <input type="password" placeholder="Introduceti Parola" name="parola" required>
        
    <button type="submit">Acces la baza de date</button>
  </div>
</form>

</body>
</html>
