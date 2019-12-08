<?php 

session_start();

if(isset($_SESSION['korisnik'])){
    unset($_SESSION['korisnik']);
    header("Location: index.php?stranica=index");
}else{
    echo "Niste se ni ulogovali";
}