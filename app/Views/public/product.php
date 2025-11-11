<?php
$this->extend('templates/public');

$this->section('page_title');
$this->endSection();

$this->section('page_description');
$this->endSection();

$this->section('content');

if($data['leverbaar'] == 1){
    $data['leverbaar'] = '["Leverbaar"]';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>


<div class="container">
    <?= session()->getFlashdata('success') ? '<div class="alert alert-success mt-3">' . session()->getFlashdata('success') . '</div>' : '' ?>
    <?= session()->getFlashdata('error') ? '<div class="alert alert-danger mt-3">' . session()->getFlashdata('error') . '</div>' : '' ?>

    <div class="btnDiv">
        <a href="#beschrijving" class="btn btn1">Beschrijving</a>
        <a href="#fotos" class="btn btn1">Foto's</a>
        <a href="#formaten" class="btn btn1">Formaten</a>
        
        <?php
        if(!empty($data['collection'])){
        ?>
            <a href="#collectie" class="btn btn1">Collectie</a>
        <?php
        }
        ?>
        
        <a href="#specificaties" class="btn btn1">Specificaties</a>
        <a href="#documenten" class="btn btn1">Documenten</a>
        <a href="#brochure" class="btn btn1">Brochure</a>
        <a href="#lees_meer" class="btn btn1">Lees meer</a>

        <a href="#" class="btn btn1 pull-right" data-bs-toggle="modal" data-bs-target="#bestelModal">Staal bestellen</a>

        <!-- Modal -->
        <div class="modal fade" id="bestelModal" tabindex="-1" aria-labelledby="bestelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bestelModalLabel">A4 Staal <br/><?= ucfirst($parents[$data['parent']]['parent']).' '.$data['name'].' <br/> Kleur: '.$data['kleur_code'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('sendStaal') ?>
                            <div class="mb-3">
                                <label for="naam" class="form-label">Naam</label>
                                <input type="text" class="form-control" name="naam" id="naam" value="<?= ((session('formName')) ? session('formName') : '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mailadres</label>
                                <input type="e-mail" class="form-control" name="email" id="email" value="<?= ((session('formMail')) ? session('formMail') : '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="tel" class="form-label">Telefoonnummer</label>
                                <input type="tel" class="form-control" name="tel" id="tel" value="<?= ((session('formTel')) ? session('formTel') : '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="adres" class="form-label">Straat + Huisnummer</label>
                                <input type="text" class="form-control" name="adres" id="adres" value="<?= ((session('formStr')) ? session('formStr') : '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="postcode" class="form-label">Postcode</label>
                                <input type="text" class="form-control" name="postcode" id="postcode" value="<?= ((session('formPost')) ? session('formPost') : '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="woonplaats" class="form-label">Woonplaats</label>
                                <input type="text" class="form-control" name="woonplaats" id="woonplaats" value="<?= ((session('formPlace')) ? session('formPlace') : '') ?>" required>
                            </div>

                            <input type="hidden" name="staal" value="<?= ucfirst($parents[$data['parent']]['parent']).' '.$data['name'].' '.$data['kleur_code'] ?>">

                            <button type="submit" class="btn btn1">Aanvragen</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="detail-area" id="beschrijving">
    <div class="container">
        <div class="detail-area-wrap d-grid">
            <div class="detail-area-left">
                <div class="detail-img-slider swiper">
                    <div class="detail-img-wrapper swiper-wrapper">
                        <div class="detail-thumb swiper-slide position-relative">
                            <div class="product-container">
                                <div class="price-tag">
                                    <span class="old-price">Adviesprijs € <?= str_replace('.', ',', $data['advies_leveren100']) ?></span>
                                    <span class="current-price">Vanaf <br/> € <?= str_replace('.', ',', $data['leveren500more']) ?> <small>per m²</small></span>
                                </div>
                                <img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data['afbeelding'])) ? $data['afbeelding'] : '/uploads/'.$data['afbeelding'] ) ?>" alt="product image" class="w-100 detail-img">
                            </div>

                            <span class="leverbaar"><?= (!empty($data['leverbaar']) ? json_decode($data['leverbaar'], true)[0] : '') ?><?= (($data['voorraad'] != 0) ? ' - Voorraad: '.$data['voorraad'].'m²' : '') ?></span>
                        </div>
                    </div>
                </div>
                <div class="slider-nav swiper">
                    <h4>Meer kleuren</h4>
                    <div class="slider-nav-wrap swiper-wrapper row">
                        <?php 
                        foreach($group as $group_item){ 
                            if(!empty($group_item['kleur_code'])){
                                ?>     
                                <div class="swiper-slide col-2 mt-3">
                                    <a href="<?= route_to('productUrl', $parents[$group_item['parent']]['url'], $parents[$group_item['parent']]['parent'], $group_item['url'], $group_item['kleur_code']) ?>">
                                        <div class="single-nav text-center circle" style="background-image: url('<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $group_item['afbeelding'])) ? $group_item['afbeelding'] : '/uploads/'.$group_item['afbeelding'] ) ?>');"></div>

                                        <?php if (isset($group_item['kleur_code']) && strlen($group_item['kleur_code']) <= 5): ?>
                                            <span class="text-dark"><?= $group_item['kleur_code'] ?></span>
                                        <?php endif; ?>
                                    </a>
                                </div>          
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="detail-area-right">
                <div class="detail-wrapper d-flex flex-column flex-md-row">
                    <div class="detail-content order-2 order-md-1">
                        <p><?= '<b>Merk: </b>'.ucfirst($parents[$data['parent']]['parent']) . ((!empty($data['label'])) ? ' - <b>Label: </b>'.$data['label'] : '') . ((!empty($data['collection'])) ? ' - <b>Collectie: </b>'.$data['collection'] : '') ?></p>
                        <h2 class="detail-title fw-bold"><?= $data['name'].' '.$data['kleur_code'] ?></h2>
                        <p><?= count($group) . ((count($group) == 1) ? ' kleur' : ' kleuren') ?> </p>
                        <!-- <div class="review d-flex align-items-center">
                            <div class="review-star d-flex align-items-center">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star-half-stroke"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <a href="#">Read 3 reviews</a>
                        </div> -->
                        

                        <div class="row">
                            <h5 class="mt-3">Belangrijke eigenschappen</h5>
                            <ul class="eigenschappenUl">
                                <?php
                                if(!empty($data['bel_eigenschap'])){
                                    foreach(json_decode($data['bel_eigenschap'], true) as $bel){
                                        echo '<li>'.$bel.'</li>';
                                    }
                                }
                                ?>
                            </ul>

                            <h5 class="mt-3">Specificatie</h5>
                            <ul class="eigenschappenUl">
                                <?php
                                $fields = [
                                    'formaat' => 'Formaat',
                                    'afmeting' => 'Afmeting',
                                    'toepassing' => 'Segment',
                                ];

                                foreach ($fields as $key => $label) {
                                    echo "<li><b>{$label}:</b><br>";

                                    // JSON-veld omzetten naar array of waarde
                                    $items = json_decode($data[$key], true);

                                    if (json_last_error() === JSON_ERROR_NONE) {
                                        // Check of het een array is of een enkele waarde
                                        if (is_array($items)) {
                                            // Voor afmetingen en segmenten in twee kolommen
                                            if (in_array($key, ['afmeting', 'toepassing'])) {
                                                echo '<table><tr>';
                                                $half = ceil(count($items) / 2); // Halveer de lijst

                                                // Eerste kolom
                                                echo '<td>';
                                                for ($i = 0; $i < $half; $i++) {
                                                    echo '- ' . htmlspecialchars($items[$i]) . '<br>';
                                                }
                                                echo '</td>';

                                                // Tweede kolom
                                                echo '<td>';
                                                for ($i = $half; $i < count($items); $i++) {
                                                    echo '- ' . htmlspecialchars($items[$i]) . '<br>';
                                                }
                                                echo '</td>';

                                                echo '</tr></table>';
                                            } else {
                                                // Gewone arrays tonen als lijst
                                                foreach ($items as $item) {
                                                    if (in_array($key, ['pool_gewicht', 'tot_gewicht'])) {
                                                        echo '- ' . intval($item) . ' g/m²<br>';
                                                    } else {
                                                        echo '- ' . htmlspecialchars($item) . '<br>';
                                                    }
                                                }
                                            }
                                        } else {
                                            // Als het geen array is, gewoon de waarde tonen
                                            if (in_array($key, ['pool_gewicht', 'tot_gewicht'])) {
                                                echo '- ' . intval($items) . ' g/m²<br>';
                                            } else {
                                                echo '- ' . htmlspecialchars($items) . '<br>';
                                            }
                                        }
                                    } else {
                                        echo 'Geen data gevonden.<br>';
                                    }

                                    echo '</li>';
                                }
                                ?>                            
                            </ul>
                        </div>

                        <h5 class="mt-3">Informatie</h5>
                        <p class="detail-desc mt-3"><?= $data['samenvatting'] ?></p>
                        <div class="price">
                            <h3 class="fw-bold mb-0">Vanaf € <?= str_replace('.', ',', $data['leveren500more']) ?> per m²</h3>
                            <h4 class="fw-bold mb-0 text-decoration-line-through"><span>Adviesprijs</span> <span class="text-decoration-line-through"> €<?= str_replace('.', ',', $data['advies_leveren100']) ?></span> </h4>
                        </div>
                        <!-- <div class="size d-flex align-items-center">
                            <h4 class="fw-bold mb-0">Size:</h4>
                            <div class="size-wrap d-flex align-items-center">
                                <div class="single-size position-relative">
                                    <input type="radio" id="xs" name="size" class="position-absolute opacity-0 invisible">
                                    <label for="xs" name="size" class="d-flex align-items-center justify-content-center rounded-circle user-select-none">XS</label>
                                </div>
                                <div class="single-size position-relative">
                                    <input type="radio" id="s" name="size" class="position-absolute opacity-0 invisible">
                                    <label for="s" name="size" class="d-flex align-items-center justify-content-center rounded-circle user-select-none">S</label>
                                </div>
                                <div class="single-size position-relative">
                                    <input type="radio" id="m" name="size" class="position-absolute opacity-0 invisible" checked>
                                    <label for="m" name="size" class="d-flex align-items-center justify-content-center rounded-circle user-select-none">M</label>
                                </div>
                                <div class="single-size position-relative">
                                    <input type="radio" id="l" name="size" class="position-absolute opacity-0 invisible">
                                    <label for="l" name="size" class="d-flex align-items-center justify-content-center rounded-circle user-select-none">L</label>
                                </div>
                                <div class="single-size position-relative">
                                    <input type="radio" id="xl" name="size" class="position-absolute opacity-0 invisible">
                                    <label for="xl" name="size" class="d-flex align-items-center justify-content-center rounded-circle user-select-none">XL</label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="detail-wrap-thumb overflow-hidden order-1 order-md-2">
                        <div class="row g-0">
                            <div class="montage-wrapper mb-2">
                                <div class="teppetekal-blk montage excel-montage mb-3">
                                    <h3 class="fw-bold text-white">Offerte exclusief montage: <br/><br/><?= ucfirst($soort).' '.ucfirst($parents[$data['parent']]['parent']).' '.$data['label'].' '.$data['name'].' '.$data['kleur_code'] ?> </h3>
                                    <div class="montage-input d-flex align-items-center">
                                        <input id="m2Excl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">
                                        <span class="text-white">M2</span>
                                    </div>
                                    <div class="montage-input d-flex align-items-center">
                                        <input id="priceExcl" type="text" placeholder="€0.00" class="text-white border border-white w-100 bg-transparent fw-light" disabled>
                                        <span class="text-white">Prijs</span>
                                    </div>
                                    <div class="montage-input d-flex align-items-center mb-0">
                                        <input title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" disabled>
                                        <span class="text-white">Total</span>
                                    </div>
                                </div>

                                <div class="teppetekal-blk montage incl-montage">
                                    <h3 class="fw-bold text-white">Offerte inclusief montage: <br/><br/><?= ucfirst($soort).' '.ucfirst($parents[$data['parent']]['parent']).' '.$data['label'].' '.$data['name'].' '.$data['kleur_code'] ?></h3>
                                    <div class="montage-input d-flex align-items-center">
                                        <input id="m2Incl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">
                                        <span class="text-white">M2</span>
                                    </div>
                                    <div class="montage-input d-flex align-items-center">
                                        <input id="priceIncl" type="text" placeholder="€0.00" class="text-white border border-white w-100 bg-transparent fw-light" disabled>
                                        <span class="text-white">Prijs</span>
                                    </div>
                                    <div class="montage-input d-flex align-items-center mb-0">
                                        <input title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" disabled>
                                        <span class="text-white">Total</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <i>* Bovengenoemde prijzen is exclusief btw.</i><br/>
                                <i>* Prijzen zijn gebaseerd op benodigde aantal m².</i>
                            </div>

                            <a href="#" class="btn btn1 col-4" data-bs-toggle="modal" data-bs-target="#offerteModal">Offerte mailen</a>

                            <div class="modal fade" id="offerteModal" tabindex="-1" aria-labelledby="offerteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="offerteModalLabel">Offerte Aanvragen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?= form_open('sendOfferte', ['method' => 'post']) ?>
                                            
                                            <div class="mb-3">
                                                <label for="naam" class="form-label">Naam</label>
                                                <input type="text" name="naam" class="form-control" value="<?= ((session('offerteName')) ? session('offerteName') : '') ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mailadres</label>
                                                <input type="email" name="email" class="form-control" value="<?= ((session('offerteMail')) ? session('offerteMail') : '') ?>" required>
                                            </div>

                                            <!-- Verborgen velden met jQuery ingevulde prijzen -->
                                            <input type="hidden" name="m2Excl" id="hiddenM2Excl">
                                            <input type="hidden" name="priceExcl" id="hiddenPriceExcl">
                                            <input type="hidden" name="totalPriceExcl" id="hiddenTotalPriceExcl">
                                            <input type="hidden" name="m2Incl" id="hiddenM2Incl">
                                            <input type="hidden" name="priceIncl" id="hiddenPriceIncl">
                                            <input type="hidden" name="totalPriceIncl" id="hiddenTotalPriceIncl">

                                            <input type="hidden" name="product" value="<?= ucfirst($parents[$data['parent']]['parent']).' '.$data['name'].' '.$data['kleur_code'] ?>">

                                            <button type="submit" class="btn btn1">Offerte Versturen</button>

                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-area sectionDiv" id="fotos">
    <div class="container">
        <div class="row">
            <h2 class="mb-3">Foto's</h2>

            <div class="gallery row">
                <?php
                foreach (['sfeerfoto1', 'sfeerfoto2', 'sfeerfoto3', 'sfeerfoto4'] as $key) {
                    if (isset($data[$key])) {
                        $filePath = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data[$key])) ? $data[$key] : '/uploads/' . $data[$key];
                        ?>
                            <div class="col-3">
                                <a href="<?= $filePath ?>" data-fancybox="gallery" data-caption="Afbeelding <?= ucfirst($key) ?>">
                                    <img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' .$data[$key])) ? $data[$key] : '/uploads/'.$data[$key] ) ?>" alt="product image" class="gallery-img w-100 detail-img">
                                </a>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>


<?php
if(!empty($data['opt_afmeting'])){
?>
<section class="product-area sectionDiv" id="formaten">
    <div class="container">
        <div class="row">
            <h2 class="mb-3">Formaten</h2>

            <?php
                $optVanaf = json_decode($data['opt_afmeting_vanaf'], true);
                $optMaten = json_decode($data['opt_afmeting'], true);

                if (!empty($optVanaf)) {
                    echo '<h4>Optioneel te bestellen vanaf '.json_decode($data['opt_afmeting_vanaf'], true)[0].'</h4>';

                    echo '<ul>';
                        foreach(json_decode($data['opt_afmeting'], true) as $row){
                            echo '<li>'.$row.'</li>';
                        }
                    echo '</ul>';
                }
            ?>
        </div>
    </div>
</section>

<?php
}

if(!empty($data['collection'])){
?>
    <section class="product-area sectionDiv" id="collectie">
        <div class="container">
            <div class="row">
                <h2 class="mb-0">Collectie <?= $data['collection'] ?></h2>
                
                <div class="col-12 col-md-8">
                    <?= $data['extracontent3'] ?>
                </div>
                
                <div class="col-12 col-md-4">
                    <img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data['collectiefoto'])) ? $data['collectiefoto'] : '/uploads/'.$data['collectiefoto'] ) ?>" alt="product image" class="w-100 detail-img">
                </div>
            </div>
        </div>
    </section>
<?php
}
?>

<section class="product-area sectionDiv" id="specificaties">
    <div class="container">
        <h2 class="mb-0">Specificaties</h2>

        <ul class="eigenschappenUl">
            <?php
            $fields = [
                'producttype' => 'Soort',
                'formaat' => 'Formaat',
                'afmeting' => 'Afmeting',
                'garantie' => 'Garantie',
                'toepassing' => 'Segment',
                'gebruik' => 'Gebruik',
                'klasse' => 'Klasse',
                'pool_gewicht' => 'Poolgewicht',
                'tot_gewicht' => 'Totaalgewicht',
                'vloerverwarming' => 'Vloerverwarming',
                'geluidiso' => 'Geluid isolatie',
                'slipweerstand' => 'Slipweerstand',
                'dikte_toplaag' => 'Dikte toplaag',
                'soort_toplaag' => 'Soort toplaag',
                'tot_dikte' => 'Totale dikte',
                'type_geen' => 'Heteregeen / Homogeen',
                'weerstand' => 'Weerstand',
                'textuur' => 'Textuur',
                'dessins' => 'Stijl'
            ];

            foreach ($fields as $key => $label) {
                // Check of het veld bestaat en niet leeg is
                if (!isset($data[$key]) || $data[$key] === '' || $data[$key] === null) {
                    continue; // Sla dit veld over
                }

                // JSON-veld omzetten naar array of waarde
                $items = json_decode($data[$key], true);

                // Als JSON decode mislukt, gebruik de ruwe waarde
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $items = $data[$key];
                }

                // Check of de waarde 0 of leeg is
                if ($items === 0 || $items === '0' || $items === '0.00' || $items === 0.00 || $items === '' || $items === null) {
                    continue; // Sla dit veld over
                }

                // Voor arrays: check of er daadwerkelijk waarden in zitten
                if (is_array($items) && (empty($items) || (count($items) === 1 && ($items[0] === '' || $items[0] === null || $items[0] === 0)))) {
                    continue; // Sla lege arrays over
                }

                // Toon het veld
                echo "<li><b>{$label}:</b><br>";

                if (is_array($items)) {
                    // Voor afmetingen en segmenten in twee kolommen
                    if (in_array($key, ['afmeting', 'toepassing'])) {
                        echo '<table><tr>';
                        $half = ceil(count($items) / 2);

                        // Eerste kolom
                        echo '<td>';
                        for ($i = 0; $i < $half; $i++) {
                            if ($items[$i] !== '' && $items[$i] !== null) {
                                echo '- ' . htmlspecialchars($items[$i]) . '<br>';
                            }
                        }
                        echo '</td>';

                        // Tweede kolom
                        echo '<td>';
                        for ($i = $half; $i < count($items); $i++) {
                            if ($items[$i] !== '' && $items[$i] !== null) {
                                echo '- ' . htmlspecialchars($items[$i]) . '<br>';
                            }
                        }
                        echo '</td>';

                        echo '</tr></table>';
                    } else {
                        // Gewone arrays tonen als lijst
                        foreach ($items as $item) {
                            if ($item !== '' && $item !== null && $item !== 0) {
                                if (in_array($key, ['pool_gewicht', 'tot_gewicht'])) {
                                    echo '- ' . intval($item) . ' g/m²<br>';
                                } else {
                                    echo '- ' . htmlspecialchars($item) . '<br>';
                                }
                            }
                        }
                    }
                } else {
                    // Als het geen array is, gewoon de waarde tonen
                    if (in_array($key, ['pool_gewicht', 'tot_gewicht'])) {
                        echo '- ' . intval($items) . ' g/m²<br>';
                    } else if (in_array($key, ['garantie'])) {
                        echo '- ' . intval($items) . ' jaar<br>';
                    } else {
                        echo '- ' . htmlspecialchars($items) . '<br>';
                    }
                }

                echo '</li>';
            }
            ?>                            
        </ul>        
    </div>
</section>



<section class="product-area sectionDiv" id="documenten">
    <div class="container">
        <div class="row">
            <h2 class="mb-3">Documenten</h2>

            <div class="row">
                <div class="documentatie-container">
                    <div class="documentatie-grid">
                        <?php
                        $documenten = [
                            'Technische specificatie',
                            'Installatie',
                            'Brochure',
                            'Onderhoud',
                            'Environmental (milieuverklaring - epd)',
                            'Prestatieverklaring (DOP)',
                            'MHS',
                            'Recycling',
                            'LRW (lichtreflectiewaarde lrv)',
                            'CO2 voetafdruk'
                        ];

                        foreach ($documenten as $index => $titel) {
                            $docKey = 'document' . ($index + 1); // Dynamisch document sleutels
                            if (!empty($data[$docKey])) { // Alleen weergeven als het document bestaat
                                $filePath = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data[$docKey])
                                    ? $data[$docKey]
                                    : '/uploads/' . $data[$docKey];
                                ?>
                                <div class="document-item">
                                    <a href="<?= $filePath ?>" target="_blank">
                                        <div class="document-icon">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </div>
                                        <div class="document-title"><?= $titel ?></div>
                                        <div class="document-format">PDF</div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-area sectionDiv" id="brochure">
    <div class="container">
        <h2 class="mb-0">Brochure</h2>
        <?php
        $documenten = [
            'Brochure'
        ];

        foreach ($documenten as $index => $titel) {
            $docKey = 'document3'; // Dynamisch document sleutels
            if (!empty($data[$docKey])) { // Alleen weergeven als het document bestaat
                $filePath = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data[$docKey])
                    ? $data[$docKey]
                    : '/uploads/' . $data[$docKey];
                ?>
                <div class="document-item">
                    <a href="<?= $filePath ?>" target="_blank">
                        <div class="document-icon">
                            <i class="fas fa-arrow-circle-down"></i>
                        </div>
                        <div class="document-title"><?= $titel ?></div>
                        <div class="document-format">PDF</div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>

<section class="product-area sectionDiv" id="lees_meer">
    <div class="container">
        <div class="product-area-title section-title position-relative d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Dit vind je misschien ook leuk:</h2>
        </div>
        <div class="product-tab-content tab-content" id="product-tabContent">
            <div class="tab-pane fade show active" id="best-sellers" role="tabpanel" aria-labelledby="best-sellers-tab" tabindex="0">
                <div class="product-slider">
                    <div class="product-slider-wrap owl-carousel">
                        <?php
                        if(!empty($gerelateerd1)){
                            ?>
                            <div class="product-slide text-center">
                                <a href="<?= route_to('productUrl', $parents[$gerelateerd1['parent']]['url'], $parents[$gerelateerd1['parent']]['parent'], $gerelateerd1['url'], $gerelateerd1['kleur_code']) ?>"><img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gerelateerd1['afbeelding'])) ? $gerelateerd1['afbeelding'] : '/uploads/'.$gerelateerd1['afbeelding'] ) ?>" alt="product image" class="w-100"></a>
                                <h4 class="fw-normal"><?= $gerelateerd1['name'] ?></h4>
                                <p class="mb-0">€ <?= $gerelateerd1['leveren500more'] ?> <span class="text-decoration-line-through">€ <?= $gerelateerd1['leveren100'] ?></span></p>
                            </div>

                            <?php
                        }
                        ?>
                        
                        <?php
                        if(!empty($gerelateerd2)){
                            ?>
                            <div class="product-slide text-center">
                            <a href="<?= route_to('productUrl', $parents[$gerelateerd2['parent']]['url'], $parents[$gerelateerd2['parent']]['parent'], $gerelateerd2['url'], $gerelateerd2['kleur_code']) ?>"><img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gerelateerd2['afbeelding'])) ? $gerelateerd2['afbeelding'] : '/uploads/'.$gerelateerd2['afbeelding'] ) ?>" alt="product image" class="w-100"></a>
                                <h4 class="fw-normal"><?= $gerelateerd2['name'] ?></h4>
                                <p class="mb-0">€ <?= $gerelateerd2['leveren500more'] ?> <span class="text-decoration-line-through">€ <?= $gerelateerd2['leveren100'] ?></span></p>
                            </div>

                            <?php
                        }
                        ?>

                        
                        <?php
                        if(!empty($gerelateerd3)){
                            ?>
                            <div class="product-slide text-center">
                            <a href="<?= route_to('productUrl', $parents[$gerelateerd3['parent']]['url'], $parents[$gerelateerd3['parent']]['parent'], $gerelateerd3['url'], $gerelateerd3['kleur_code']) ?>"><img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gerelateerd3['afbeelding'])) ? $gerelateerd3['afbeelding'] : '/uploads/'.$gerelateerd3['afbeelding'] ) ?>" alt="product image" class="w-100"></a>
                                <h4 class="fw-normal"><?= $gerelateerd3['name'] ?></h4>
                                <p class="mb-0">€ <?= $gerelateerd3['leveren500more'] ?> <span class="text-decoration-line-through">€ <?= $gerelateerd3['leveren100'] ?></span></p>
                            </div>

                            <?php
                        }
                        ?>

                        
                        <?php
                        if(!empty($gerelateerd4)){
                            ?>
                            <div class="product-slide text-center">
                            <a href="<?= route_to('productUrl', $parents[$gerelateerd4['parent']]['url'], $parents[$gerelateerd4['parent']]['parent'], $gerelateerd4['url'], $gerelateerd4['kleur_code']) ?>"><img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gerelateerd4['afbeelding'])) ? $gerelateerd4['afbeelding'] : '/uploads/'.$gerelateerd4['afbeelding'] ) ?>" alt="product image" class="w-100"></a>
                                <h4 class="fw-normal"><?= $gerelateerd4['name'] ?></h4>
                                <p class="mb-0">€ <?= $gerelateerd4['leveren500more'] ?> <span class="text-decoration-line-through">€ <?= $gerelateerd4['leveren100'] ?></span></p>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="newsell" role="tabpanel" aria-labelledby="newsell-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrivals-tab" tabindex="0">...</div>
        </div>
    </div>
</section>
<!-- product area end -->

<?php
$this->endSection();

$this->section('extraJs');
?>


<script type="text/javascript">
    $(document).ready(function () {
        const offerteId = "<?= $data['id']; ?>"; // ID ophalen vanuit PHP

        // Functie om prijzen op te halen via AJAX en correct te formatteren
        function fetchPrice(m2Value) {
            if (!m2Value || isNaN(m2Value)) {
                $('#priceExcl, #priceIncl').val('€0,00 exclusief 21% BTW');
                $('.montage-input input[title="total"]').val('€0,00 exclusief 21% BTW');

                // Verborgen velden in de offerte-modal resetten
                $('#hiddenM2Excl, #hiddenM2Incl').val('');
                $('#hiddenPriceExcl, #hiddenPriceIncl').val('');
                return;
            }

            $.ajax({
                url: '<?= route_to('getOffertePrice') ?>', // Backend route
                method: 'POST',
                data: {
                    id: offerteId,
                    m2: m2Value
                },
                success: function (response) {
                    if (response.pricePerM2 && response.totalExcl && response.totalIncl) {
                        // Formatteer prijzen correct: punt voor duizendtallen en komma voor decimalen
                        const formatPrice = (price) => {
                            return new Intl.NumberFormat('nl-NL', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(price);
                        };

                        // Prijzen correct tonen in de UI
                        $('#priceExcl').val(`€${formatPrice(response.pricePerM2.excl)} exclusief montage`);
                        $('#priceIncl').val(`€${formatPrice(response.pricePerM2.incl)} inclusief montage`);

                        $('#m2Excl').closest('.teppetekal-blk').find('input[title="total"]').val(`€${formatPrice(response.totalExcl)} exclusief 21% BTW`);
                        $('#m2Incl').closest('.teppetekal-blk').find('input[title="total"]').val(`€${formatPrice(response.totalIncl)} exclusief 21% BTW`);

                        // Verborgen velden correct opslaan voor offerte-mailing
                        $('#hiddenM2Excl').val(m2Value);
                        $('#hiddenPriceExcl').val(response.totalExcl); // Ongestructureerd versturen, zodat server correct formatteert
                        $('#hiddenM2Incl').val(m2Value);
                        $('#hiddenPriceIncl').val(response.totalIncl);
                    } else {
                        alert('Onverwachte gegevens ontvangen. Controleer de server.');
                    }
                },
                error: function () {
                    alert('Er is een fout opgetreden bij het ophalen van prijzen. Probeer opnieuw.');
                }
            });
        }

        // Event listener op beide invoervelden voor synchronisatie en prijsberekening
        $('.sync-input').on('input', function () {
            const m2Value = $(this).val().replace(/\./g, '').replace(',', '.'); // Voorkomt dat 1.000 verkeerd wordt gelezen
            if (!isNaN(m2Value) && m2Value.trim() !== '') {
                $('#m2Excl, #m2Incl').val(m2Value);
                fetchPrice(m2Value);
            }
        });

        $("[data-bs-target='#offerteModal']").on("click", function () {
            $('#hiddenM2Excl').val($('#m2Excl').val());
            $('#hiddenPriceExcl').val($('#priceExcl').val());
            $('#hiddenTotalPriceExcl').val($('#m2Excl').closest('.teppetekal-blk').find('input[title="total"]').val());
            $('#hiddenM2Incl').val($('#m2Incl').val());
            $('#hiddenPriceIncl').val($('#priceIncl').val());
            $('#hiddenTotalPriceIncl').val($('#m2Incl').closest('.teppetekal-blk').find('input[title="total"]').val());
        });
    });
</script>

<?php
$this->endSection();
?>