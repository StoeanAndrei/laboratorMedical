<!DOCTYPE html>
<html>
<head>
<title>MedicalLAB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="stil.css">
<link rel="shortcut icon" type="image/png" href="hospital.png">
</head>
<body>

<h1 style="text-align: center">Laborator Medical</h1>
<h3 style="text-align: center">Bun venit!</h3>

<form>
  <div class="imgcontainer">
    <img src="prima.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <p class="paragraph">Bun venit!</p>
    <p class="paragraph">Acesta este laboratorul tau medical de oriunde.
      Cel mai bun laborator medical din toate timpurile,
      cu diagnoza rapida si remediu la secunda.</p>
    <p class="paragraph">Profitati acum de cea mai tare oferta a noastra si
      viziteaza-ne pentru un consult amanuntit!</p>
    <br>
    <p class="paragraph">In caz ca ai facut-o deja si doresti sa vezi
      analizele, apasa pe butonul de mai jos!</p>
    <br>
    <button type="button" onclick="location.href='logare_pacient.php'">Analizele mele</button>
  </div><div class="container">
    <p class="paragraph">Pentru mai multe detalii despre medicii nostri,
      te rugam sa accesezi butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href='view_medici.php'">Medicii din laborator</button>
  </div>

  <div class="imgcontainer">
    <img src="doi.jpg" alt="Avatar" class="avatar" style="width: 26%">
  </div>

  <div class="container">
    <p class="paragraph">Pentru a te autentifica ca si admin,
      te rugam sa accesezi butonul de mai jos!
    </p>
    <br>
    <button type="button" onclick="location.href='logare_medici.php'">Administrator</button>
  </div>
</form>

</body>
</html>
