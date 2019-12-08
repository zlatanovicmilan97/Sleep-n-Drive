<?php
    include("phpIncludes/konekcija.php");
    if(isset($_GET['porukaAnketa'])){
        $rbAnketa=$_GET['rb'];
        $chbAnketa=$_GET['chb'];

        $ispravno=[];
        $greske=[];

        if(empty($rbAnketa)){
            $greske[]="Cekirajte rb polje";
        }
        else
        {
            $ispravno[]=$rbAnketa;
        }

        if(empty($chbAnketa)){
            $greske[]="Cekirajte chb polje";
        }
        else{
            $chbString=implode(' ',$chbAnketa);
            $ispravno[]=$chbAnketa;
        }

        var_dump($chbString);

        if(count($greske)==0){
            $upit="INSERT INTO anketa VALUES ('',:rbPolje,:chbPolje)";
            try{
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(':rbPolje', $rbAnketa);
            $priprema->bindParam(':chbPolje', $chbString);
            $priprema->execute();

            header("Location:index.php?stranica=index");
            }
            catch(PDOException $e){
                echo $e -> getMessage();
            }

        }
        else
        {
            echo "Niste cekirali polja"; 
        }
    }