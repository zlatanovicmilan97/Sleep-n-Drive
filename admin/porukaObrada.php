<?php
    include("../phpIncludes/konekcija.php");
    if(isset($_GET['id'])){
        $porukaID=$_GET['id'];

        $upit="UPDATE kontakt SET kontaktProcitano=1 WHERE kontaktID=:porukaID";

        try{
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(':porukaID', $porukaID);
        $priprema->execute();

        header("Location:kontakt.php#ispisKorisnika");
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }

    }