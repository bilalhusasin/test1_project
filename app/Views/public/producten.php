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
        <button type="button" class="sidebar-toggle border-0 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar-offcanvas" aria-controls="sidebar-offcanvas">Show Filter</button>
        <div class="sidebar d-none d-lg-block flex-shrink-0">
            <div class="sidebar-wrapper d-flex flex-column">
                <div class="sidebar-blk">
                    <div class="sidebar-top d-flex align-items-center">
                        <button title="bars" type="button" class="bar-icon bg-transparent border-0"><i class="fa-light fa-bars"></i></button>
                        <span class="text-white fw-medium text-uppercase">Assortiment</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <?php
                        foreach ($menu as $url => $item) {
                            echo '
                                <a href="'.$url.'" class="menu-link d-inline-block">
                                    <span>'.$item['name'].'</span>
                                </a>
                            ';
                        }
                        ?>
                    </div>
                </div>
                <div class="sidebar-blk brand-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">Soorten</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <?php 
                        foreach($soorten as $soort){
                        ?>
                            <div class="brand-name filter-input">
                                <label class="position-relative user-select-none">
                                    <?= $soort['name'] ?>
                                    <input type="checkbox" class="position-absolute opacity-0 invisible">
                                    <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="sidebar-blk price-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">PRICE</span>
                    </div>
                    <div class="sidebar-menu position-relative">
                        <div class="price-input">
                            <div class="field position-relative">
                                <input title="min price" type="number" class="input-min" value="0">
                                <span class="currency-sign position-absolute top-50 translate-middle-y">$</span>
                            </div>
                            <div class="separator">TO</div>
                            <div class="field position-relative">
                                <input title="max-price" type="number" class="input-max" value="100">
                                <span class="currency-sign position-absolute top-50 translate-middle-y">$</span>
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="1000" value="0" step="10">
                            <input type="range" class="range-max" min="0" max="1000" value="100" step="10">
                        </div>
                    </div>
                </div>
                <div class="sidebar-blk color-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">COLORS</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Beige
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Brown
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Orange
                                <input type="checkbox" class="position-absolute opacity-0 invisible" checked>
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Red
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <h1 class="mb-0 fw-bold"><?= $merk['name'] ?></h1>
            <!-- hero area start -->
            <!-- <section class="hero-area overview-hero p-0">
                <div class="hero-wrapper">
                    <div class="hero-thumb position-relative">
                        <img src="/webAssets/img/overview-hero-thumb.jpg" alt="hero thumb" class="w-100">
                        <h3 class="mb-0 fw-bold text-white position-absolute start-50 top-50 translate-middle z-1 w-50 rounded-0 text-center"><?= $merk['name'] ?></h3>
                    </div>
                </div>
            </section> -->
            <!-- hero area end -->

            <!-- product area start -->
            <div class="row">
                <?php 
                foreach($prods as $prodArray) {
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
                                    if ($prod['kleur_code'] != '' && $prod['url'] != '' && isset($parents[$prod['parent']]['url']) && isset($parents[$prod['parent']]['parent'])) {
                                        if ($counter === 0) {
                                            // Eerste product met driehoekje en rondjes in het kader
                                            ?>
                                            <div class="product-slide text-center">
                                                <div class="product-container">
                                                    <div class="price-tag">
                                                        <span class="old-price">Adviesprijs € <?= str_replace('.', ',', $prod['advies_leveren100']) ?></span>
                                                        <span class="current-price">Vanaf <br/> € <?= str_replace('.', ',', $prod['leveren500more']) ?> <small>per m²</small></span>
                                                    </div>
                                                    <a href="<?= route_to('productUrl', $parents[$prod['parent']]['url'], $parents[$prod['parent']]['parent'], $prod['url'], $prod['kleur_code']) ?>">
                                                        <img src="<?= ((file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $prod['afbeelding'])) ? $prod['afbeelding'] : '/uploads/'.$prod['afbeelding'] ) ?>" alt="product image" class="w-100 detail-img">
                                                    </a>
                                                    <div class="circle-container">
                                                        <?php
                                                        foreach ($prodArray as $color) {
                                                            if(!empty($color['kleur_code']) && isset($parents[$color['parent']]['url']) && isset($parents[$color['parent']]['parent']) && !empty($color['url'])){
                                                                ?>
                                                                <a href="<?= route_to('productUrl', $parents[$color['parent']]['url'], $parents[$color['parent']]['parent'], $color['url'], $color['kleur_code']) ?>">
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
                ?>
            </div>

            <?php if ($pager !== null): ?>
                <?= $pager ?>
            <?php endif; ?>

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

            <!-- article start -->
            <div class="article">
                <div class="article-title section-title position-relative">
                    <h2 class="mb-0 fw-bold"></h2>
                </div>
                <div class="article-desc text-center">
                    <p class="mb-0"><?= $merk['omschrijving'] ?></p>
                </div>
            </div>
            <!-- article end -->
        </div>
    </div>
</div>

<!-- sidebar sm start -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar-offcanvas" aria-labelledby="sidebar-offcanvasLabel">
    <div class="offcanvas-header justify-content-end">
        <button type="button" title="sidebar close" class="close-icon menu-bar border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="sidebar-sm sidebar w-100">
            <div class="sidebar-wrapper d-flex flex-column">
                <div class="sidebar-blk">
                    <div class="sidebar-top d-flex align-items-center">
                        <button title="bars" type="button" class="bar-icon bg-transparent border-0"><i class="fa-light fa-bars"></i></button>
                        <span class="text-white fw-medium text-uppercase">Assortment</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <a href="#" class="menu-link d-inline-block">
                            <span>Camera</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Sunglasses</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Laptop</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Smartphone</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Computer</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>TV & Audio</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Headphone</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Smart watch</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Fashion</span>
                        </a>
                        <a href="#" class="menu-link d-inline-block">
                            <span>Sale and Offers</span>
                        </a>
                    </div>
                </div>
                <div class="sidebar-blk brand-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">brands</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <div class="brand-name filter-input">
                            <label class="position-relative user-select-none">
                                Desso
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="brand-name filter-input">
                            <label class="position-relative user-select-none">
                                Interface
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="brand-name filter-input">
                            <label class="position-relative user-select-none">
                                Blog
                                <input type="checkbox" class="position-absolute opacity-0 invisible" checked>
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="brand-name filter-input">
                            <label class="position-relative user-select-none">
                                Smartphone
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="sidebar-blk price-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">PRICE</span>
                    </div>
                    <div class="sidebar-menu position-relative">
                        <div class="price-input">
                            <div class="field position-relative">
                                <input title="min price" type="number" class="input-min" value="0">
                                <span class="currency-sign position-absolute top-50 translate-middle-y">$</span>
                            </div>
                            <div class="separator">TO</div>
                            <div class="field position-relative">
                                <input title="max-price" type="number" class="input-max" value="100">
                                <span class="currency-sign position-absolute top-50 translate-middle-y">$</span>
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="1000" value="0" step="10">
                            <input type="range" class="range-max" min="0" max="1000" value="100" step="10">
                        </div>
                    </div>
                </div>
                <div class="sidebar-blk color-blk">
                    <div class="sidebar-top">
                        <span class="text-white fw-medium text-uppercase">COLORS</span>
                    </div>
                    <div class="sidebar-menu d-flex flex-column">
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Beige
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Brown
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Orange
                                <input type="checkbox" class="position-absolute opacity-0 invisible" checked>
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                        <div class="color-name filter-input">
                            <label class="position-relative user-select-none">
                                Red
                                <input type="checkbox" class="position-absolute opacity-0 invisible">
                                <span class="checkbox position-absolute top-50 translate-middle-y start-0"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sidebar sm end -->


<?php
$this->endSection();
?>