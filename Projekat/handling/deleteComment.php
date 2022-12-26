<?php 
    session_start();
    include "../database/Konekcija na bazu(projekat).php";
    $sql = "DELETE FROM komentari WHERE id=" . $_GET["id"];
    if($conn->query($sql) === TRUE)
    {
        header('Location: http://pedja.com/projekat/pages/diskusija.php?id=' . $_SESSION["id"]); 
    }
?>