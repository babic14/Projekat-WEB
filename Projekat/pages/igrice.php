<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    
  </head>
  <body>
    <?php
        include '../components/navbar2.php';
   ?>
    <br>
    <h1 class="text-center"> Kreiranje igrice </h1>
    <?php
        $nameErr = $imekErr = $opisErr=$datumErr= "";
        $name = $imek = $opis = $datum= "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["name"])) {
            $nameErr = "Ime je obavezno!";
          } else {
            $name = test_input($_POST["name"]);
          }
          if (empty($_POST["imek"])) {
            $imekErr = "Ime kreatora je obavezno!";
          } else {
            $imek = test_input($_POST["imek"]);

          }
                if (empty($_POST["opis"])) {
                    $opisErr = "Opis je obavezan!";
                   } else {
                    $opis = test_input($_POST["opis"]);
                   }
                    if (empty($_POST["datum"])) {
                        $datumErr = "Datum je obavezan!";
                       } else {
                          $datum = test_input($_POST["datum"]);
                           }

          if($_SESSION["user"]=="")
          {
            echo "<h2 class='text-center'> Morate biti ulogovani da bi dodali igricu! </h2>";
          } else
          {
           
            if($nameErr== "" && $imekErr== "" && $datumErr== ""  && $opisErr== "" )
            {
              include '../database/Konekcija na bazu(projekat).php';
              
              
              // UBACIVANJE POD
              $stmt = $conn->prepare("INSERT INTO Igrica (ime,imekreatora,opis,vreme) VALUES (?,?,?,?)");
              $stmt->bind_param("ssss", $name, $imek, $opis, $datum);
              $stmt->execute();
              echo '<h4 class="text-center"> Igrica uspesno dodata! </h4>';
              $stmt->close();
              $conn->close();
            } 
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
            <div class="form-group pl-5 pr-5">
                <label for="name">Ime igrice:</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="error"><?php echo $nameErr;?></span>
            </div>
            <div class="form-group pl-5 pr-5">
                <label for="opis">Ime kreatora:</label>
                <input type="text" class="form-control" id="imek" name="imek">
                <span class="error"><?php echo $imekErr;?></span>
            </div>
            <div class="form-group pl-5 pr-5">
                <label for="opis">Opis igrice:</label>
                <textarea class="form-control" id="opis" name="opis" rows="3"></textarea>
                <span class="error"><?php echo $opisErr;?></span>
            </div>
            <div class="form-group pl-5 pr-5">
                <label for="opis">Datum kreiranja:</label>
                <input type="text" class="form-control" id="datum" name="datum">
                <span class="error"><?php echo $datumErr;?></span>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-success text-center">Dodaj igricu</button>
            </div>
        </form>
    </div>


  </body>
</html>