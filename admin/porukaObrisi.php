<?php 
    include("../phpIncludes/konekcija.php");
    if(isset($_GET['id'])){
        $porukaID=$_GET['id'];
        $upit="DELETE FROM kontakt WHERE kontaktID=:porukaID";
        try{
        $rezultat=$konekcija->prepare($upit);
        $rezultat->bindParam(':porukaID', $porukaID);
        $rezultat->execute();

        header("Location:kontakt.php#ispisKorisnika");
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }
    }