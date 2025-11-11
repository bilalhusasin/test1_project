<?php
$this->extend('templates/public');

$this->section('page_title');
echo 'Over ons - Tapijtwebsite';
$this->endSection();

$this->section('page_description');
echo 'Lees meer over wie wij zijn, onze visie, werkwijze en waarom klanten voor ons kiezen.';
$this->endSection();

$this->section('content');
?>

<main class="vloer-bh-jaar-1">
    <!-- hero -->
    <section class="hero-area vloer-hero">
        <div class="container">
            <div class="hero-wrapper d-grid justify-content-between align-items-center">
                <div class="hero-content order-2 order-lg-1">
                    <h1 class="fw-bold">Vakkundige projectstoffering specialist</h1>
                    <p>Kantoortapijt.nl is dé projectstoffering specialist van Nederland en al meer dan 45 jaar een vaste waarde in de wereld van professionele vloerafwerking. Wat begon als een familiebedrijf met een passie voor vloeren, is uitgegroeid tot een allround en professioneel team van specialisten dat projecten realiseert in eigen land én daarbuiten. Al 25 jaar zijn wij ook online actief, als één van de eerste in onze branche.</p>
                    <p>Of het nu gaat om projectstoffering van kantoren, scholen, hotels, bungalowparken, tijdelijke huisvesting of zelfs schepen: wij leveren en monteren projectgeschikte vloerafwerking van hoge kwaliteit. Denk aan tapijttegels, projecttapijt, PVC-stroken en -tegels, projectvinyl, linoleum en loslegvloeren. Elk project, groot of klein, krijgt bij ons de volle aandacht.</p>
                </div>
                <div class="hero-thumb position-relative overflow-hidden order-1 order-lg-2">
                    <img src="https://tapijtwebsite.nl/uploads/cobbles_690,_meadow_683_0.jpg.webp" class="w-100" alt="Over ons hero afbeelding">
                    <h3 class="mb-0 fw-bold text-white position-absolute start-50 translate-middle-x bottom-0 z-1 w-75 text-center rounded-0">Over ons</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- wie zijn wij -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4">Wat wij doen</h2>
            <p>Als projectstoffering specialist richten we ons op het adviseren, leveren en monteren van duurzame en professionele vloeroplossingen voor nieuwbouw, renovatie of tijdelijke inrichting. Onze kracht ligt in de combinatie van technisch inzicht, esthetisch advies en een praktische, doelgerichte aanpak. We denken met u mee, geven advies op maat en zorgen dat elk detail klopt.</p>
            <p>Voor vaste opdrachtgevers voeren we ook internationale projecten uit in onder andere België, Frankrijk, Duitsland, Engeland, Oostenrijk, Zwitserland en Spanje. Zo blijven we groeien zonder onze kernwaarden los te laten.</p>
        </div>
    </section>

    <!-- onze werkwijze -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Onze werkwijze</h2>
            <p>Wij werken altijd vanuit een helder stappenplan. Wij bereiden elke fase van een project zorgvuldig voor en voeren deze met aandacht uit, van het eerste contact tot de oplevering. Daarbij heeft u altijd één vast aanspreekpunt. Geen verrassingen, geen ruis, maar heldere communicatie, duidelijke afspraken en een betrouwbare planning. Onze monteurs zijn VCA-gecertificeerd, ervaren en gemotiveerd. We besteden veel aandacht aan veiligheid, gezondheid, Arbo-regels en milieubewust werken.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Waar wij als projectstoffering specialist voor staan</h2>
            <p>Waar wij als projectstoffering specialist voor staan</p>
            <ul class="list-unstyled ps-3">
                <li>✔️ Heldere communicatie: Duidelijke afspraken, vaste contactpersonen, en open overleg</li>
                <li>✔️ Kwaliteit: Topmerken, ervaren vakmensen en zorgvuldige montage</li>
                <li>✔️ Flexibiliteit: Meedenken, schakelen en oplossingen bieden</li>
                <li>✔️ Duurzaamheid: Aandacht voor milieu, ecologische impact en toekomstbestendige keuzes</li>
                <li>✔️ No-nonsense: Geen loze beloften, maar gewoon doen wat we zeggen</li>
            </ul>
            <p>Wij geloven in vakmanschap, betrouwbaarheid en het leveren van een eindresultaat waar iedereen trots op is. Afspraak is afspraak; dat geldt bij ons altijd.</p>
        </div>
    </section>

    <!-- waarom kiezen klanten voor ons -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4">Waarom klanten ons kiezen</h2>
            <p>
                Onze opdrachtgevers waarderen onze no-nonsense mentaliteit, onze betrokkenheid en de kwaliteit die we leveren. Als vakkundige projectstoffering specialist bieden wij geen gladde praatjes, maar een doordacht plan, eerlijke prijzen en betrouwbare uitvoering. Door onze platte organisatiestructuur kunnen we snel schakelen en blijven we persoonlijk, ook bij grote projecten. 

                Hoort u liever het oordeel van onze klanten? Lees dan hun ervaringen op <a href="/referenties">onze referentiepagina</a>. 
            </p>
        </div>
    </section>

    <!-- call-to-action -->
    <section class="py-5 text-white" style="background-color: #333;">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Maak kennis met ons team</h2>
            <p class="mb-4">Nieuwsgierig naar wie wij zijn of wil je direct advies ontvangen? Neem contact met ons op of plan een vrijblijvende afspraak in.</p>
            <a href="/contact" class="btn btn-light px-4 py-2">Neem contact op</a>
        </div>
    </section>
</main>

<?php $this->endSection(); ?>
