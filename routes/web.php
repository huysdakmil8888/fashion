<?php
use App\Models\MenuModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
$prefixNews  = config('zvn.url.prefix_news');

Route::get('', [ 'as' => 'HomeController', 'uses' => 'News\HomeController@' . 'index' ]);
Route::group(['prefix' => $prefixNews, 'namespace' => 'News'],function(){
    Route::localized(function() {
    // ============================== HOMEPAGE ==============================
    $prefix         = '';
    $controllerName = 'home';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('/not-found',                    [ 'as' => $controllerName. '/not-found',                  'uses' => $controller . 'notFound' ]);
        Route::get('/subscribe',                    [ 'as' => $controllerName. '/subscribe',                  'uses' => $controller . 'subscribe' ]);
        Route::get('/unsubscribe',                    [ 'as' => $controllerName. '/unsubscribe',                  'uses' => $controller . 'unsubscribe' ]);
        Route::get('/delete-unsubsribe',                    [ 'as' => $controllerName. '/delete_unsubscribe',                  'uses' => $controller . 'delete_unsubscribe' ]);
    });
        // ====================== LOGIN ========================
        // news69/login
        $prefix         = '';
        $controllerName = 'auth';

        Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
            $controller = ucfirst($controllerName)  . 'Controller@';
            Route::get('/login',        ['as' => $controllerName.'/login',      'uses' => $controller . 'login'])->middleware('check.login');;
            Route::post('/postLogin',   ['as' => $controllerName.'/postLogin',  'uses' => $controller . 'postLogin']);

            // ====================== LOGOUT ========================
            Route::get('/logout',       ['as' => $controllerName.'/logout',     'uses' => $controller . 'logout']);
        });
    // ====================== Product page ========================
    $prefix         = 'san-pham';
    $controllerName = 'product';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('{product_slug}-{product_id}.html', [ 'as' => $controllerName . '/index', 'uses' => $controller . 'index' ])->where('product_slug', '[0-9a-zA-Z_-]+');
        Route::post('{product_slug}-{product_id}.html', [ 'as' => $controllerName . '/rating', 'uses' => $controller . 'rating' ])->where('product_slug', '[0-9a-zA-Z_-]+');
        Route::post('comment', [ 'as' => $controllerName . '/comment', 'uses' => $controller . 'comment' ]);
        Route::get('modal/{id}', [ 'as' => $controllerName . '/modal', 'uses' => $controller . 'modal' ]);




    });


    // ============================== CUSTOMER PAGE ==============================
    $prefix         = 'customer';
    $controllerName = 'customer';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/my-account',                    [ 'as' => $controllerName. '/my-account',                  'uses' => $controller . 'myAccount' ]);
        Route::get('/my-account/edit',                    [ 'as' => $controllerName. '/edit',                  'uses' => $controller . 'edit' ]);
        Route::get('/register-login',                    [ 'as' => $controllerName. '/register-login',                  'uses' => $controller . 'registerLogin' ]);
        Route::post('/register',                    [ 'as' => $controllerName. '/register',                  'uses' => $controller . 'register' ]);
        Route::post('/login',                    [ 'as' => $controllerName. '/login',                  'uses' => $controller . 'login' ]);
        Route::get('/logout',                    [ 'as' => $controllerName. '/logout',                  'uses' => $controller . 'logout' ]);
    });
    // ====================== ARTICLE ========================
    $prefix         = app()->getLocale()=='vi'?'bai-viet':'news';

    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('{article_slug}-{id}.html', [ 'as' => $controllerName . '/detail', 'uses' => $controller . 'detail' ])->where('article_slug', '[0-9a-zA-Z_-]+');
        Route::get('{id}.html', [ 'as' => $controllerName . '/increaseLike', 'uses' => $controller . 'increaseLike' ]);
        Route::get('archive/{archive}.html', [ 'as' => $controllerName . '/archive', 'uses' => $controller . 'archive' ]);
        Route::post('comment', [ 'as' => $controllerName . '/comment', 'uses' => $controller . 'comment' ]);
        Route::get('tag/{slug}-{tag}.html', [ 'as' => $controllerName . '/tag', 'uses' => $controller . 'tag' ]);

    });
    // ====================== PAGE ========================
    $prefix         = 'trang';
    $controllerName = 'page';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('{page_slug}-{id}.html', [ 'as' => $controllerName . '/detail', 'uses' => $controller . 'index' ])->where('page_slug', '[0-9a-zA-Z_-]+');

    });
    // ====================== Category ARTICLE ========================
    $prefix         = app()->getLocale()=='vi'?'chuyen-muc':'cats';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('{category_article_slug}-{category_article_id}.html', [ 'as' => $controllerName . '/index', 'uses' => $controller . 'index' ])->where('category_article_slug', '[0-9a-zA-Z_-]+');
        Route::get('author/{author_slug}-{author_id}.html', [ 'as' => $controllerName . '/author', 'uses' => $controller . 'author' ])
            ->where('author_slug', '[0-9a-zA-Z_-]+');



    });

    // ====================== Category page ========================
    $prefix         = '';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        // Route::get('/search-{product_name}', [ 'as' => $controllerName . '/search', 'uses' => $controller . 'search' ]);
        Route::get('/search', [ 'as' => $controllerName . '/search', 'uses' => $controller . 'index' ]);

        Route::get('/search_price', [ 'as' => $controllerName . '/search_price', 'uses' => $controller . 'search_price' ]);

        Route::get('{category_slug}-{id}.html', [ 'as' => $controllerName . '/index', 'uses' => $controller . 'index' ])
            ->where('category_slug', '[0-9a-zA-Z_-]+');
        ;
        Route::get('addwishlist.html', [ 'as' => $controllerName . '/addWishList', 'uses' => $controller . 'addWishList' ]);

        Route::get('wishlist.html', [ 'as' => $controllerName . '/wishlist', 'uses' => $controller . 'wishlist' ]);
        Route::get('productnews.html', [ 'as' => $controllerName . '/productnews', 'uses' => $controller . 'productnews' ]);
        Route::get('productbestbuy.html', [ 'as' => $controllerName . '/productbestbuy', 'uses' => $controller . 'productbestbuy' ]);
        Route::get('productbestdeal.html', [ 'as' => $controllerName . '/productbestdeal', 'uses' => $controller . 'productbestdeal' ]);
        Route::get('productsale.html', [ 'as' => $controllerName . '/productsale', 'uses' => $controller . 'productsale' ]);
        Route::get('productfeatured.html', [ 'as' => $controllerName . '/productfeatured', 'uses' => $controller . 'productfeatured' ]);
        Route::get('search.html', [ 'as' => $controllerName . '/search', 'uses' => $controller . 'search' ]);
        Route::get('tag/{tag_slug}-{tag_id}.html', [ 'as' => $controllerName . '/tag', 'uses' => $controller . 'tag' ]);
    });








    // ============================== CONTACT ============================== //
    $prefix = 'lien-he';
    $controllerName = 'contact';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('', [ 'as' => $controllerName, 'uses' => $controller . 'index' ]);

        Route::post('/contact',                 [ 'as' => $controllerName . '/contacts',                  'uses' => $controller . 'contact' ]);
        Route::get('/map',                 [ 'as' => $controllerName . '/map',                  'uses' => $controller . 'map' ]);
    });

    // ====================== ABOUT US ========================
    $prefix         = '';
    $controllerName = 'about';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('/about-us',[ 'as' => $controllerName . '/index', 'uses' => $controller . 'index' ]);
    });


    /*============================================== Cart  =======================================================*/ $prefix         = 'cart';
    $prefix         = 'check-out';
    $controllerName = 'checkout';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';

        Route:: get('/',                ['as' => $controllerName             ,'uses' => $controller . 'index' ]);
        Route:: get('/shipping',                ['as' => $controllerName ."/shipping"            ,'uses' => $controller . 'shipping' ]);
        Route:: post('/',                ['as' => $controllerName ."/order"            ,'uses' => $controller . 'order' ]);


    });
    /*============================================== Cart  =======================================================*/ $prefix         = 'cart';
    $controllerName = 'cart';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';

        Route:: get('/',                ['as' => $controllerName                ,'uses' => $controller . 'index' ]);
        Route:: get('/add-cart',        ['as' => $controllerName . '/add-cart'  ,'uses' => $controller . 'add' ]);
        Route:: get('/remove-cart',        ['as' => $controllerName . '/remove-cart'  ,'uses' => $controller . 'remove' ]);
        Route:: get('/update-cart',        ['as' => $controllerName . '/update-cart'  ,'uses' => $controller . 'update' ]);
        Route:: get('/coupon',        ['as' => $controllerName . '/coupon'  ,'uses' => $controller . 'coupon' ]);
        Route:: post('/post-order',     ['as' => $controllerName . '/order',    'uses' => $controller . 'postOrder' ]);
        Route:: get('/thank-you.html',  ['as' => $controllerName . '/thankyou', 'uses' => $controller . 'thankyou' ]);

    });
    }
    );
});
