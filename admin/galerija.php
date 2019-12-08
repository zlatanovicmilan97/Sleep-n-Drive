<?php
    include("../phpIncludes/konekcija.php");
    // if(isset($_GET['dodajSlikuDugme'])){
    //     $slika=$_FILES['dodajSlikuPutanja'];
    //     var_dump($slika);
        // $putanja=time().$slika;
        // $folder="images/".($putanja);

        // var_dump($target);
        
        // $upit3="INSERT INTO galerija VALUES ('','images/$putanja','images/$putanja','0')";

        // $rezultat=$konekcija->prepare($upit3);
        // $rezultat->execute();

        // if (move_uploaded_file($_GET['dodajSlikuPutanja'], $folder)) {
        //     $msg = "Image uploaded successfully";
        // }else{
        //     $msg = "Failed to upload image";
        // }
    
?>

<html>
    <head>
        <title>SnD  | ADMIN</title>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="shortcut icon" href="../images/ikonica.ico"/>
    </head>
    <body>
        <div id="adminOkvir">
            <div id="adminHeader">
                <div id="adminLogo">
                    <a href="admin.php"><img src="slike/adminLogo.png" alt="adminLogo"/></a>
                </div>
                <div id="adminPovratak">
                     <a href="../index.php">&#8594; Povratak na sajt</a>
                </div>
            </div>
            <div id="adminLinkovi">
            <ul id='adminIspisLink'>
                    <li><a href="admin.php">admin.php</a></li>
                    <li><a href="kontakt.php">kontakt.php</a></li>
                    <li><a href="korisnici.php?strana=1&&id=1">korisnici.php</a></li>
                    <li><a href="smestajParagraf.php">smestaj.php</a></li>
                    <li><a href="galerija.php"/>galerija.php</a></li>
                    <li><a href="anketa.php">anketa.php</a></li>
                    <li><a href="../index.php?stranica=recenzije&&strana=1">recenzije.php</a></li>
                    
                    </ul>
            </div>
            <div id="adminSadrzaj">
                <div id="korisniciPodaci">
                    <?php
                        $upit2="SELECT COUNT(*) FROM galerija";
                        
                        $rezultat=$konekcija->query($upit2);

                        if($rezultat){
                            $podaci=$rezultat->fetch();
                            foreach($podaci as $podatak){
                                $ispis="<span>Ukupan broj fotografija u galeriji:</br> <span id='brKorisnikaSpan'>".$podatak."</span></span>";
                            }
                            echo $ispis;
                        }
                    ?>
                </div>  
                <div id="ispisKorisnika">
                    <p>Tabelarni prikaz fotografija iz galerije:</p>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>LINK PUTANJA</th>
                            <th>SLIKA PUTANJA</th>
                            <th>VIDLJIVOST</th>
                        </tr>

                        <?php
                            $upit="SELECT * FROM galerija";

                            
                            $rezultat=$konekcija->query($upit);
                            

                            if($rezultat){
                                $podaci=$rezultat->fetchAll();

                                foreach($podaci as $podatak){
                                    $ispis="<tr>
                                                <td>".$podatak->slikaID."</td>
                                                <td>".$podatak->link_putanja."</td>
                                                <td>".$podatak->slika_putanja."</td>
                                                <td>".$podatak->vidljivost."</td>
                                                <td><a class='tabelaLink' id='prikaziSlikuDugme' href='../".$podatak->link_putanja."' target='blank'>Prikazi sliku</a></td>
                                                <td><a href='?id=".$podatak->slikaID."#izmenaSlikeForma'class='tabelaLink' id='slikaIzmeni'>Izmeni</a></td>
                                                
                                                <td><a href='brisanjeSlike.php?id=".$podatak->slikaID."' class='tabelaLink' id='slikaObrisi'>Obrisi</a></td>
                                                
                                            </tr>";
                                    echo $ispis;
                                }
                            }
                            
                        ?>

                       


                    </table>
                    <span>*Fotografija vidljivost (1) je vidljiva na stranici smestaj. (max. 4)</br>
                    *Fotografija vidljivost (0) je smestena u pozadini.</span></br>
                    <div id="dodajSliku">
                        
                        <!-- <input type="button" id="dodavanjeKorisnikaPrikaz" value="Dodaj fotografiju"/></br> -->
                        
                        <form action="../dodajSliku.php" method="POST" id="dodavanjeSlikeForma" enctype="multipart/form-data" >
                        <span><strong>Dodaj fotografiju:</strong></span></br>
                        <input type="file" name="dodajSlikuPutanja" id="dodajSlikuPutanja"><br/>

                            <!-- <p>Putanja slike: <input type='text' id='dodajSlikuPutanja' name='dodajSlikuPutanja' placeholder='Ispravna putanja do fotografije'/> --> <input type='submit' value='Dodaj' name='dodajSlikuDugme' id='dodajSlikuDugme'/></br></p>
                            
                        </form>
                        
                    </div></br>
                </div>
                
            </div>
        </div>


        <footer>

        </footer>
            <script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
            <script src="../assets/js/main.js"></script>
            
            <script type=text/javascript>

                // $('#dodavanjeKorisnikaPrikaz').click(function(){
				// 	$('#dodavanjeSlikeForma').slideToggle("slow");
                //      $('#dodajSlikuTekst').toggle();
				// });
                


            </script>
    </body>
</html>