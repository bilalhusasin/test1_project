<?php
$this->extend('templates/public');

$this->section('page_title');
$this->endSection();

$this->section('page_description');
$this->endSection();

$this->section('content');

use App\Models\ProductsModel;

$modelProducts = new ProductsModel();
?>

<div class="container">
    <div class="main-wrapper d-flex flex-column flex-lg-row">        
        <div class="main-content">
            <h1 class="mb-0 fw-bold">Zoekopdracht: <?= $search ?></h1>

            <!-- product area start -->
            <div class="row">
                <?php 
                if(empty($results)){

                }else{
                    foreach($results as $prodArray) {
                        ?>

                        <section class="product-area essunce-area col-4">
                            <div class="product-area-title section-title section-title-2 position-relative">
                                <h2 class="mb-0"><?= $prodArray[0]['name'] ?></h2>
                            </div>
                            
                            <div class="product-slider essunce-slider">
                                <div class="essunce-slider-wrap owl-carousel">
                                    <?php
                                    $counter = 0;
                                    foreach ($prodArray as $prod) {
                                        if ($prod['kleur_code'] != '' && $prod['url'] != '' && $prod['merk'] != '' && $prod['parent'] != '') {
                                            if ($counter === 0) {
                                                // Eerste product met driehoekje en rondjes in het kader
                                                ?>
                                                <div class="product-slide text-center">
                                                    <div class="product-container">
                                                        <div class="price-tag">
                                                            <span class="old-price">Adviesprijs € <?= str_replace('.', ',', $prod['advies_leveren100']) ?></span>
                                                            <span class="current-price">Vanaf <br/> € <?= str_replace('.', ',', $prod['leveren500more']) ?> <small>per m²</small></span>
                                                        </div>

                                                        <a href="<?= route_to('productUrl', $prod['parent'], $prod['merk'], $prod['url'], $prod['kleur_code']) ?>">
                                                            <img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $prod['afbeelding'])) ? $prod['afbeelding'] : '/uploads/'.$prod['afbeelding'] ) ?>" alt="product image" class="w-100 detail-img">
                                                        </a>
                                                        
                                                        <div class="circle-container">
                                                            <?php
                                                            foreach ($prodArray as $color) {
                                                                if(!empty($color['kleur_code'])){
                                                                ?>
                                                                    <a href="<?= route_to('productUrl', $prod['parent'], $prod['merk'], $color['url'], $color['kleur_code']) ?>">
                                                                        <div class="single-nav circle" style="background-image: url('<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $color['afbeelding'])) ? $color['afbeelding'] : '/uploads/'.$color['afbeelding'] ) ?>');"></div>
                                                                    </a>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $counter++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- product area end -->

            <!-- tarkett area start -->
            <!-- <section class="tarkett-area">
                <div class="row g-0">
                    <div class="col-xl-6">
                        <div class="tarkett-slider essunce-slider">
                            <div class="tarkett-slider-title section-title section-title-2 position-relative">
                                <h2 class="mb-0">Tarkett Desso Essence</h2>
                            </div>
                            <div class="tarkett-slider-wrap owl-carousel">
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-1.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Floor toppers</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-2.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Tabittegelstunt</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-3.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Gratis Gelevered</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-4.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Abvious op Lotakis</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-3.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Plan van eanpak</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-1.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Projekten</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="tarkett-slider tarkett-slider-2 essunce-slider">
                            <div class="tarkett-slider-title section-title section-title-2 position-relative">
                                <h2 class="mb-0">Tarkett ID inspiration - AUTHENTICS - 20X120CM</h2>
                            </div>
                            <div class="tarkett-slider-wrap owl-carousel">
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-1.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Floor toppers</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-2.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Tabittegelstunt</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-3.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Gratis Gelevered</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-4.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Abvious op Lotakis</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-3.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Plan van eanpak</h4>
                                </div>
                                <div class="product-slide text-center">
                                    <img src="/webAssets/img/product/product-img-1.png" alt="product image" class="w-100">
                                    <h4 class="fw-normal">Projekten</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- tarkett area end -->

            <!-- pagination start -->
            <!-- <div class="pagination-area">
                <ul class="pagination justify-content-center">
                    <li class="page-item active">
                        <a class="page-link d-flex align-items-center justify-content-center p-0 rounded-circle fw-medium" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link d-flex align-items-center justify-content-center p-0 rounded-circle fw-medium" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link d-flex align-items-center justify-content-center p-0 rounded-circle fw-medium" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link d-flex align-items-center justify-content-center p-0 border-0 fw-medium">.....</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link d-flex align-items-center justify-content-center p-0 rounded-circle fw-medium" href="#">10</a>
                    </li>
                </ul>
            </div> -->
            <!-- pagination end -->
        </div>
    </div>
</div>

<?php
$this->endSection();
?>