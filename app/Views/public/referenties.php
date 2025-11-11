<?php
$this->extend('templates/public');

$this->section('page_title');
echo 'Referenties';
$this->endSection();

$this->section('page_description');
echo 'Bekijk onze uitgevoerde projecten en tevreden klanten.';
$this->endSection();

$this->section('content');
?>

<main class="vloer-bh-jaar-1">
    <!-- hero -->
    <section class="hero-area vloer-hero">
        <div class="container">
            <div class="hero-wrapper d-grid justify-content-between align-items-center">
                <div class="hero-content order-2 order-lg-1">
                    <h1 class="fw-bold">Onze Referenties</h1>
                    <p class="mb-0">Bekijk een greep uit onze succesvolle projecten en ervaringen van tevreden klanten.</p>
                </div>
                <div class="hero-thumb position-relative overflow-hidden order-1 order-lg-2">
                    <img src="https://tapijtwebsite.nl/uploads/cobbles_690,_meadow_683_0.jpg.webp" class="w-100" alt="Referentie hero">
                    <h3 class="mb-0 fw-bold text-white position-absolute start-50 translate-middle-x bottom-0 z-1 w-75 text-center rounded-0">Afgeronde projecten in beeld</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- referenties -->
    <section class="product-area py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Projecten & Klantverhalen</h2>
                <p class="text-muted">Een selectie van recente projecten die wij met zorg hebben uitgevoerd.</p>
            </div>

            <div class="row g-4 referenties">
                <div class="col-12">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <a href="/referenties/willem-van-oranje">
                                <img src="/webAssets/img/ref1.jpg" alt="CSG Willem van Oranje - Oud-Beijerland" class="img-fluid rounded">
                                <h6 class="mt-2">CSG Willem van Oranje - Oud-Beijerland</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/zeeuwse-parel">
                                <img src="/webAssets/img/referentie2.jpg" alt="Vakantiepark De Zeeuwse Parel - Scherpenisse" class="img-fluid rounded">
                                <h6 class="mt-2">Vakantiepark De Zeeuwse Parel - Scherpenisse</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/bouwbedrijf-vrolijk">
                                <img src="/webAssets/img/referentie3_1.jpg" alt="Hoofdkantoor Bouwbedrijf Vrolijk - Breda" class="img-fluid rounded">
                                <h6 class="mt-2">Hoofdkantoor Bouwbedrijf Vrolijk - Breda</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/paradigma-groep">
                                <img src="/webAssets/img/referentie4.jpg" alt="Regiokantoren Paradigma Groep" class="img-fluid rounded">
                                <h6 class="mt-2">Regiokantoren Paradigma Groep</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/stichting-archipel-scholen">
                                <img src="/webAssets/img/referentie5.jpg" alt="Stichting Archipel Scholen - Vlissingen" class="img-fluid rounded">
                                <h6 class="mt-2">Stichting Archipel Scholen - Vlissingen</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/contempera-interiour-meets-art">
                                <img src="/webAssets/img/referentie6.jpg" alt="Contempera Interiour Meets Art - Amsterdam" class="img-fluid rounded">
                                <h6 class="mt-2">Contempera Interiour Meets Art - Amsterdam</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/flowserve">
                                <img src="/webAssets/img/referentie7.jpg" alt="Flowserve - Etten-Leur" class="img-fluid rounded">
                                <h6 class="mt-2">Flowserve - Etten-Leur</h6>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/referenties/willem-van-oranje-2">
                                <img src="/webAssets/img/referentie8.jpg" alt="Entreehal en Aula CSG Willem van Oranje - Oud-Beijerland" class="img-fluid rounded">
                                <h6 class="mt-2">Entreehal en Aula CSG Willem van Oranje - Oud-Beijerland</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->endSection(); ?>