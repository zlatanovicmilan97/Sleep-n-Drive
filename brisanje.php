<?php
  
        if(isset($_GET['id'])){

            $idRec=$_GET['id'];

            $upit="DELETE FROM recenzije WHERE recenzijaID=$idRec";
    
            include("phpIncludes/konekcija.php");
    
            try{
            $rezultat=$konekcija->query($upit);
    
            header("Location:index.php?stranica=recenzije&strana=1");
            }
            catch(PDOException $e){
                echo $e -> getMessage();
            }

        }
      


?>