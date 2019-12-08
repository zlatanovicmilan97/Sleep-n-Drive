<?php
 include("phpIncludes/konekcija.php");
    if(isset($_POST['dodajSlikuDugme'])){
        $slika=$_FILES['dodajSlikuPutanja'];
        
        $nazivSlike=$slika['name'];
        $nazivSlike=time().$nazivSlike;
        
        $folder="images/".$nazivSlike;
        var_dump($folder);
        
        if (move_uploaded_file($slika['tmp_name'], $folder)) {

            $upit3="INSERT INTO galerija VALUES ('','$folder','$folder','0')";
            try{
            $rezultat=$konekcija->prepare($upit3);
            $rezultat->execute();
            header("Location:admin/galerija.php#ispisKorisnika");
            }
            catch(PDOException $e){
                echo $e -> getMessage();
            }

        }else{
            header("Location:admin/galerija.php#ispisKorisnika");
            
        }
        
        

        

    }