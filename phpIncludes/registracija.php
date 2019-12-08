<!-- Content -->
		<!--
			Note: To show a background image, set the "data-bg" attribute below
			to the full filename of your image. This is used in each section to set
			the background image.
		-->
        <section id="post" class="wrapper bg-img" data-bg="regPozadina.jpg">
            <div class="inner">
                <article id="registracijaBox" class="box">
                    <header>
                        <h2>Registracija:</h2>
                    </header>
                    <div class="content">
                    <form action="<?php echo $_SERVER['PHP_SELF']."?stranica=index"; ?>" method="POST" name="registracija" onSubmit="return provera()" >
                        <p>Ime i prezime:</p>
                        <input class="main-registracija-formular" type="text" id="imePrezime" name="imePrezime" placeholder="Veliko početno slovo, min.3, max.12, max.15(prezime)." autocomplete="on"/> <br/>
                        <p>E-mail:</p>
                        <input class="main-registracija-formular" type="text" id="eMail" name="email" placeholder="E-mail adresa u važećem formatu." autocomplete="on"/> <br/>
                        <p>Korisničko ime:</p>
                        <input class="main-registracija-formular" type="text" id="korisnickoIme" name="korIme" placeholder="Mala i velika slova, min.7, max.20, bez razmaka." autocomplete="on" /> <br/>
                        <p>Lozinka:<p>
                        <input class="main-registracija-formular" type="password" id="pasvord" name="pasvord" placeholder="Min.8 karaktera, min.1 slovo i broj."/>
                        <p>Potvrdite lozinku:<p>
                        <input class="main-registracija-formular" type="password" id="pasvord2" name="pasvord2" placeholder="Potvrdite lozinku" />
                        <p>Država:</p>
                        <select class="main-registracija-formular" id="ddlDrzava" name="ddlDrzavaPolje">
                            <?php
                                $upit="SELECT * FROM country";
                                $rezultat = $konekcija->query($upit);
                                $ispis="<option value='0'>Izaberite</option>";

                                if($rezultat){
                                    $podaci = $rezultat->fetchAll();
                                    foreach($podaci as $podatak){
                                        $ispis.="<option value='".$podatak->countryname."' class='main-registracija-formular-option'>".$podatak->countryname."</option>";
                                    }
                                    echo $ispis;
                                }
                            ?>
                        </select>
                        <br/> <br/>
                        <input class="main-registracija-formular-dugme" id="main-kontakt-formular-dugme" type="submit" name="formaPotvrdi" value="Potvrdi"/> 
                        <input class="main-registracija-formular-reset" id="main-kontakt-formular-reset" type="reset" id="formaPonisti" name="formaPonisti" value="Poništi"/> 
                    </form>
                    </div>
                </article>
            </div>
        </section>