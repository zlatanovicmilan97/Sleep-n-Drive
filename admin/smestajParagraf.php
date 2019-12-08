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
                        $upit2="SELECT COUNT(*) FROM kontakt WHERE kontaktProcitano=0";
                        include("../phpIncludes/konekcija.php");
                        $rezultat=$konekcija->query($upit2);

                        if($rezultat){
                            $podaci=$rezultat->fetch();
                            foreach($podaci as $podatak){
                                if($podatak==0){
                                    $brPoruka="<span id='brKorisnikaSpan'>".$podatak."</span>";
                                }
                                else
                                {
                                    $brPoruka="<span id='brKorisnikaSpan' style='color:green;'>".$podatak."</span>";
                                }
                                $ispis="<span>Nove poruke:</br>".$brPoruka."</span>";
                            }
                            echo $ispis;
                        }
                    ?>
                </div>  
                <div id="ispisKorisnika">
                    <?php
                    $upit="SELECT * FROM smestaj_paragraf";
                    $rezultat=$konekcija->query($upit);

                    if($rezultat){
                        $podaci=$rezultat->fetchAll();
                        foreach($podaci as $podatak){
                            $ispis="<div class='paragraf' style='margin-bottom:20px;'>
                                <div id='paragrafID'>".$podatak->paragrafID."<a href='?id=".$podatak->paragrafID."#paragrafIzmena' style='float:right;'>Izmeni</a>
                                </div>
                                <div id='paragrafText'>".$podatak->paragrafText."
                                </div>
                            </div>";
                            echo $ispis;
                        }
                    }
                    ?>

                </div>
                <div id='paragrafIzmena' style='float:left;'/>
                
                    
                    <?php
                        if(isset($_GET['id'])){
                            $idPar=$_GET['id'];
                            
                            $upitPar="SELECT * FROM smestaj_paragraf WHERE paragrafID=$idPar";
                            $rezultatPar=$konekcija->query($upitPar);

                            if($rezultat){
                                $podaciPar=$rezultatPar->fetchAll();
                                foreach($podaciPar as $podatakPar){
                                    $ispisPar="<span id='parIzmenaID' style='display:none;'>".$podatakPar->paragrafID."</span>";
                                    $ispisPar.="<textarea id='parIzmenaText' style='width:400%; margin-left:20%; color:white; height:25%;'>".$podatakPar->paragrafText."</textarea>";
                                }
                                echo $ispisPar;
                            }
                        }
                    ?>
                    <input type='button' value='izmeni' name='izmeniParDugme' onclick='izmeniParagraf();'/>
                    </form>
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

                $('#dodavanjeKorisnikaPrikaz').click(function(){
					$('#formaDodavanjeKorisnika').slideToggle("slow");
				});

                function izmeniParagraf(){
                    var idPar=$('#parIzmenaID').text();
                    var textPar=$('#parIzmenaText').val();
                    
                    $.ajax({
                        url:'paragrafIzmena.php',
                        type:'GET',
                        dataType:'json',
                        data:{
                            id:idPar,
                            polje:textPar,
                            poslato:"Poslati podaci"
                        }
                    });

                }


            </script>
    </body>
</html>