<?php
session_start();
if(isset( $_SESSION['user'])&&isset($_SESSION['sifra']))
{

} else
{
    $_SESSION["user"]="";
    $_SESSION["sifra"]="";
}
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
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light " style="background-color: #e3f2fd;">
  <div class="container-fluid">
  <?php
      include './components/navbar.php';
    ?>
  </div>
</nav>
<?php
include './database/Konekcija na bazu(projekat).php';
$sql = "SELECT id, ime, imekreatora, opis, vreme FROM Igrica";
         $result = $conn->query($sql);
         $i=0;
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
              if($i%2==0)
              {
                echo '<div class="row m-5">';
              }
echo '
<div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><b>'.$row["ime"].'</b></h4>
                            <p class="card-text">'.$row["opis"].'</p>
                            <h6 class="card-title"> Ime kreatora: '.$row["imekreatora"].'</h6>
                            <p class="card-text"> Datum kreiranja igrice: '.$row["vreme"].'</p>
                            <a href="./pages/diskusija.php?id=' . $row["id"] . '" class="btn btn-success text-center" role="button">Otvorite diskusiju</a><!--izbrisan je deo koda*/-->
                        </div>
                    </div>
                    </div>
                      ';
                      $i++;
                      if($i%2==0)
                      {
                        echo '</div>';
                      } 
                  }
                }
                    ?>
<?php
#include 'footer.php';
?>
</body>
</html>