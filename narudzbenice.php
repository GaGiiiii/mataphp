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

  $query = "SELECT * FROM Narudzbenica";
	$result = mysqli_query($conn, $query);
  $karte = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <div class="col-md-6 col-sm-8 offset-sm-2 offset-md-3 my-5 text-left">
      
      <?php foreach($karte as $key=>$karta): ?>
          <p>Narudžbenica #<?php echo $key + 1; ?></p>
          <ul>
            <li>Ime: <?php echo $karta['ime']; ?></li>
            <li>Prezime: <?php echo $karta['prezime']; ?></li>
            <li>Email: <?php echo $karta['email']; ?></li>
            <li>Broj Telefona: <?php echo $karta['broj_telefona']; ?></li>
            <li>Broj Karata: <?php echo $karta['broj_karata']; ?></li>
          </ul>

      <?php endforeach; ?>

      <a href="index.php" class="mt-2" style="display: inline-block;">Nazad</a>

    </div>
  </div>

</body>
</html>