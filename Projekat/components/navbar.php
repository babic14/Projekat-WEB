<?php

if($_SESSION["user"]==""&&$_SESSION["sifra"]=="")
                    {
                        echo '
      <img src="./images/Predrag Babić 7.jpg" style="height:40px ">
    <div class="navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./pages/logovanje.php">Prijavite se</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./pages/registracija.php">Registrujte se</a>
        </li>
      </ul>
    
    </div>
    ';
                    }else
                    {
                      
      $i=0;
        include './database/Konekcija na bazu(projekat).php';
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
      if($i==1)
      {
        echo '
        <img src="./images/Predrag Babić 7.jpg" style="height:40px ">
      <div class="navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pages/izlogovanje.php">Logged In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pages/igrice.php">Dodaj igricu</a>
          </li>
        </ul>
        
      </div>
      ';
        
      } else
      {
        echo '
                      <img src="./images/Predrag Babić 7.jpg" style="height:40px ">
                    <div class="navbar-collapse" id="mynavbar">
                      <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="./pages/izlogovanje.php">Logged In</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#"></a>
                        </li>
                      </ul>
                      
                    </div>
                    ';
      }
        $conn->close();
      }
?>