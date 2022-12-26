<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<?php
include '../components/navbar1.php';
?>
<br>
<h1 class="text-center">Registracija</h1>
    
    <br>
    <?php
        $passErr = $pass1Err = $imeErr = "";
        $pass = $pass1 = $ime = "";
        if($_SESSION["user"]==""&&$_SESSION["sifra"]=="")
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {   
            if (empty($_POST["ime"])) {
              $imeErr = "Korisnicko ime je neophodno!";
            } else {
              $ime = test_input($_POST["ime"]);
             
            }
            if (empty($_POST["pass"])) {
              $passErr = "Sifra je obavezna!";
            } else {
              $pass = test_input($_POST["pass"]);
          }
          if(empty($_POST["pass1"])) {
              $pass1Err = "Sifra je obavezna!";
          } else
          {
              $pass1=test_input($_POST["pass1"]);
              if($pass!=$pass1)
              {
                  $pass1Err="Sifre nisu iste!";
              }
          }
            if($pass1Err == "" && $imeErr == "" && $passErr=="")
            {
              include '../database/Konekcija na bazu(projekat).php';
              //TABLE
              /*$sql = "CREATE TABLE Korisnik (
                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  username VARCHAR(30) NOT NULL,
                  sifra VARCHAR(30) NOT NULL,
                  vreme TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                  )";*/
              //if ($conn->query($sql) === TRUE) {
                //  echo "Table created successfully <br>";
             // } else {
                //  echo "Error creating table: " . $conn->error;
             // }
              
              // UBACIVANJE POD
              $stmt = $conn->prepare("INSERT INTO Korisnik (username, sifra) VALUES (?, ?)");
              $stmt->bind_param("ss", $ime, $pass);
              $stmt->execute();
              
              $stmt->close();
              $conn->close();                                                                                                               
            }
              if($passErr == "" && $pass1Err == "" && $imeErr == "")
              {
                  echo '<h2 class="text-center">Uspesna registracija!</h2>';
                  $_SESSION["user"]=$ime;
                  $_SESSION["sifra"]=$pass;
              } 
          } 
        } else
        {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION["user"]="";
            $_SESSION["sifra"]="";
          }
        }
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
    ?>
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php if($_SESSION["user"]==""&&$_SESSION["sifra"]=="")
        {
          echo '<div class="form-group pl-5 pr-5">
          <label for="ime">Korisnicko ime:</label>
          <input type="text" class="form-control" name="ime" id="ime" placeholder="Korisnicko ime" value="' . $ime . '">
          <span class="error">' . $imeErr .'</span> 
      </div>
      <div class="form-group pl-5 pr-5">
          <label for="pass">Sifra:</label>
          <input type="password" class="form-control" name="pass" id="pass" value="' . $pass .'">
          <span class="error">' . $passErr . '</span>
      </div>
      <div class="form-group pl-5 pr-5">
          <label for="pass1">Ponovi sifru:</label>
          <input type="password" class="form-control" name="pass1" id="pass1" value="'. $pass1 .'">
          <span class="error">'. $pass1Err . '</span>
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-success text-center">Sign up</button>
      </div>';
        } else
      {
        echo '<div class="form-group text-center">
                <h3 class="text-center">Ulogovani ste!</h3>
                <h4 class="text-center">Da bi napravili novi nalog izlogujte se! </h4>
                <br>
                <button type="submit" class="btn btn-success text-center">Izlogujte se</button>
            </div>';
      }
        ?>    
        </form>
    </div>
    <?php
    #include 'footer.php';
    ?>
</body>
</html>