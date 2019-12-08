<?php
     include("../phpIncludes/konekcija.php");
     if(isset($_GET['poslato'])){
        $parID=$_GET['id'];
        $parText=$_GET['polje'];
       
        echo $parID;
        echo $parText;
        
        try{
        $upit="UPDATE smestaj_paragraf SET paragrafText=:polje WHERE paragrafID=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(':id',$parID);
        $priprema->bindParam(':polje',$parText);
        $priprema->execute();

        header('Location:smestajParagraf.php#korisniciPodaci');
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }

     }

       