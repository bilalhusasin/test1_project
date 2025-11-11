<?php
$this->extend('templates/public');

$this->section('page_title');
$this->endSection();

$this->section('page_description');
$this->endSection();

$this->section('content');
?>

<main class="vloer-bh-jaar-1">
    <!-- hero area start -->
    <section class="hero-area vloer-hero">
        <div class="container">
            <div class="hero-wrapper d-grid justify-content-between align-items-center">
                <div class="hero-content order-2 order-lg-2">
                    <h1 class="fw-bold"><?= $bannerTitle ?></h1>
                    <p class="mb-0"><?= $bannerText ?></p>
                </div>
                <div class="hero-thumb position-relative overflow-hidden order-1 order-lg-1">
                    <img src="<?= $bannerImg ?>" alt="hero thumb" class="w-100">
                    <!-- <h3 class="mb-0 fw-bold text-white position-absolute start-50 translate-middle-x bottom-0 z-1 w-75 text-center rounded-0"><?= $bannerTitle ?></h3> -->
                </div>
            </div>
        </div>
    </section>
    <!-- hero area end -->

    <!-- product area start -->
    <section class="product-area">
        <div class="container">
            <!-- <div class="product-area-title section-title position-relative d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Featured Products</h2>
            </div> -->
            <div class="product-tab-content tab-content" id="product-tabContent">
                <!-- <div class="tab-pane fade show active" id="best-sellers" role="tabpanel" aria-labelledby="best-sellers-tab" tabindex="0">
                    <div class="product-slider">
                        <div class="product-slider-wrap owl-carousel">
                            <?php
                            foreach($products as $product){
                                echo '
                                    <div class="product-slide product-slide-2">
                                        <h4 class="fw-normal text-center mt-0">'.$product['name']. ' - ' . $product['kleur_code'] .'</h4>
                                        <img src="'. ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $product['afbeelding'])) ? $product['afbeelding'] : '/uploads/'.$product['afbeelding'] ).'" alt="product image" class="w-100">
                                        <div class="product-desc">
                                            <div class="product-desc-top">
                                                <h5 class="fw-normal">'.$product['voorraad'].' m² op voorraad</h5>
                                            </div>
                                            <div class="product-desc-bottom d-flex align-items-end">
                                                <span class="flex-shrink-0">€ '.str_replace('.', ',', $product['leveren500']).' <br> per m2</span>
                                                <div class="w-100 text-center">
                                                    <a href="#" class="d-block text-center bg-black text-white aanbiedingBtn" data-id="'.$product['id'].'">Bekijken</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="newsell" role="tabpanel" aria-labelledby="newsell-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrivals-tab" tabindex="0">...</div> -->

                <?php
                foreach($products as $product){
                    echo '
                        <h2 class="teppetekal-area-title text-center fw-bold mt-5">'.$product['name'].'</h2>
                        <div class="tappetekal-wrapper montage-wrapper mb-5">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="teppetekal-blk woodstone position-relative h-100 p-0">
                                        <img src="'.((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $product['afbeelding'])) ? $product['afbeelding'] : '/uploads/'.$product['afbeelding'] ).'" alt="woodstone thumb" class="w-100">
                                        <h3 class="mb-0 fw-bold text-white text-center w-100 position-absolute bottom-0 start-0 z-1">'.(($bannerTitle == 'Top 10') ? '' : $product['voorraad'].'m² op voorraad '.((!empty($product['stuks_pak'])) ? '<br/>'.$product['stuks_pak'].' stuks leverbaar' : '')).'</h3>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="teppetekal-blk trodon-line d-flex flex-column justify-content-center h-100">
                                        <div class="aanbieding_extra">
                                            <h3 class="fw-bold">'.$product['label'].'</h3>
                                            <h5 class="fw-bold">'.$product['collection'].'</h5>
                                        </div>
                                        
                                        <div class=" d-flex flex-column justify-content-end h-100">
                                            <h4 class="fw-bold">€ '.$product['leveren500'].' per m²</h4>
                                            <p class="mb-5 prijsTegel">'.((!empty($product['stuks_prijs']) && $product['stuks_prijs'] != 0) ? '€ '.$product['stuks_prijs'].' per tegel' : '').'</p>

                                            <a href="#" class="btn btn1 mt-5">Staal aanvragen</a> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="teppetekal-blk montage h-100 d-flex flex-column">
                                        <h3 class="fw-bold text-white">'.$product['label'].'</h3>
                                        <h3 class="fw-bold text-white">'.$product['name'].'</h3>
                                        <h3 class="fw-bold text-white">Offerte excl montage</h3>
                                        <div class="montage-input d-flex align-items-center">
                                            <input id="m2Excl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">
                                            <span class="text-white">M2</span>
                                        </div>
                                        <div class="montage-input d-flex align-items-center">
                                            <input id="priceExcl" type="text" placeholder="€'.$product['leveren500'].'" class="text-white border border-white w-100 bg-transparent fw-light" readonly>
                                            <span class="text-white">Prijs</span>
                                        </div>
                                        <div class="montage-input d-flex align-items-center mb-0">
                                            <input id="totalExcl" title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" readonly>
                                            <span class="text-white">Totaal</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="teppetekal-blk montage incl-montage h-100 d-flex flex-column w-100 gray-bg">
                                        <h3 class="fw-bold text-white">'.$product['label'].'</h3>
                                        <h3 class="fw-bold text-white">'.$product['name'].'</h3>
                                        <h3 class="fw-bold text-white">Offerte incl montage</h3>
                                        <div class="montage-input d-flex align-items-center">
                                            <input id="m2Incl" type="text" placeholder="Vul hier het aantal m2 in" class="sync-input text-white border border-white w-100 bg-transparent fw-light">
                                            <span class="text-white">M2</span>
                                        </div>
                                        <div class="montage-input d-flex align-items-center">
                                            <input id="priceIncl" type="text" placeholder="€'.$product['aanbrengen500'].'" class="text-white border border-white w-100 bg-transparent fw-light" readonly>
                                            <span class="text-white">Prijs</span>
                                        </div>
                                        <div class="montage-input d-flex align-items-center mb-0">
                                            <input id="totalIncl" title="total" type="text" class="text-white border border-white w-100 bg-transparent fw-light" readonly>
                                            <span class="text-white">Totaal</span>
                                        </div>
                                    </div>
                                </div>   

                                <div class="offset-6 col-6">
                                    <i>* Bovengenoemde prijzen is exclusief btw.</i><br/>
                                    <i>* Prijzen zijn gebaseerd op benodigde aantal m².</i>

                                    <a href="#" class="btn btn1 col-4 pull-right offerteBtn" data-bs-toggle="modal" data-bs-target="#offerteModal">Offerte mailen</a>                            
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="modal fade" id="offerteModal" tabindex="-1" aria-labelledby="offerteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="offerteModalLabel">Offerte Aanvragen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="'.route_to('sendOfferte').'" method="POST">

                                            <div class="mb-3">
                                                <label for="naam" class="form-label">Naam</label>
                                                <input type="text" name="naam" class="form-control" value="'.(session('offerteName') ?? '').'" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mailadres</label>
                                                <input type="email" name="email" class="form-control" value="'.(session('offerteMail') ?? '').'" required>
                                            </div>

                                            <!-- Verborgen velden met jQuery ingevulde prijzen -->
                                            <input type="hidden" name="m2Excl" id="hiddenM2Excl">
                                            <input type="hidden" name="priceExcl" id="hiddenPriceExcl">
                                            <input type="hidden" name="totalPriceExcl" id="hiddenTotalPriceExcl">
                                            <input type="hidden" name="m2Incl" id="hiddenM2Incl">
                                            <input type="hidden" name="priceIncl" id="hiddenPriceIncl">
                                            <input type="hidden" name="totalPriceIncl" id="hiddenTotalPriceIncl">

                                            <input type="hidden" name="product" value="'.htmlspecialchars($product['name'].' '.$product['kleur_code']).'">

                                            <button type="submit" class="btn btn1">Offerte Versturen</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- tappetekal area start -->
    <section class="tappetekal-area overflow-hidden pb-0">
        <div class="container">
            <div id="product-container"></div>
        </div>
    </section>
    <!-- tappetekal area end -->
</main>

<?php
$this->endSection();

$this->section('extraJs');
?>


<script type="text/javascript">
$(document).ready(function() {
    $("#product-container").hide();

    let currentProductId = null;

    $(document).on('click', '.aanbiedingBtn', function(e) {
        e.preventDefault();

        currentProductId = $(this).data('id');

        $.ajax({
            url: '<?= route_to('getProduct') ?>',
            type: 'POST',
            data: { id: currentProductId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $("#product-container").html(response.product_html).fadeIn();
                    $('html, body').animate({
                        scrollTop: $("#product-container").offset().top - 100
                    }, 800);
                } else {
                    console.error('Fout bij ophalen product: ', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax fout: ', error);
            }
        });
    });

    $(document).on('input', '.sync-input', function () {
        const m2Value = $(this).val().replace(/\./g, '').replace(',', '.');

        if (!isNaN(m2Value) && m2Value.trim() !== '') {
            $('#m2Excl, #m2Incl').val(m2Value);
            fetchPrice(m2Value);
        }
    });

    function fetchPrice(m2Value) {
        if (!currentProductId) {
            console.error("Geen product ID bekend");
            return;
        }

        $.ajax({
            url: '<?= route_to('getOffertePrice') ?>',
            method: 'POST',
            data: {
                id: currentProductId,
                m2: m2Value
            },
            success: function (response) {
                if (response.pricePerM2 && response.totalExcl && response.totalIncl) {
                    const formatPrice = (price) => {
                        return new Intl.NumberFormat('nl-NL', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(price);
                    };

                    $('#priceExcl').val(`€${formatPrice(response.pricePerM2.excl)} exclusief montage`);
                    $('#priceIncl').val(`€${formatPrice(response.pricePerM2.incl)} inclusief montage`);
                    $('#totalExcl').val(`€${formatPrice(response.totalExcl)} exclusief 21% BTW`);
                    $('#totalIncl').val(`€${formatPrice(response.totalIncl)} exclusief 21% BTW`);

                    $('#hiddenM2Excl').val(m2Value);
                    $('#hiddenPriceExcl').val(response.totalExcl);
                    $('#hiddenM2Incl').val(m2Value);
                    $('#hiddenPriceIncl').val(response.totalIncl);
                } else {
                    alert('Onverwachte gegevens ontvangen. Controleer de server.');
                }
            },
            error: function () {
                alert('Fout bij prijs ophalen. Probeer opnieuw.');
            }
        });
    }

});
</script>

<?php
$this->endSection();
?>