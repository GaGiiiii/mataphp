<?php 

  $server = "localhost";
  $username = "root";
  $dbName = "karte";
  $password = "";

  // Create connection
  $conn = mysqli_connect($server, $username, $password, $dbName);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $ime = '';
  $prezime = '';
  $brojTelefona = '';
  $email = '';
  $brojKarata = '';

  if(isset($_POST['naruci'])){
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $brojTelefona = $_POST['telefon'];
    $brojKarata = $_POST['broj_karata'];

    $sql = "INSERT INTO Narudzbenica (ime, prezime, email, broj_karata, broj_telefona) VALUES ('$ime', '$prezime', '$email', '$brojKarata', '$brojTelefona')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $fajl = "podaci.json";
    $pomocniNiz = [];
    $podaci = array(
      'ime'     => $ime,
      'prezime'     => $prezime,
      'email'     => $email,
      'broj_telefona'     => $brojTelefona,
      'broj_karata'     => $brojKarata,
    );
    $podaciKadaJeJSONPrazan = array(
      "0" => $podaci
    );
    $trenutniPodaci = file_get_contents($fajl);
    if($trenutniPodaci){
      $pomocniNiz = json_decode($trenutniPodaci, true);
      array_push($pomocniNiz, $podaci);
    }else{
      $pomocniNiz = $podaciKadaJeJSONPrazan;
    }
    
    $json_string = json_encode($pomocniNiz);
    file_put_contents($fajl, $json_string);

  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>RMT  Slagalica</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/5c5689b7a2.js"></script>
</head>
<body>
  
  
  <div class="container">
    <div class="col-md-6 col-sm-8 offset-sm-2 offset-md-3 my-5">
      <form method="POST">
        <fieldset>
          <legend>Naručite vaše karte</legend>
          <hr style="margin-top: 0;">
          <div class="form-group">
            <label for="ime">Ime</label>
            <input type="text" class="form-control" id="ime" name="ime" placeholder="Unesite Ime" required>
          </div>

          <div class="form-group">
            <label for="prezime">Prezime</label>
            <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesite Prezime" required>
          </div>

          <div class="form-group">
            <label for="telefon">Broj Telefona</label>
            <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Unesite Broj Telefona" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Unesite Email" required>
          </div>

          <div class="form-group">
            <label>Broj Karata</label>
            <select class="form-control" name="broj_karata">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <button type="submit" name="naruci" class="btn btn-primary" style="width: 100%;">Naruči &nbsp;<i class="fas fa-check"></i></button>
          <small class="form-text text-muted">Vaše podatke nikada nećemo podeliti ni sa kime i ostaju sigurni.</small>

        </fieldset>
      </form>

      <a href="narudzbenice.php" class="mt-4" style="text-align: center; display: block;">Prikaži sve</a>

    </div>
  </div>

</body>
</html>