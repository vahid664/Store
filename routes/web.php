<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('sitemap.xml','Visitor\SitemapController@sitemap');
Route::get('sitemap-blog.xml','Visitor\SitemapController@blog');
Route::get('sitemap-category.xml','Visitor\SitemapController@category');
Route::get('sitemap-tag.xml','Visitor\SitemapController@tag');
Route::get('sitemap-post.xml','Visitor\SitemapController@post');
Route::get('sitemap-static.xml','Visitor\SitemapController@statics');
Route::get('sitemap-brand.xml','Visitor\SitemapController@brand');

Route::group(['middleware' => ['auth','paneluser'],'prefix' => 'address'],function () {
    Route::get('delete/{id}','User\AddressController@delete');
    Route::get('create','User\AddressController@create');
    Route::post('store','User\AddressController@store');
    Route::get('show/{id}','User\AddressController@show');
    Route::post('city','User\ProvinceController@index');
});

Route::resource('Discount','User\DiscountContoller')->middleware(['auth','paneluser']);
Route::resource('SendType','User\PeykController')->middleware(['auth','paneluser']);
Route::resource('GiftUser','User\GiftController')->middleware(['auth','paneluser']);

Route::group(['middleware' => ['auth','paneluser'],'prefix' => 'buy'],function () {
    Route::get('info','User\BuyController@info_send');
    Route::get('typeSend','User\BuyController@TypeSend');
    Route::post('paymant','User\BuyController@payment');
    Route::get('factor','User\BuyController@factor');
});
Route::any('buy/verify','User\BuyController@verify');

Route::get('cart/delete/{id}','User\CartController@destroy')->middleware(['paneluser']);
Route::post('cart_add','User\CartController@add')->middleware(['paneluser']);
Route::get('cart_delete/{id}','User\CartController@delete')->middleware(['paneluser']);
Route::resource('cart','User\CartController')->middleware(['paneluser']);

Route::get('test-email', 'JobController@enqueue');

Route::get('blog',function (){
    return \Illuminate\Support\Facades\Redirect::to('Blog',301);
});


Route::group(['middleware' => ['visitor','before']],function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/send/email', 'HomeController@mail');

    Route::resource('/ContactUser','Visitor\ContactController')->only('store');
    Route::resource('/Comment','Visitor\CommentController')->only('store')->middleware('auth');
    Route::resource('/PageSta','Visitor\PageController')->only('show');
    Route::resource('/NewsEmail','Visitor\NewsEmailController')->only('store');
    Route::resource('/brand','Visitor\BrandController')->only('show');
    Route::resource('/product','Visitor\ProductController')->only('show');
    Route::resource('/tag','Visitor\TagController')->only('show');
    Route::resource('/search','Visitor\SearchController')->only('index');
    Route::resource('/Blog','Visitor\BlogController')->only(['index','show']);
    Route::resource('/JsonSearch','Visitor\SearchJsonController');
//Route::resource('/UserAuth','Visitor\UserAuthController');
    Route::post('UserAuth/login','Visitor\UserAuthController@login');
    Route::post('/ProductOffer','Visitor\ProductOfferController@store');

});



Route::group(['middleware' => ['auth','paneluser']],function () {
    Route::resource('/favorite','Visitor\FavoriteController')->only(['show','index','destroy']);
    Route::resource('/profile','User\ProfileController');
    Route::resource('/order','User\OrderController');
    Route::resource('/UserPassword','User\PasswordController');
});



//Route::resource('Admin/Category','Admin\CategoryController');
Route::group(['prefix' => 'Admin','middleware' => ['auth','admin','CheckPer']],function () {
   Route::get('/','Admin\AdminController@index');
   Route::resource('SearchAdmin','Admin\SearchController');
   Route::resource('Redirect','Admin\RedirectController');
   Route::resource('CommentAdmin','Admin\CommentController');
   Route::resource('/CopyProduct','Admin\CopyProductController');
   Route::resource('/CopyProCat','Admin\CopyProCatController');
   Route::resource('/Faq','Admin\FaqController');
   Route::resource('/Size','Admin\SizeController');
   Route::resource('/ProductSize','Admin\ProductSizeController');
   Route::resource('/ReportFactor','Admin\ReportFactorController');
   Route::resource('/PicColor','Admin\PicColorController');
   Route::resource('/Article','Admin\ArticleController');
   Route::resource('/ProductReturned','Admin\ProductReturnedController');
   Route::get('/ProductReturned/destroy/{id}','Admin\ProductReturnedController@destroy');
   Route::resource('/ManagementBrand','Admin\ProductBrandManagementController');
   Route::resource('/ManagementCategory','Admin\ProductCategoryManagementController');
   Route::get('/ArticleFile/destroy/{id}','Admin\ArticleFileController@destroy');
   Route::resource('/News','Admin\NewsEmailAdminController');
   Route::resource('/Social','Admin\SocialController');
   Route::resource('/Color','Admin\ColorController');
   Route::resource('/Brand','Admin\BrandController');
   Route::resource('/Financial','Admin\FinancialController');
   Route::resource('/Page','Admin\PageController');
   Route::resource('/Category','Admin\CategoryController');
   Route::resource('/Contact','Admin\ContactController');
   Route::resource('/Code','Admin\OffController');
   Route::resource('/Gift','Admin\GiftController');
   Route::resource('/Peyk','Admin\PeykController');
   Route::resource('/User','Admin\UserController');
   Route::resource('/Tag','Admin\TagController');
   Route::resource('/Advertise','Admin\AdvertiseController');
   Route::resource('/Product','Admin\ProductController');
   Route::resource('/ProductReport','Admin\ProductReportController');
   Route::get('/ProductFile/destroy/{id}','Admin\ProductFileController@destroy');
   Route::resource('/ProductDetail','Admin\ProductDetailController');
   Route::resource('/ProductUpdate','Admin\ProductUpdateController');
   Route::resource('/ProductAwesome','Admin\ProductAwesomeController');
   Route::resource('/Factor','Admin\FactorController');
   Route::resource('Permission','Admin\PermissionController');
   Route::resource('Role','Admin\RoleController');
   Route::resource('ProductOfferAdmin','Admin\ProductOfferController');
});
Route::group(['prefix' => 'Admin/Sort','middleware' => ['auth','admin']],function () {
    Route::post('category','Admin\SortController@category')->name('SortCategory');
    Route::post('color','Admin\SortController@color')->name('SortColor');
	Route::post('free','Admin\SortController@free')->name('SortFree');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth','admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});



Route::get('/{category}','Visitor\CategoryController@show')->middleware('before');

Route::fallback(function () {
    return \Illuminate\Support\Facades\Redirect::to('/',301);
})->middleware('before');
