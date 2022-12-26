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
include '../components/navbar2.php';
?>
    <!--CREATE TABLE Igrica(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
ime VARCHAR(30) NOT NULL,
imekreatora VARCHAR(30) NOT NULL,
opis VARCHAR(100) NOT NULL,
vreme VARCHAR(100) NOT NULL
)
-->   
<!-- 
CREATE TABLE komentari (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_igrice INT(6) UNSIGNED NOT NULL,
ime_korisnika VARCHAR(30) NOT NULL,
opis VARCHAR(200),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(id_igrice) REFERENCES igrica(id)
)
-->    
<?php
       
       if(empty($_GET['id']))
       {

       } else
       {
         $_SESSION["id"]=$_GET['id'];
       }  
        include '../database/Konekcija na bazu(projekat).php';
        $sql = "SELECT id, ime, imekreatora, opis, vreme FROM Igrica";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($_SESSION["id"]==$row["id"])
                {  
                  echo ' <br><div class="col-sm-12">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title"><b>'. $row["ime"] .'</b></h4>
                          <p class="card-text">'. $row["opis"] .'</p>
                          <h6 class="card-title"> Kreator teme: '. $row["imekreatora"] .' </h6>
                          <p class="card-text"> Datum kreiranja: ' . $row["vreme"] .'</p>
                          
                      </div>
                  </div>
                  </div>';
                } else
                {

                }
            }
        }
        $conn->close();
        ?>
         <?php
              function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
              $opisErr="";
              $opis = "";
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["opis"])) {
                  $opisErr="Komentar ne moze biti prazan!";
                } else
                {
                  $opis=test_input($_POST["opis"]);
                }
                $ime=$_SESSION["user"];
                if($_SESSION["user"]=="")
                {
                  echo "<h2 class='text-center'> Da biste ostavili komentar morate biti ulogovani! </h2>";
                } else
                {
                  if($opisErr=="")
                  {
                    include '../database/Konekcija na bazu(projekat).php';
                    $stmt = $conn->prepare("INSERT INTO Komentari (id_igrice, ime_korisnika, opis) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $_SESSION["id"],  $_SESSION["user"],$opis);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close(); 
                  }
                }
              } 
        ?>
        <div>
      <?php
      $i=0;
        include '../database/Konekcija na bazu(projekat).php';
        $sql = "SELECT id, id_igrice, ime_korisnika, opis, reg_date FROM Komentari";
        $sql1="SELECT username ,administrator FROM Korisnik";
        $result1=$conn->query($sql1);
        if ($result1->num_rows > 0 ) {
          while($row = $result1->fetch_assoc()) {
            if($_SESSION["user"]==$row["username"])
            {
              if($row["administrator"])
              {
                $i=1;
              }
            }
          }}
        $result = $conn->query($sql);
        if ($result->num_rows > 0 ) {
          while($row = $result->fetch_assoc()) {
            if($_SESSION["id"]==$row["id_igrice"])
            {
                  echo '<br><p style="margin-left:20px;margin-bottom:0;">Komentarisao: ' . $row["opis"] . '<br>Komentar: ' . $row["ime_korisnika"] . '<br>Datum kreiranja: ' .$row["reg_date"].'</p>';
                  if($i==1)
                  {
                    echo '<a style="margin-left:20px; font-size:20px; background-color: #e3f2fd;" href="../handling/deleteComment.php?id=' . $row["id"] . '">Izbrisi komentar X</a><br><br>';
                  }
            }
          }
        }
        $conn->close();
      ?>
    </div>
   
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group pl-3 pr-3">
                <label for="opis">Komentar:</label>
                <textarea class="form-control" id="opis" name="opis" rows="3"></textarea>
                <span class="error"><?php echo $opisErr;?></span>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-success text-center">Komentarisi</button>
            </div>
        </form>
    </div>
    <?php
    #include 'footer.php';
    ?>
</body>
</html>
