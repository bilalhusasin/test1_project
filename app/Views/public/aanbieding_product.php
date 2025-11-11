<?php
foreach($queryProds->result() as $row){
    
    $_SESSION['offerte_price_incl'] = number_format($row->legprijs_normaal-($row->legprijs_normaal/100*$row->korting), 2);
    $_SESSION['offerte_price_excl'] = number_format($row->leverprijs_normaal-($row->leverprijs_normaal/100*$row->korting), 2);
?>
<div class="content">
    <div class="container">
        <div class="col-sm-12">
            <div class="col-md-3 col-sm-4 col-xs-12 geenpadding zoeken1">
                <form method="POST" action="<?php echo base_url(); ?>m_producten/search_field" class="navbar-form navbar-left zoeken" role="search">
                    <div class="form-group has-feedback zoeken">
                        <input type="text" name="search_field" class="form-control zoeken2" placeholder="Zoek in ons assortiment">
                        <i class="glyphicon glyphicon-search form-control-feedback zoeken3"></i>
                    </div>
                </form>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12 projectensubpagina desktop2 balkproducten">
                <div class="projecten5">5 JAAR GARANTIE</div>
                <div class="projecten6">42000 m<sup>2</sup> UIT VOORRAAD LEVERBAAR</div>
                <div class="projecten7">PROFESSIONELE LEGGERS</div>

            </div>
            <div class="col-xs-12 projecten4 projectensubpagina2 mobiel2">
                <div class="projecten5">5 JAAR GARANTIE</div>
                <div class="projecten6">42000 m<sup>2</sup> UIT VOORRAAD LEVERBAAR</div>
                <div class="projecten7">PROJECTEN</div>
            </div>
        </div>
        <div class="col-xs-12 productpagina">
            <div class="desktop3">
                <div class="col-md-3 col-sm-4 geenpadding">
                    <div class="staalaanvraag">
                        <h3>STAAL AANVRAAG</h3>
                        <form action="#" method="post">
                            <div class="input3box">
                                <label for="naam" class="inputtext3">Naam:</label>
                                <input type="text" name="naam" id="naam" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="email" class="inputtext3">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="telefoon" class="inputtext3">Telefoon:</label>
                                <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="postcode" class="inputtext3">Postcode:</label>
                                <input type="text" name="postcode" id="postcode" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="huisnummer" class="inputtext3">Huisnummer:</label>
                                <input type="text" name="huisnummer" id="huisnummer" class="form-control input3">
                            </div>
                            <button type="button" class="btn btn-default belterugbutton">
                                VERSTUREN
                            </button>
                        </form>
                    </div>
                    <div class="seizoensactie2">
                        <img src="<?php echo base_url(); ?>assetsWeb/img/herfstactie.png" class="img-responsive seizoensimg">
                        <div class="testtext1">
                            <h3>Samples</h3>
                            <h1>24</h1>
                            <h4>staaltjes</h4>
                        </div>
                        <div class="lijntje2"></div>
                        <div class="testtext2">
                            <h3>Binnen</h3>
                            <h1>24</h1><h3 class="sub24">uur</h3>
                            <h4>Geleverd</h4>
                        </div>
                    </div>
                </div>                
                <div class="col-md-9 col-sm-8 geenpadding2 productinformatie2">
                    <div class="col-sm-6 col-xs-12 geenpadding2">
                        <div class="productafbeelding">
                            <img src="<?php echo base_url($row->afbeelding); ?>" class="img-responsive">
                            <div class="prijstag"></div>
                            <h5>Prijs per m<sup>2</sup></h5>
                            <h2>&euro; <?php echo number_format($row->leverprijs_normaal-($row->leverprijs_normaal/100*$row->korting), 2, ',', '.') ?></h2>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-xs-12 geenpadding3 productinformatie">
                        <div class="productinformatie3">
                            <h3 class="aanbieding_h3">AANBIEDING</h3>
                            <h1><?php echo ucfirst($row->vloer_soort)." ".ucfirst($row->merk)." ".ucfirst($row->titel)." ".$row->kleur_code."-".ucfirst($row->kleurnaam); ?></h1>
                            <p>
                                <?php echo $row->samenvatting; ?>
                            </p>
                            <h4><a id="inline" href="#data">Product informatie</a></h4>
                            
                            <div style="display:none">
                                <div id="data"><?php echo $row->omschrijving; ?></div>
                            </div>
                            
                            <h3>Dit product = Direct leverbaar</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 geenpadding2 productpaginasub">
                    <div class="col-md-3 col-sm-4 geenpadding">
                        <div class="directcontact">
                            <h3><i class="fa fa-phone"></i> DIRECT CONTACT</h3>
                            <form action="#" method="post">
                                <div class="input3box">
                                    <label for="naam" class="inputtext3">Naam:</label>
                                    <input type="text" name="naam" id="naam" class="form-control input3">
                                </div>
                                <div class="input3box">
                                    <label for="telefoon" class="inputtext3">Telefoon:</label>
                                    <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                                </div>
                                <button type="button" class="btn btn-default belterugbutton">
                                    BEL MIJ TERUG
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9 geenpadding2 productpaginasub2">
                        <div class="col-md-offset-6 col-md-6 sfeerafbeeldingproductpagina geenpadding3">
                            <div class="col-sm-6 col-xs-12 geenpadding2 directofferte2">    
                                <div class="directofferte">
                                <h3>OFFERTE <br/><b>EXCL.</b> MONTAGE</h3>
                                    <form action="#" method="post">
                                        <div class="input4box">
                                            <input type="text" name="meter" id="meter" class="form-control input4 meter1" placeholder="Vul hier m2 in">
                                            <label for="meter" class="inputtext4">m<sup>2</sup></label>
                                        </div>
                                        <div class="input4box">    
                                            <input type="text" name="prijs" id="prijs" class="form-control input4" value="&euro; <?php echo number_format($_SESSION['offerte_price_excl'], 2, ',', '.'); ?>" disabled>
                                            <label for="prijs" class="inputtext4">Prijs</label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="totaal" id="totaal" class="form-control input4 totaal1" disabled>
                                            <label for="totaal" class="inputtext4">Totaal</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 geenpadding2 directofferte2">
                                <div class="directofferte" style="float: right;">
                                    <h3>OFFERTE <br/><b>INCL.</b> MONTAGE</h3>
                                    <form action="#" method="post">
                                        <div class="input4box">
                                            <input type="text" name="meter" id="meter" class="form-control input4 meter2" placeholder="Vul hier m2 in">
                                            <label for="meter" class="inputtext4">m<sup>2</sup></label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="prijs" id="prijs" class="form-control input4" value="&euro; <?php echo number_format($_SESSION['offerte_price_incl'], 2, ',', '.'); ?>" disabled>
                                            <label for="prijs" class="inputtext4">Prijs</label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="totaal" id="totaal" class="form-control input4 totaal2" disabled>
                                            <label for="totaal" class="inputtext4">Totaal</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="mobiel3">
                <div class="col-sm-6 col-xs-6 geenpadding">
                    <div class="staalaanvraag">
                        <h3>STAAL AANVRAAG</h3>
                        <form action="#" method="post">
                            <div class="input3box">
                                <label for="naam" class="inputtext3">Naam:</label>
                                <input type="text" name="naam" id="naam" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="email" class="inputtext3">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="telefoon" class="inputtext3">Telefoon:</label>
                                <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="postcode" class="inputtext3">Postcode:</label>
                                <input type="text" name="postcode" id="postcode" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="huisnummer" class="inputtext3">Huisnummer:</label>
                                <input type="text" name="huisnummer" id="huisnummer" class="form-control input3">
                            </div>
                            <button type="button" class="btn btn-default belterugbutton">
                                VERSTUREN
                            </button>
                        </form>
                    </div>
                    <div class="seizoensactie2">
                        <img src="<?php echo base_url(); ?>assetsWeb/img/herfstactie.png" class="img-responsive seizoensimg">
                        <div class="testtext1">
                            <h3>Samples</h3>
                            <h1>24</h1>
                            <h4>staaltjes</h4>
                        </div>
                        <div class="lijntje2"></div>
                        <div class="testtext2">
                            <h3>Binnen</h3>
                            <h1>24</h1><h3 class="sub24">uur</h3><br />
                            <h4>Geleverd</h4>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 geenpadding2 productpaginasub">
                        <div class="col-sm-12 col-xs-12 geenpadding2">
                            <div class="directcontact">
                                <h3><i class="fa fa-phone"></i> DIRECT CONTACT</h3>
                                <form action="#" method="post">
                                    <div class="input3box">
                                        <label for="naam" class="inputtext3">Naam:</label>
                                        <input type="text" name="naam" id="naam" class="form-control input3">
                                    </div>
                                    <div class="input3box">
                                        <label for="telefoon" class="inputtext3">Telefoon:</label>
                                        <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                                    </div>
                                    <button type="button" class="btn btn-default belterugbutton">
                                        BEL MIJ TERUG
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 geenpadding2 overigekleuren">
                            <h3>OVERIGE KLEUREN</h3>
                            <div class="col-xs-12 geenpadding2 kleurenafbeeldingen">
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="../../../../../assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 sfeerafbeeldingproductpagina geenpadding3">
                                <div class="sfeerafbeelding"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6 geenpadding2 productinformatie2">
                    <div class="col-sm-12 col-xs-12 geenpadding2">
                        <div class="productafbeelding">
                            <img src="../../../../../assetsWeb/img/product1.jpg" class="img-responsive">
                            <div class="prijstag"></div>
                            <h5>Prijs per m<sup>2</sup></h5>
                            <h2>&euro; 17.00</h2>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 geenpadding3 productinformatie">
                        <div class="productinformatie3">
                            <h1>DERSIMO ATOMIC 475</h1>
                            <p>
                                Met smaak en eigen identiteit. Atomic tapijt geeft elk interieur een verrassend jonge uitstraling. De stoere structuren en speelse kleurenmix benadrukken de eigentijdse look. Een krachtig tapijt voor iedereen die uniek wil zijn. Zet je zinnen op een gewaagd, strak en sterk tapijt.
                            </p>
                            <h4>Product informatie</h4>
                            <h3>Dit product = Direct leverbaar</h3>
                            <div class="col-sm-12 col-xs-12 geenpadding2 directofferte2">
                                <div class="directofferte">
                                    <h3>DIRECT OFFERTE</h3>
                                    <form action="#" method="post">
                                        <div class="input4box">
                                            <input type="text" name="meter" id="meter" class="form-control input4">
                                            <label for="meter" class="inputtext4">m<sup>2</sup></label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="prijs" id="prijs" class="form-control input4">
                                            <label for="prijs" class="inputtext4">Prijs</label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="totaal" id="totaal" class="form-control input4">
                                            <label for="totaal" class="inputtext4">Totaal</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 geenpadding3 beoordeling2">
                                <div class="beoordeling">
                                    <h3>Klanten geven ons een</h3><br /><br />
                                    <h1>9.5</h1>
                                    <h1 class="slash">/</h1>
                                    <h1 class="tien">10</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobiel4">
                <div class="col-sm-12 col-xs-12 geenpadding2 productinformatie2">
                    <div class="col-sm-12 col-xs-12 geenpadding2">
                        <div class="productafbeelding">
                            <img src="../../../../../assetsWeb/img/product1.jpg" class="img-responsive">
                            <div class="prijstag"></div>
                            <h5>Prijs per m<sup>2</sup></h5>
                            <h2>&euro; 17.00</h2>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 geenpadding2 productinformatie">
                        <div class="productinformatie3">
                            <h1>DERSIMO ATOMIC 475</h1>
                            <p>
                                Met smaak en eigen identiteit. Atomic tapijt geeft elk interieur een verrassend jonge uitstraling. De stoere structuren en speelse kleurenmix benadrukken de eigentijdse look. Een krachtig tapijt voor iedereen die uniek wil zijn. Zet je zinnen op een gewaagd, strak en sterk tapijt.
                            </p>
                            <h4><span>Product informatie</span></h4>
                            <h3>Dit product = Direct leverbaar</h3>
                            <div class="col-sm-12 col-xs-12 geenpadding2 directofferte2">
                                <div class="directofferte">
                                    <h3>DIRECT OFFERTE</h3><br />
                                    <form action="#" method="post">
                                        <div class="input4box">
                                            <input type="text" name="meter" id="meter" class="form-control input4">
                                            <label for="meter" class="inputtext4">m<sup>2</sup></label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="prijs" id="prijs" class="form-control input4">
                                            <label for="prijs" class="inputtext4">Prijs</label>
                                        </div>
                                        <div class="input4box">
                                            <input type="text" name="totaal" id="totaal" class="form-control input4">
                                            <label for="totaal" class="inputtext4">Totaal</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 geenpadding2 beoordeling2">
                                <div class="beoordeling">
                                    <h3>Klanten geven ons een</h3><br /><br />
                                    <h1>9.5</h1>
                                    <h1 class="slash">/</h1>
                                    <h1 class="tien">10</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12 geenpadding2">
                    <div class="staalaanvraag">
                        <h3>STAAL AANVRAAG</h3>
                        <form action="#" method="post">
                            <div class="input3box">
                                <label for="naam" class="inputtext3">Naam:</label>
                                <input type="text" name="naam" id="naam" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="email" class="inputtext3">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="telefoon" class="inputtext3">Telefoon:</label>
                                <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="postcode" class="inputtext3">Postcode:</label>
                                <input type="text" name="postcode" id="postcode" class="form-control input3">
                            </div>
                            <div class="input3box">
                                <label for="huisnummer" class="inputtext3">Huisnummer:</label>
                                <input type="text" name="huisnummer" id="huisnummer" class="form-control input3">
                            </div>
                            <button type="button" class="btn btn-default belterugbutton">
                                VERSTUREN
                            </button>
                        </form>
                    </div>
                    <div class="seizoensactie2">
                        <img src="<?php echo base_url(); ?>assetsWeb/img/herfstactie.png" class="img-responsive seizoensimg">
                        <div class="testtext1">
                            <h3>Samples</h3>
                            <h1>24</h1>
                            <h4>staaltjes</h4>
                        </div>
                        <div class="lijntje2"></div>
                        <div class="testtext2">
                            <h3>Binnen</h3>
                            <h1>24</h1><h3 class="sub24">uur</h3><br />
                            <h4>Geleverd</h4>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 geenpadding2 productpaginasub">
                        <div class="col-sm-12 col-xs-12 geenpadding2">
                            <div class="directcontact">
                                <h3><i class="fa fa-phone"></i> DIRECT CONTACT</h3>
                                <form action="#" method="post">
                                    <div class="input3box">
                                        <label for="naam" class="inputtext3">Naam:</label>
                                        <input type="text" name="naam" id="naam" class="form-control input3">
                                    </div>
                                    <div class="input3box">
                                        <label for="telefoon" class="inputtext3">Telefoon:</label>
                                        <input type="tel" name="telefoon" id="telefoon" class="form-control input3">
                                    </div>
                                    <button type="button" class="btn btn-default belterugbutton">
                                        BEL MIJ TERUG
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 geenpadding2 overigekleuren">
                            <h3>OVERIGE KLEUREN</h3>
                            <div class="col-xs-12 geenpadding2 kleurenafbeeldingen">
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur1.jpg" class="img-responsive">
                                </div>
                                <div class="col-xs-3 geenpadding2">
                                    <img src="<?php echo base_url(); ?>assetsWeb/img/kleur2.jpg" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 sfeerafbeeldingproductpagina geenpadding2">
                                <div class="sfeerafbeelding"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
<?php
}
?>