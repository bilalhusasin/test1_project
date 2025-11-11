<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('users', function ($routes) {
    $controller = 'Users';

    $routes->get('login', $controller . '::login', ['as' => 'login']);
    $routes->post('login_submit', $controller . '::login_submit', ['as' => 'loginSubmit']);
    $routes->get('logout', $controller . '::logout', ['as' => 'logout']);
});

$routes->group('adminpanel', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Pages', ['as' => 'pages']);

    $routes->group('pages', function ($routes) {
        $controller = 'Pages';

        $routes->get('/', $controller, ['as' => 'pages']);
        $routes->get('migration', $controller. '::migration', ['as' => 'migration']);
        $routes->get('create', $controller . '::create', ['as' => 'createPages']);
        $routes->get('edit/(:num)', $controller . '::edit/$1', ['as' => 'editPages']);
        $routes->post('save/(:num)', $controller . '::save/$1', ['as' => 'savePages']);
        $routes->get('delete/(:num)', $controller . '::delete/$1', ['as' => 'deletePages']);
        $routes->get('delete/sure/(:num)', $controller . '::delete_sure/$1', ['as' => 'deleteSurePages']);
    });

    $routes->group('content', function ($routes) {
        $controller = 'Content';

        $routes->get('(:num)', $controller. '/$1', ['as' => 'content']);
        $routes->get('create/(:num)', $controller . '::create/$1', ['as' => 'createContent']);
        $routes->get('(:num)/edit/(:num)', $controller . '::edit/$1/$2', ['as' => 'editContent']);
        $routes->post('save_new/(:num)', $controller . '::save_new/$1', ['as' => 'saveContent_new']);
        $routes->post('(:num)/save_edit/(:num)', $controller . '::save_edit/$1/$2', ['as' => 'saveContent_edit']);
        $routes->get('(:num)/delete/(:num)', $controller . '::delete/$1/$2', ['as' => 'deleteContent']);
        $routes->get('(:num)/delete/sure/(:num)', $controller . '::delete_sure/$1/$2', ['as' => 'deleteSureContent']);
    });

    $routes->group('templates', function ($routes) {
        $controller = 'Templates';

        $routes->get('/', $controller, ['as' => 'templates']);
        $routes->get('create', $controller . '::create', ['as' => 'createTemplate']);
        $routes->get('edit/(:num)', $controller . '::edit/$1', ['as' => 'editTemplate']);
        $routes->post('save/(:num)', $controller . '::save/$1', ['as' => 'saveTemplate']);
        $routes->get('delete/(:num)', $controller . '::delete/$1', ['as' => 'deleteTemplate']);
        $routes->get('delete/sure/(:num)', $controller . '::delete_sure/$1', ['as' => 'deleteSureTemplate']);
    });

    $routes->group('products', function ($routes) {
        $controller = 'Products';

        $routes->get('/', $controller, ['as' => 'products']);
        $routes->get('merken/(:num)/(:num)', $controller . '::productsSub/$1/$2', ['as' => 'productsSubProds']);
        $routes->get('merken/(:num)', $controller . '::productsSub/$1', ['as' => 'productsSubSoorten']);
        $routes->get('merken', $controller . '::productsSub', ['as' => 'productsSub']);
        $routes->get('create', $controller . '::create', ['as' => 'createProduct']);
        $routes->get('edit/(:num)', $controller . '::edit/$1', ['as' => 'editProduct']);
        $routes->post('save/(:num)', $controller . '::save/$1', ['as' => 'saveProduct']);
        $routes->post('saveMulti/(:num)', $controller . '::save/$1/$2', ['as' => 'saveProductMulti']);
        $routes->get('delete/(:num)', $controller . '::delete/$1', ['as' => 'deleteProduct']);
        $routes->get('delete/sure/(:num)', $controller . '::delete_sure/$1', ['as' => 'deleteSureProduct']);
        $routes->post('getPrices', $controller . '::getPrices', ['as' => 'getPrices']);
        $routes->post('getSip', $controller . '::getSip', ['as' => 'getSip']);
        $routes->get('copy/(:segment)', $controller . '::copy/$1', ['as' => 'copyProduct']);
        $routes->get('import', $controller . '::import', ['as' => 'import']);
        $routes->get('importAanbod', $controller . '::importAanbod', ['as' => 'importAanbod']);
        $routes->post('importAanbodSave', $controller . '::importAanbodSave', ['as' => 'importAanbodSave']);
        $routes->post('getProds', $controller . '::getProds', ['as' => 'getProds']);
        $routes->post('getMerken', $controller . '::getMerken', ['as' => 'getMerken']);
        $routes->post('setActive', $controller . '::setActive', ['as' => 'setActive']);

        $routes->get('deleteGroup/(:num)', $controller . '::deleteGroup/$1', ['as' => 'deleteGroup']);
    });

    // Blog Admin Routes
    $routes->get('blogs', 'Blog::admin', ['as' => 'adminBlog']);
    $routes->get('blogs/create', 'Blog::create', ['as' => 'adminBlogCreate']);
    $routes->post('blogs/save', 'Blog::save', ['as' => 'adminBlogSave']);
    $routes->get('blogs/edit/(:num)', 'Blog::edit/$1', ['as' => 'adminBlogEdit']);
    $routes->put('blogs/update/(:num)', 'Blog::update/$1', ['as' => 'adminBlogUpdate']);
    $routes->get('blogs/delete/(:num)', 'Blog::delete/$1', ['as' => 'adminBlogDelete']);
    $routes->get('blogs/delete/sure/(:num)', 'Blog::delete_sure/$1', ['as' => 'adminBlogDeleteSure']);
});

$routes->post('getProduct', 'Products::getProduct');
$routes->post('getOffertePrice', 'Products::getOffertePrice');
$routes->post('zoeken', 'Products::search', ['as' => 'searchProd']);
$routes->get('resizePics', 'Products::resizePics');
$routes->get('getLog', 'Pages::getLog');
$routes->post('sendStaal', 'Products::sendStaal', ['as' => 'sendStaal']);
$routes->post('sendOfferte', 'Products::sendOfferte', ['as' => 'sendOfferte']);
$routes->get('changeUrl', 'Products::changeUrl', ['as' => 'changeUrl']);
$routes->get('(:any)/(:any)/page/(:num)', 'Pages::load/$1/$2/page/$3', ['as' => 'productUrlPage']);
$routes->get('/(:segment)/(:segment)/(:segment)/(:segment)', 'Pages::load/$1/$2/$3/$4', ['as' => 'productUrl']);
$routes->get('/(:segment)/(:segment)', 'Pages::load/$1/$2');
$routes->get('/(:segment)', 'Pages::load/$1');
$routes->get('/', 'Pages::load', ['as' => 'home']);

// Frontend Blog Route
$routes->get('blog', 'Blog::index', ['as' => 'blog']);
$routes->get('blog/(:segment)', 'Blog::detail/$1', ['as' => 'blogDetail']);