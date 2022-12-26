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
<h1 class="text-center"> Logovanje </h1>
    <br>
    <?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    $Err = "";
    $pass = $ime = "";
    $i=0;
    if($_SESSION["user"]==""&&$_SESSION["sifra"]=="")
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {          
          $pass=test_input($_POST["pass"]);
          $ime=test_input($_POST["ime"]);
          include '../database/Konekcija na bazu(projekat).php';
          $sql = "SELECT * FROM Korisnik";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["username"]==$ime&&$row["sifra"]==$pass)
                {
                    $i++;
                } else
                {
                    $Err="Ne postoji korisnik sa ovim parametrima!";
                }
                if($i==1)
                {
                    $Err="";
                    break;
                }
            }
        }
        if($Err=="")
        {
            echo '<h2 class="text-center">Uspesno logovanje!</h2><br>';
            $_SESSION["user"]=$ime;
            $_SESSION["sifra"]=$pass;
        }
            //TABLE
          //  $sql = "CREATE TABLE Korisnik (
             //  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             //   username VARCHAR(30) NOT NULL,
               // sifra VARCHAR(30) NOT NULL,
              //  vreme TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
             //   )";
          //  if ($conn->query($sql) === TRUE) {
           //     echo "Table created successfully <br>";
           // } else {
               // echo "Error creating table: " . $conn->error;
           // }
        }
    } else
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $_SESSION["user"]="";
            $_SESSION["sifra"]="";
        }
    } 
    ?>
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
        if($_SESSION["user"]==""&&$_SESSION["sifra"]=="")
        {
            echo '<div class="form-group pl-5 pr-5">
                <label for="email">Korisnicko ime:</label>
                <input type="text" class="form-control" name="ime" id="ime" placeholder="E-mail" value="'.$ime.'">
            </div>
            <div class="form-group pl-5 pr-5">
                <label for="pass">Sifra:</label>
                <input type="password" class="form-control" name="pass" id="pass" value="'. $pass.'">
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-success text-center">Log in</button>
              <br><br>
              <span class="error">' . $Err .'</span>
            </div>';
        } else
        {

            echo '
            <div class="form-group text-center">
                <h3 class="text-center">Ulogovani ste! </h3>
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