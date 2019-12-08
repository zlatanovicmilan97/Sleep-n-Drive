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
                            include("../phpIncludes/konekcija.php");
                            $upit="SELECT COUNT(anketaID) FROM anketa";
                            $rezultat=$konekcija->query($upit);
                            if($rezultat){
                                $podaci=$rezultat->fetch();
                                foreach($podaci as $podatak){
                                    echo "Broj poslatih anketa: </br> ".$podatak;
                                }
                            }
                        ?>
                </div>  

                <div id="korisniciPodaci">
                <?php
                            $upit2="SELECT COUNT(*) FROM anketa WHERE registracija='da'";
                            $rezultat2=$konekcija->query($upit2);
                            if($rezultat2){
                                $podaci2=$rezultat2->fetch();
                                foreach($podaci2 as $podatak2){
                                    echo "Procenat registrovanih korisnika koji</br> su odgovorili na anketu: </br> ".$podatak2/10*100 ."%";
                                }
                            }
                        ?>
                </div>   
                               
                <div id="ispisKorisnika">
                        
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

                $('#dodavanjeKorisnikaPrikaz').click(function(){
					$('#formaDodavanjeKorisnika').slideToggle("slow");
				});


            </script>
    </body>
</html>