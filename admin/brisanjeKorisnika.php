<?php 
    include("../phpIncludes/konekcija.php");
    if(isset($_GET['id'])){
        $korisnikID=$_GET['id'];
        $upit="DELETE FROM recenzije WHERE korisnikID=(SELECT korisnikID FROM korisnici WHERE korisnikID=:korisnikID)";
        $upit2="DELETE FROM korisnici WHERE korisnikID=:korisnikID";
        try{
        $rezultat=$konekcija->prepare($upit);
        $rezultat->bindParam(':korisnikID', $korisnikID);
        $rezultat2=$konekcija->prepare($upit2);
        $rezultat2->bindParam(':korisnikID', $korisnikID);
        $rezultat->execute();
        $rezultat2->execute();

            header('Location:korisnici.php?strana=1#ispisKorisnika');
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }
    }