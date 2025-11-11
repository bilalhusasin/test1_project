<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/webAssets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/webAssets/css/fontawesome.min.css">
    <link rel="stylesheet" href="/webAssets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/webAssets/css/style.css">
    <link rel="stylesheet" href="/webAssets/css/responsive.css">

    <title>KANTOORTAPIJT.NL</title>

    <meta name="robots" content="noindex,nofollow">
</head>

<body>

    <!-- header area start -->
    <header class="header-area">
        <div class="header-top d-none d-md-block">
            <div class="container">
                <div class="header-top-wrap d-flex align-items-center justify-content-between">
                    <ul class="header-top-menu d-flex align-items-center">
                        <li><a href="/over-ons" class="fw-bold border-start-0">Over ons</a></li>
                        <!-- <li><a href="#" class="fw-bold">Vloeren</a></li> -->
                        <li><a href="/blog" class="fw-bold">Blog</a></li>
                        <li><a href="/advies" class="fw-bold">Advies</a></li>
                        <li><a href="/merkenblog" class="fw-bold">Merkenblog</a></li>
                        <li><a href="/werkwijze" class="fw-bold">Werkwijze</a></li>
                        <li><a href="/referenties" class="fw-bold">Referenties</a></li>
                    </ul>
                    <span class="fw-bold text-white">Voor projecten vanaf 70m²</span>
                    <span class="fw-bold text-white">Meer dan 520.000m² direct leverbaar!</span>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="header-wrapper d-flex align-items-center justify-content-between">
                    <span class="sublogo fw-bold p-3">Al 23 jaar online</span>
                    <a href="/" class="logo d-inline-block"><img src="/webAssets/img/logo.png" alt="site logo"></a>
                    <form action="<?= route_to('searchProd') ?>" method="post" class="flex-grow-1 mx-4">
                        <div class="header-search d-none d-lg-flex align-items-center fw-light w-100">
                            <div class="search-bar d-flex h-100 w-100">
                                <input type="search" name="q" placeholder="Zoeken naar producten..." class="border-0 bg-transparent h-100 w-100 p-3">
                                <button title="search" type="submit" class="search-btn d-flex align-items-center justify-content-center h-100 border-0">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="header-action d-none d-lg-flex align-items-center">
                        <!-- <a href="#" class="action-btn cart-btn d-inline-flex align-items-center"><img src="/webAssets/img/cart-icon.png" alt="cart icon">$0.00</a> -->
                    </div>
                    <button type="button" title="Open Menu" class="menu-bar border-0 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-menu" aria-controls="offcanvas-menu"><i class="fa-regular fa-bars"></i></button>
                </div>
            </div>
        </div>
        <div class="header-menu d-none d-lg-block">
            <div class="container">
                <div class="header-menu-wrap d-flex align-items-center justify-content-between">
                    <ul class="main-menu fw-medium d-flex align-items-center text-uppercase">
                        <?php
                        // foreach ($merken as $row) {
                        foreach ($menu as $url => $item) {
                            echo '
                                <li class="dropdown-container position-relative">
                                    <a href="/'.$url.'" class="dropdown-toggler d-inline-flex align-items-center gap-2">'.$item['name'].'<i class="fa-regular fa-angle-down"></i></a>
                                    <ul class="submenu position-absolute start-0 d-flex flex-column">';
                                        
                                        foreach($item['merken'] as $merk){
                                            foreach($merken as $m){
                                                if($m['id'] == $merk){
                                                    echo '<li><a href="/'.$url.'/'.$m['url'].'" class="d-block">'.$m['name'].'</a></li>';
                                                }
                                            }
                                        }
                                        
                            echo    '</ul>
                                </li>
                            ';
                        }
                        ?>
                        <!-- <li><a href="#" class="active">Home</a></li>
                        <li class="dropdown-container position-relative">
                            <a href="#" class="dropdown-toggler d-inline-flex align-items-center gap-2">Shop <i class="fa-regular fa-angle-down"></i></a>
                            <ul class="submenu position-absolute start-0 d-flex flex-column">
                                <li><a href="#" class="d-block">Dropdown Item</a></li>
                                <li><a href="#" class="d-block">Dropdown Item</a></li>
                                <li><a href="#" class="d-block">Dropdown Item</a></li>
                                <li><a href="#" class="d-block">Dropdown Item</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Sofa</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">About us</a></li> -->
                    </ul>
                    <!-- <a href="#" class="header-btn d-inline-flex align-items-center fw-medium text-uppercase"><img src="assets/img/gift-icon.png" alt="gift icon"> Special Gift</a> -->
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <!-- offcanvas menu start -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas-menu" aria-labelledby="offcanvas-menuLabel">
        <div class="offcanvas-header justify-content-between">
            <a href="index.html" class="logo d-inline-block"><img src="/webAssets/img/logo.png" alt="site logo"></a>
            <button type="button" title="Menu close" class="close-icon menu-bar border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="header-search d-flex align-items-center fw-light w-100">
                <div class="search-bar d-flex h-100 w-100">
                    <input type="search" placeholder="Search products…" class="border-0 bg-transparent h-100 w-100">
                    <button title="search" type="submit" class="search-btn d-flex align-items-center justify-content-center h-100 border-0"><i class="fa-light fa-magnifying-glass"></i></button>
                </div>
            </div>
            <ul class="main-menu fw-medium text-uppercase">
                <li><a href="#" class="d-block active">Home</a></li>
                <li><a href="#" class="d-block">Shop</a></li>
                <li><a href="#" class="d-block">Men</a></li>
                <li><a href="#" class="d-block">Women</a></li>
                <li><a href="#" class="d-block">Sofa</a></li>
                <li><a href="#" class="d-block">Contact</a></li>
                <li><a href="#" class="d-block">Blog</a></li>
                <li><a href="#" class="d-block">About us</a></li>
                <li>
                    <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#category-collapse" role="button" aria-expanded="false" aria-controls="category-collapse">category <i class="fa-regular fa-angle-down"></i></a>
                    <div class="category-collapse collapse" id="category-collapse">
                        <ul class="main-menu fw-medium text-uppercase">
                            <li><a href="#" class="d-block">Category</a></li>
                            <li><a href="#" class="d-block">Category</a></li>
                            <li><a href="#" class="d-block">Category</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="header-action d-flex align-items-center">
                <a href="#" class="action-btn cart-btn d-inline-flex align-items-center"><img src="/webAssets/img/cart-icon.png" alt="cart icon">$0.00</a>
            </div>
            <ul class="header-top-menu d-flex align-items-center">
                <li><a href="#" class="fw-bold border-start-0 ps-0 ms-0">My account</a></li>
                <li><a href="#" class="fw-bold">USD</a></li>
                <li><a href="#" class="fw-bold">ENG</a></li>
                <li><a href="#" class="fw-bold">Wishlist</a></li>
            </ul>
        </div>
    </div>

    <main>

        <?= $this->renderSection('content') ?>

        <!-- category area start -->
        <section class="category-area">
            <div class="container">
                <div class="category-area-wrapper d-lg-grid">
                    <div class="single-category category-area-thumb text-center">
                        <a href="/tapijttegels/trodon">
                            <img src="/webAssets/img/s_tapijttegels.JPG" alt="category area thumb" class="w-100 object-fit-cover">
                            <span>Tapijttegels</span>
                        </a>
                    </div>
                    <div>
                        <div class="category-area-main">
                            <div class="category-area-title section-title position-relative">
                                <img src="/webAssets/img/trodon.png" class="trodonLogo">
                            </div>

                            <div>
                                <span class="huismerk"><b>Het huismerk van Kantoortapijt.nl</b></span>
                                
                                <div class="category-slider-2 owl-carousel">
                                    <div class="single-category text-center">
                                        <a href="/pvc-vloeren/trodon">
                                            <img src="/webAssets/img/s_pvc.JPG" alt="category img" class="w-100">
                                            <span>PVC Vloeren</span>
                                        </a>
                                    </div>
                                    <div class="single-category text-center">
                                        <a href="/projectvinyl/trodon">
                                            <img src="/webAssets/img/s_projectvinyl.JPG" alt="category img" class="w-100">
                                            <span>Projectvinyl</span>
                                        </a>
                                    </div>
                                    <div class="single-category text-center">
                                        <a href="/linoleum/trodon">
                                            <img src="/webAssets/img/s_linoleum.JPG" alt="category img" class="w-100">
                                            <span>Linoleum</span>
                                        </a>
                                    </div>
                                    <div class="single-category text-center">
                                        <a href="/projecttapijt/trodon">
                                            <img src="/webAssets/img/s_projecttapijt.JPG" alt="category img" class="w-100">
                                            <span>Projecttapijt</span>
                                        </a>
                                    </div>
                                    <div class="single-category text-center">
                                        <a href="/loose-lay/trodon">
                                            <img src="/webAssets/img/s_looselay.JPG" alt="category img" class="w-100">
                                            <span>Loose Lay</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
        if($slugUrl == ''){
        ?>

        <section class="news-area">
            <div class="container">
                <div class="news-area-title section-title position-relative">
                    <h2 class="mb-0">Laatste blogs</h2>
                </div>

                <div class="news-slider-main">
                    <div class="news-slider owl-carousel">
                    <?php
                    foreach ($blogsFooter as $blog) {
                        ?>
                        <div class="news-slide">
                            <div class="news-thumb overflow-hidden">
                                <?php if (!empty($blog['image'])) : ?>
                                    <img src="<?= base_url('uploads/' . $blog['image']) ?>" alt="<?= esc($blog['title']) ?>" class="w-100">
                                <?php else : ?>
                                    <img src="/webAssets/img/news/news-thumb-placeholder.png" alt="Placeholder" class="w-100">
                                <?php endif; ?>
                            </div>

                            <div class="news-content">
                                <h3 class="news-title fw-normal"><?= esc($blog['title']) ?></h3>

                                <div class="news-info d-flex align-items-center">
                                    <span>Door kantoortapijt.nl</span>
                                    <span class="news-date position-relative"><?= \CodeIgniter\I18n\Time::parse($blog['created_at'])->format('F j, Y') ?></span>
                                </div>

                                <!-- <p class="news-desc"><?= esc(substr(strip_tags($blog['content']), 0, 150)) ?>...</p> -->

                                <a href="<?= route_to('blogDetail', $blog['slug']) ?>" class="readmore-btn text-decoration-underline fw-medium text-uppercase">Lees meer</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </section>
        
        <?php 
        }
        ?>

        <!-- <section class="newsletter-area">
            <div class="container">
                <div class="newsletter-wrap d-flex align-items-center justify-content-between">
                    <div class="newsletter d-flex align-items-center w-100">
                        <h3 class="newsletter-title mb-0 flex-shrink-0">Sign Up For Newsletter</h3>
                        <div class="newsletter-input d-flex w-100">
                            <input type="email" placeholder="your email address" class="border-0 bg-white w-100 h-100">
                            <button type="submit" class="text-uppercase border-0 d-flex align-items-center justify-content-center h-100">Subscribe</button>
                        </div>
                    </div>
                    <div class="follow-us d-flex align-items-center">
                        <h4 class="mb-0 fw-light flex-shrink-0">Follow Us :</h4>
                        <div class="social-icon-wrap d-flex align-items-center">
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <img src="/webAssets/img/social-icon/foursquare.png" alt="foursquare">
                            </a>
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <img src="/webAssets/img/social-icon/instagram-logo.png" alt="instagram-logo">
                            </a>
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <img src="/webAssets/img/social-icon/skype-logo.png" alt="skype-logo">
                            </a>
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <img src="/webAssets/img/social-icon/twitter-logo.png" alt="twitter-logo">
                            </a>
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <img src="/webAssets/img/social-icon/snapchat.png" alt="snapchat">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- newsletter area end -->
    </main>

    <!-- footer area start  -->
    <section class="footer-area border-2 border-bottom border-white">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-widget-wrap d-flex justify-content-between">
                    <div class="footer-widget">
                        <h4 class="text-white text-uppercase">Soorten</h4>
                        <div class="footer-links d-flex flex-column">
                            <?php
                            foreach ($menu as $url => $item) {
                                echo '<a href="/'.$url.'" class="d-inline-block">'.$item['name'].'</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="footer-widget">
                        <h4 class="text-white text-uppercase">Merken</h4>
                        <div class="footer-links d-flex flex-column">
                            <?php
                            foreach ($merkenNames as $url => $item) {
                                echo '<a href="/'.$url.'" class="d-inline-block">'.$item.'</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="footer-widget">
                        <h4 class="text-white text-uppercase">Informatie</h4>
                        <div class="footer-links d-flex flex-column">
                            <a href="/over-ons" class="d-inline-block">Over ons </a>
                            <a href="/blog" class="d-inline-block">Blog</a>
                            <a href="/advies" class="d-inline-block">Advies</a>
                            <a href="/merkenblog" class="d-inline-block">Merkenblog </a>
                            <a href="/referenties" class="d-inline-block">Referenties</a>
                        </div>
                    </div>
                    <div class="footer-widget">
                        <h4 class="text-white text-uppercase">Contact</h4>
                        <div class="footer-links d-flex flex-column">
                            <span class="address d-block">1 Februariweg 10D</span>
                            <span class="address d-block">4794SM Heijningen</span>
                            <a href="tel:0852033430" class="d-inline-block">085 - 20 33 430</a>
                            <a href="mailto:info@kantoortapijt.nl" class="d-inline-block">info@kantoortapijt.nl</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p class="copyright-text text-white mb-0 text-center"><?= date('Y') ?> &copy; - Alle rechten voorbehouden. - <a href="/Algemene_Voorwaarden_Kantoortapijt.pdf" target="_blank">Algemene voorwaarden</a> - <a href="/Privacyverklaring_Kantoortapijt.pdf" target="_blank">Privacyverklaring</a>- <a href="/disclaimer.pdf" target="_blank">Disclaimer</a></p>
            </div>
        </div>
    </section>
    <!-- footer area end -->

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="/webAssets/js/jquery-3.7.1.min.js"></script>
    <script src="/webAssets/js/popper.min.js"></script>
    <script src="/webAssets/js/bootstrap.min.js"></script>
    <script src="/webAssets/js/owl.carousel.min.js"></script>
    <script src="/webAssets/js/main.js"></script>

    <?= $this->renderSection('extraJs') ?>
</body>

</html>