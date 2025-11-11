<?php
$this->extend('templates/public');

$this->section('page_title');
echo 'Referenties';
$this->endSection();

$this->section('page_description');
echo 'Bekijk onze uitgevoerde projecten en tevreden klanten.';
$this->endSection();

$this->section('content');

// De $url zou dan bijv. 'referentie1' zijn
$slug = $url ?? '';

// Default waarden
$title = 'Onbekend project';
$tekst_links = '';
$tekst_rechts = '';
$afbeeldingen = [];

// Dynamische inhoud op basis van slug
switch ($slug) {
    case 'willem-van-oranje':
        $title = 'CSG Willem van Oranje - Oud-Beijerland';
        $tekst_links = '	In opdracht van CSG de Willem van Oranje in Oud-Beijerland hebben wij dit project mogen realiseren. Het totale vloer oppervlak is 3500m2.
Na 16 jaar geleden ook dit project te hebben gestoffeerd, werd het tijd voor nieuwe vloerafwerking.
Na advies en overleg is er gekozen  voor Strong Object Premium 956 .
Dit is zonder enige twijfel de sterkste project PA naaldvilt in zijn soort.
';
        $tekst_rechts = 'Bij dit Full Service Project hebben wij naast het leveren en aanbrengen van de nieuwe vloerafwerking ook de bestaande oude vloerbedekking verwijderd en afgevoerd.
Als mede ook  alle meubilair in klaslokalen en kantoren uit en in gehuisd. 
Met de gekozen vloerafwerking kan de Willem van Oranje er weer probleemloos 15 jaar mee voorruit. 
';
        $afbeeldingen = [
            '/webAssets/img/ref1.jpg',
            '/webAssets/img/ref1_2.jpg',
        ];
        break;

    case 'zeeuwse-parel':
        $title = 'Vakantiepark De Zeeuwse Parel - Scherpenisse';
        $tekst_links = 'In opdracht van vakantiepark de Zeeuwse Parel in Scherpenisse heeft Kantoortapijt.NL dit
project mogen voorzien van 1200m2 nieuwe zachte modulaire vloerafwerking in de Sport en
Leisure hal alsmede de paden rondom de 2 padelbanen.
Vakantiepark de Zeeuwse Parel is een nieuw en modern vakantie park op het Zeeuwse eiland
Tholen aan de oevers van de Oosterschelde met vele voorzieningen waaronder 2 padelbanen
een sport en leisure centrum en wellness en restaurant.
Na een langdurig en zorgvuldige keuze traject met betrekking tot de vloerafwerking in de Sport
en Leisure hal als mede de paden rondom de Padelbanen is er gekozen voor de TARKETT Desso
Grain projecttapijttegel. Een van de aspecten die een belangrijke rol speelden in de keuze voor
de te kiezen vloerafwerking was de akoestische waarde. Gelegen naast een natuur gebied De
Pluimpot waren er strikte voorschriften met betrekking tot de akoestiek. De akoestische
voordelen van de zachte modulaire projecttapijttegel Desso Grain waren uit eindelijk van
doorslag gevende belang.';
        $tekst_rechts = 'DESSO Grain suggereert een subtiele beweging in de ruimte door zijn organische
hoog/laag-structuur. Daarmee worden de scherpe randen van het interieur verzacht
en worden natuurlijke vormen naar binnen gebracht. Grain is beschikbaar in twaalf
kleuren, waaronder neutrale tinten en meer opvallende kleuren, zoals rood en
grasgroen.
Met Tarkett Fusion, waarin de gekozen kwaliteit Grain zich in het bijzonder voor
leent, combineren we hoogwaardige duurzame design vloeren en tapijttegels. Voor
het eerst sinds de fusie tussen Tarkett en DESSO kunnen de vruchten worden
geplukt van deze samenwerking. De combinatie van Tarkett- en DESSO-vloeren
biedt, met hun grote verscheidenheid, een lange levensduur en
materiaalgezondheid; de juiste vloerbedekking voor veeleisende werkomgevingen.';
        $afbeeldingen = [
            '/webAssets/img/referentie2.jpg',
            '/webAssets/img/referentie2_1.jpg',
        ];
        break;

    case 'bouwbedrijf-vrolijk':
        $title = 'Hoofdkantoor Bouwbedrijf Vrolijk - Breda';
        $tekst_links = 'In opdracht van een van onze vaste opdrachtgevers Bouwbedrijf Vrolijk uit Breda hebben wij het kantoorpand van de Bredase bouwer mogen voorzien  nieuwe projecttapijttegels .
Na in het verleden het oude kantoorpand in Zevenbergen te hebben voorzien van  projecttapijttegels in de kwaliteit Tarkett Desso Airmaster original is voor het hoofdkantoor  in Breda. Gekozen voor   Trodon ,ons huismerk, met de kwaliteit Senso Twin kleur 9990. 
';
        $tekst_rechts = ' De keuze voor deze projecttapijttegel is mede bepaald door zijn uitstraling en het betaalbaar prijsniveau in combinatie met de uitmuntende kwaliteit en duurzaamheid.
Verdeeld over 3 verdiepingen is er tot volle tevredenheid van Bouwbedrijf Vrolijk 2550m2 van deze uitmuntende kwaliteit door onze monteurs aangebracht.
Kortom een vloer waarop gebouwd kan worden. 
';
        $afbeeldingen = [
            '/webAssets/img/referentie3.jpg',
            '/webAssets/img/referentie3_1.jpg',
        ];
        break;

    case 'paradigma-groep':
        $title = 'Regiokantoren Paradigma Groep';
        $tekst_links = 'In Rotterdam, Etten-Leur, Eindhoven en Schiphol-Rijk hebben wij in opdracht van de samenwerkende bedrijven groep Paradigma de regio kantoren voorzien van projecttapijttegels.
De Paradigma groep is een innovatieve en vooruitstrevende groep van samenwerkende bedrijven
Welke  uw organisatie kunnen ondersteunen bij de vitaliteit, inzetbaarheid en groei van Uw medewerkers.  Van arbodienstverlening tot re-integratie, begeleiding, training en ontwikkeling voor en van uw medewerkers. 
';
        $tekst_rechts = 'Passende bij de eigentijdse visie van Paradigma is er gekozen voor een frisse  vloerafwerking met moderne look. De keuze voor de vloerbedekking is bepaald in samenwerking met Camus-architectuur bureau voor  interieur en advies.
Gekozen is voor Trodon, ons huismerk, in de kwaliteit Senso Twin kleur 0982.
De keuze voor deze projecttapijttegel is mede bepaald door zijn uitstraling en het betaalbaar prijsniveau in combinatie met de uitmuntende kwaliteit en duurzaamheid. 
';
        $afbeeldingen = [
            '/webAssets/img/referentie4.jpg',
            '/webAssets/img/referentie4_1.jpg',
        ];
        break;

    case 'stichting-archipel-scholen':
        $title = 'Stichting Archipel Scholen - Vlissingen';
        $tekst_links = 'In opdracht van stichting Archipel Scholen te Vlissingen hebben wij de  vloerafwerking mogen
Leveren en aanbrengen in het tijdelijk schoolcomplex van de Archipelbasisschool Tweemaster-Kameleon in Oost Souburg.

In verband met toekomstige nieuwbouw is de Archipelbasisschool Tweemaster-Kameleon gehuisvest  in een tijdelijk scholencomplex.
Al snel na in gebruik name van het complex was er sprake van geluid gerelateerde klachten ten gevolgen van geluidsoverdracht van de bovenverdieping naar de onder verdieping. 

In goed overleg met OCS de huisvestingsadviseur van de stichting Archipel Scholen 
Is er besloten te kiezen voor een modulaire zachte vloerafwerking t.w. projecttapijttegels.
';
        $tekst_rechts = 'Gekozen is voor een projecttapijttegel van Modulyss in de kwaliteit First Stripes voorzien van de dBack akoestische backing. In verband met het tijdelijke karakter van de accommodatie hebben we projecttapijttegels gemonteerd met Tac-tiles zodat na demontage er geen beschadiging aan de bestaande vloerbedekking is.

Ook bij dit project hebben wij onze opdrachtgever volledig ontzorgd door al het meubilair in de klaslokalen en kantoor vertrekken uit en in te huizen.
Duurzaamheid staat bij de stichting Archipel scholen hoog in het vaandel, na het in gebruik nemen van de nieuwe school hebben de  projecttapijttegels uit de tijdelijke accommodatie  een nieuwe bestemming gekregen.   
';
        $afbeeldingen = [
            '/webAssets/img/referentie5.jpg',
            '/webAssets/img/referentie5_1.jpg',
        ];
        break;

    case 'contempera-interiour-meets-art':
        $title = 'Contempera Interiour Meets Art - Amsterdam';
        $tekst_links = 'Echt trots ,zijn we op de opdracht, welke we hebben mogen uitvoeren voor Contempera ,een High End interieur design company gevestigd op, de Overtoom, een historische locatie , in het centrum van onze hoofdstad Amsterdam .
Na een complete metamorfose aan de binnenzijden van het pand op de Overtoom, waar voorheen een o.a. een kerk, het leger des heils en geografische boekwinkel in waren gevestigd,
Hebben we een schitterende Therdex visgraat vloer 7001  van ruim 450m2 volledig verlijmd mogen installeren ,aangebracht op een zwevende ondervloer voorzien van vloerverwarming. 
';
        $tekst_rechts = 'De keuze voor de Therdex 7001 is mede bepaald  door het formaat van de visgraat planken en deze  biedt een scala aan mogelijkheden; de breedte past vier keer in de lengte, dat zorgt ervoor dat de vloer in verscheidene structuren verlegd kan worden. Diverse kleurschakeringen en de voelbare structuur geven de vloer een eigentijdse uitstraling met een moderne twist.';
        $afbeeldingen = [
            '/webAssets/img/referentie6.jpg',
            '/webAssets/img/referentie6_1.jpg',
        ];
        break;

    case 'flowserve':
        $title = 'Flowserve - Etten-Leur';
        $tekst_links = 'In opdracht van Office Topper Kantoormeubelen hebben wij nieuwe projecttapijttegels geleverd
en aangebracht bij Flow Serve .
De kantoor en productielocatie van Flow Serve Nederland is in Etten Leur gevestigd. Tijdens een
renovatie van de kantoren van Flow Serve Nederland hebben wij in totaal 5800m2 Tarkett Desso
Essence , verdeeld over meerdere fases, aangebracht als mede bestaande vloerafwerking
gedemonteerd en afgevoerd en waar nodig hersteld. Verder is er in de productiekantoren totaal
300m2 Forbo Flooring Marmoleum Real aangebracht.';
        $tekst_rechts = 'Desso Essence is een collectie duurzaam modulair tapijt, in de vorm van tapijttegels in vierkant
formaat, en kamerbreed tapijt. Een budgetvriendelijk tapijt dat voldoet aan de zwaarste
kwaliteitseisen voor toepassing in projecten. Door haar milieuvriendelijke samenstelling en
internationaal erkende milieucertificaten is Desso Essence ook geschikt als vloerbedekking in elk
groen project of gebouw.
Marmoleum Real combineert zorgvuldig geselecteerde individuele kleuren
tot een prachtig dessin in diverse kleurgradaties, van warme neutrale
kleuren en rustige grijstinten tot spannende kleuren en modieuze tinten.
Marmoleum Real gaat uitstekend samen met andere Marmoleum dessins
waardoor fantasierijke composities gemaakt kunnen worden.';
        $afbeeldingen = [
            '/webAssets/img/referentie7.jpg',
            '/webAssets/img/referentie7_1.jpg',
        ];
        break;

    case 'willem-van-oranje-2':
        $title = 'Entreehal en Aula CSG Willem van Oranje - Oud-Beijerland';
        $tekst_links = 'Voor CSG Willem van Oranje in Oud-Beijerland mochten wij, in samenwerking met Aannemingsbedrijf Fraanje en Architektenburo Roos en Ros, de entreehal en aula voorzien van een volledig nieuwe vloerafwerking. Deze centrale ruimtes waren toe aan een frisse, eigentijdse uitstraling die past bij de dynamiek vaneen scholengemeenschap. 
Tijdens de ontwerpfase werd duidelijk dat de vloer bestand moest zijn tegen intensief dagelijks gebruik door honderden leerlingen en medewerkers. Onze keuze viel daarom op een rubbervloer van Artigo, type Zeus, uitgevoerd in drie kleuren.

Rubbervloeren hebben meerdere voordelen: Uitermate duurzaam: bestand tegen intensief loopverkeer zonder kwaliteitsverlies. Natuurlijk product: rubber is een natuurproduct en gedurende de hele levenscyclus CO₂-neutraal.  Comfortabel & veilig: veerkrachtig en slipvast, wat het comfort en de veiligheid verhoogt. Designvrijheid: patronen en kleurcombinaties zijn uitstekend te integreren in moderne ontwerpen.
';
        $tekst_rechts = 'In slechts zeven werkdagen hebben wij het project succesvol afgerond:
Het verwijderen van de bestaande vloerafwerking (in totaal 1.560 m²).
Het zorgvuldig egaliseren van de ondervloer.
Het leggen van de nieuwe rubbervloer met creatieve patronen en kleuraccenten.
Dankzij de goede samenwerking met de opdrachtgever verliep het proces soepel en werd de planning volledig gehaald.
Naast de esthetische en functionele voordelen stond duurzaamheid centraal bij dit project. Door te kiezen voor een rubbervloer draagt de school actief bij aan een verantwoorde, toekomstbestendige inrichting. Bovendien hebben wij een maatwerk onderhoudsadvies opgesteld, zodat de vloer jarenlang mooi en probleemloos in gebruik blijft.
Het eindresultaat is een entreehal en aula die niet alleen praktisch en robuust zijn, maar ook een inspirerende uitstraling hebben. Elke dag maken honderden leerlingen gebruik van deze ruimte – en de vloer bewijst keer op keer zijn kracht, duurzaamheid en esthetische waarde.
';
        $afbeeldingen = [
            '/webAssets/img/referentie8.jpg',
            '/webAssets/img/referentie8_1.jpg',
        ];
        break;

    default:
        echo '<main class="container my-5"><p>Deze referentie is niet gevonden.</p></main>';
        $this->endSection();
        return;
}
?>

<main class="container my-5">
    <h1 class="mb-4"><?= esc($title) ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <p><?= esc($tekst_links) ?></p>
        </div>
        <div class="col-lg-4 project-images">
            <?php if (!empty($afbeeldingen[0])): ?>
                <img src="<?= esc($afbeeldingen[0]) ?>" class="img-fluid">
            <?php endif; ?>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-lg-4 project-images">
            <?php if (!empty($afbeeldingen[1])): ?>
                <img src="<?= esc($afbeeldingen[1]) ?>" class="img-fluid">
            <?php endif; ?>
        </div>
        <div class="col-lg-8">
            <p><?= esc($tekst_rechts) ?></p>
        </div>
    </div>

    <h4 class="my-5">Andere projecten</h4>
    <div class="row g-4">
        <?php
        $count = 0;

        $andereProjecten = [
            ['title' => 'CSG Willem van Oranje - Oud-Beijerland', 'img' => '/webAssets/img/ref1.jpg', 'url' => 'willem-van-oranje'],
            ['title' => 'Vakantiepark De Zeeuwse Parel - Scherpenisse', 'img' => '/webAssets/img/referentie2.jpg', 'url' => 'zeeuwse-parel'],
            ['title' => 'Hoofdkantoor Bouwbedrijf Vrolijk - Breda', 'img' => '/webAssets/img/referentie3.jpg', 'url' => 'bouwbedrijf-vrolijk'],
            ['title' => 'Regiokantoren Paradigma Groep', 'img' => '/webAssets/img/referentie4.jpg', 'url' => 'paradigma-groep'],
            ['title' => 'Stichting Archipel Scholen - Vlissingen', 'img' => '/webAssets/img/referentie5.jpg', 'url' => 'stichting-archipel-scholen'],
            ['title' => 'Contempera Interiour Meets Art - Amsterdam', 'img' => '/webAssets/img/referentie6.jpg', 'url' => 'contempera-interiour-meets-art'],
            ['title' => 'Flowserve - Etten-Leur', 'img' => '/webAssets/img/referentie7.jpg', 'url' => 'flowserve'],
            ['title' => 'Entreehal en Aula CSG Willem van Oranje - Oud-Beijerland', 'img' => '/webAssets/img/referentie8.jpg', 'url' => 'willem-van-oranje-2']
        ];
        shuffle($andereProjecten);
        ?>

        <?php foreach ($andereProjecten as $project): ?>
            <?php
            if ($count != 4 && $url != $project['url']) {
            ?>
                <div class="col-md-3">
                    <a href="/referenties/<?= $project['url'] ?>">
                        <img src="<?= esc($project['img']) ?>" alt="<?= esc($project['title']) ?>" class="img-fluid rounded">
                        <h6 class="mt-2"><?= esc($project['title']) ?></h6>
                    </a>
                </div>
            <?php
            $count++;
            }
            ?>
        <?php endforeach; ?>
    </div>
</main>

<?php $this->endSection(); ?>