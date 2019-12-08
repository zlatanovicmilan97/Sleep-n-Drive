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
                            $upit="SELECT * FROM kontakt ORDER BY kontaktProcitano, kontaktID DESC";

                            
                            $rezultat=$konekcija->query($upit);
                            

                            if($rezultat){
                                $podaci=$rezultat->fetchAll();

                                

                                foreach($podaci as $podatak){
                                    if($podatak->kontaktProcitano==0){
                                        $poruka="<span style='color:green;'>Nova poruka!</span>";
                                        $link="<a href='porukaObrada.php?id=".$podatak->kontaktID."'>Procitaj</a>";
                                    }
                                    else
                                    {
                                        $poruka="<span>Procitano</span>";
                                        $link="<a href='porukaObrisi.php?id=".$podatak->kontaktID."' style='color:silver;'>Obrisi</a>";
                                    }
                                    $ispis="<div class='kontaktIspis'>
                                        <div id='kontaktIspisHeader'>
                                            <div id='headerIme'><p>".$podatak->kontaktIme."</p></div>
                                            <div id='headerEmail'>
                                            <p>".$poruka."</br>".$link."</a></p>
                                            <p>".$podatak->kontaktEmail."</p></div>
                                        </div>
                                        <div id='kontaktIspisPoruka'>
                                            <p>".$podatak->kontaktPoruka."</p>
                                            <p>".$podatak->kontaktID."</p>
                                        </div>
                                    </div>";
                                    echo $ispis;
                                }
                            }
                            
                        ?>

                       

                        <!-- <tr>
                            <td>1</td>
                            <td>Milan Zlatanovic</td>
                            <td>xmix97@live.com</td>
                            <td>milan123</td>
                            <td>milan123</td>
                        </tr> -->
                    </table>



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


            </script>
    </body>
</html>