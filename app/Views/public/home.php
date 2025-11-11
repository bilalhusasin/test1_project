<?php
$this->extend('templates/public');

$this->section('page_title');
$this->endSection();

$this->section('page_description');
$this->endSection();

$this->section('content');
?>

<section class="hero-area position-relative">
    <div class="container">
        <div class="hero-wrapper d-grid">
            <button type="button" class="sidebar-toggle border-0 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar-offcanvas" aria-controls="sidebar-offcanvas">Show Filter</button>
            <div class="sidebar d-none d-lg-block">
                <div class="sidebar-top d-flex align-items-center">
                    <button title="bars" type="button" class="bar-icon bg-transparent border-0"><i class="fa-light fa-bars"></i></button>
                    <span class="text-white fw-medium">Merken</span>
                </div>
                <div class="sidebar-menu d-flex flex-column">
                    <?php
                    foreach($merken as $merk){
                        echo '
                            <a href="'.$merk['url'].'" class="menu-link d-flex align-items-center">
                                <span>'.$merk['name'].'</span>
                            </a>
                        ';
                    }
                    ?>
                    <!-- <div class="dropdown-container position-relative">
                        <a href="#" class="menu-link dropdown-toggler d-flex align-items-center justify-content-between">
                            <div class="menu-link-left d-flex align-items-center">
                            <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                                <img src="/webAssets/img/camera-icon.png" alt="link icon">
                            </div>
                            <span>Camera</span>
                            </div>
                            <i class="fa-regular fa-angle-down"></i>
                        </a>
                        <ul class="submenu position-absolute top-0 d-flex flex-column">
                            <li><a href="#" class="d-block">Dropdown Item</a></li>
                            <li><a href="#" class="d-block">Dropdown Item</a></li>
                            <li><a href="#" class="d-block">Dropdown Item</a></li>
                            <li><a href="#" class="d-block">Dropdown Item</a></li>
                        </ul>
                    </div>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/sunglass-icon.png" alt="link icon">
                        </div>
                        <span>Sunglasses</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/laptop-icon.png" alt="link icon">
                        </div>
                        <span>Laptop</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/smartphone-icon.png" alt="link icon">
                        </div>
                        <span>Smartphone</span>
                    </a> -->
                </div>
            </div>
            <div class="hero-thumb-wrap">
                <div class="row">
                    <div class="col-12">
                        <a href="/aanbiedingen">
                            <div class="hero-thumb position-relative aanbiedingenHero">
                                <!-- <img src="/webAssets/img/hero-thumb-1.jpg" alt="hero thumb" class="w-100"> -->
                                <!-- <h3 class="mb-0 fw-bold text-white position-absolute start-50 translate-middle-x bottom-0 z-1 w-50 rounded-0 text-center">Aanbiedingen</h3> -->
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/top-10">
                            <div class="hero-thumb position-relative">
                                <img src="/webAssets/img/hero-thumb-2.jpg" alt="hero thumb" class="w-100">
                                <h3 class="mb-0 fw-bold text-white position-absolute start-0 bottom-0 z-1 w-100 text-center">Top 10</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/referenties">
                            <div class="hero-thumb position-relative">
                                <img src="/webAssets/img/hero-thumb-3.jpg" alt="hero thumb" class="w-100">
                                <h3 class="mb-0 fw-bold text-white position-absolute start-0 bottom-0 z-1 w-100 text-center">Referenties</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero area end -->

<!-- sidebar sm start -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar-offcanvas" aria-labelledby="sidebar-offcanvasLabel">
    <div class="offcanvas-header justify-content-end">
        <button type="button" title="sidebar close" class="close-icon menu-bar border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="sidebar-sm sidebar w-100">
            <div class="sidebar-wrapper">
                <div class="sidebar-top d-flex align-items-center">
                    <button title="bars" type="button" class="bar-icon bg-transparent border-0"><i class="fa-light fa-bars"></i></button>
                    <span class="text-white fw-medium">WAROOM KANTORTAPIJT</span>
                </div>
                <div class="sidebar-menu d-flex flex-column">
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/camera-icon.png" alt="link icon">
                        </div>
                        <span>Camera</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/sunglass-icon.png" alt="link icon">
                        </div>
                        <span>Sunglasses</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/laptop-icon.png" alt="link icon">
                        </div>
                        <span>Laptop</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/smartphone-icon.png" alt="link icon">
                        </div>
                        <span>Smartphone</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/computer-icon.png" alt="link icon">
                        </div>
                        <span>Computer</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/tv-icon.png" alt="link icon">
                        </div>
                        <span>TV & Audio</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/headphone-icon.png" alt="link icon">
                        </div>
                        <span>Headphone</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/smart-watch.png" alt="link icon">
                        </div>
                        <span>Smart watch</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/fashion-icon.png" alt="link icon">
                        </div>
                        <span>Fashion</span>
                    </a>
                    <a href="#" class="menu-link d-flex align-items-center">
                        <div class="link-icon d-flex align-items-center justify-content-center rounded-circle">
                            <img src="/webAssets/img/sale-icon.png" alt="link icon">
                        </div>
                        <span>Sale and Offers</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sidebar sm end -->

<?php
$this->endSection();
?>