<?php 
     include("../phpIncludes/konekcija.php");
    if(isset($_GET['id'])){
        $slikaID=$_GET['id'];
        echo $slikaID;
        $upit="DELETE FROM galerija WHERE slikaID=$slikaID";
        try{
        $rezultat=$konekcija->prepare($upit);
        $rezultat->execute();

        header("Location:galerija.php#ispisKorisnika");
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }
    }