 <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

/*登录退出路由*/
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['middleware' => 'alog', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('captcha/getcaptcha/{tmp}', 'CaptchaController@getCaptcha');
Route::get('auth/getcaptcha', 'Auth\AuthController@getCaptcha');
Route::get('/', ['middleware' => 'auth', 'as' => 'index.index', 'uses' => 'IndexController@index']);

Route::group(['middleware' => 'auth', 'prefix' => 'admins', 'permission' => ['admin']], function () {
    Route::get('/', ['as' => 'admin.list', 'uses' => 'AdminsController@index']);
    Route::get('/add', ['as' => 'admin.add', 'uses' => 'AdminsController@add']);
    Route::get('/edit/{id}', ['as' => 'admin.edit', 'uses' => 'AdminsController@edit']);
    Route::get('/del/{id}', ['as' => 'admin.del', 'uses' => 'AdminsController@delete']);
    Route::post('/save', ['as' => 'admin.save', 'uses' => 'AdminsController@save']);
    Route::post('/store', ['as' => 'admin.store', 'uses' => 'AdminsController@store']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'roles', 'permission' => ['admin']], function () {
    Route::get('/', ['as' => 'roles.list', 'uses' => 'RolesController@index']);
    Route::get('/add', ['as' => 'roles.add', 'uses' => 'RolesController@add']);
    Route::post('/save', ['as' => 'roles.save', 'uses' => 'RolesController@save']);
    Route::get('/edit/{id}', ['as' => 'roles.edit', 'uses' => 'RolesController@edit']);
    Route::post('/store', ['as' => 'roles.store', 'uses' => 'RolesController@store']);
    Route::get('/rolePermissionEdit/{id}', ['as' => 'roles.rolePermissionEdit', 'uses' => 'RolesController@rolePermissionEdit']);
    Route::post('/rolePermissionStore', ['as' => 'roles.rolePermissionStore', 'uses' => 'RolesController@rolePermissionStore']);
    Route::get('/delete/{id}', ['as' => 'roles.delete', 'uses' => 'RolesController@delete']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'product', 'permission' => ['product']], function () {
    Route::get('/', ['as' => 'product.list', 'uses' => 'ProductController@listProduct']);
    Route::get('/add', ['as' => 'product.add', 'uses' => 'ProductController@createProduct']);
    Route::post('/store', ['as' => 'product.store', 'uses' => 'ProductController@store']);
    Route::get('/pic', ['as' => 'product.pic', 'uses' => 'ProductController@pic']);

    Route::get('/action', ['as' => 'product.action', 'uses' => 'ProductController@action']);
    Route::get('/revise/{id}', ['as' => 'product.revise', 'uses' => 'ProductController@reviseProduct']);
    Route::post('/modify', ['as' => 'producttype.modify', 'uses' => 'ProductController@modify']);

    Route::get('/producttype_del/{id}', ['as' => 'producttype.del', 'uses' => 'ProductTypeController@delProductType']);
    Route::get('/producttype_select', ['as' => 'producttype.select', 'uses' => 'ProductTypeController@index']);
    Route::get('/producttype_multi', ['as' => 'producttype.producttype_multi', 'uses' => 'ProductTypeController@multiSelect']);
    Route::get('/producttype_list', ['as' => 'producttype.list', 'uses' => 'ProductTypeController@listProductType']);
    Route::get('/producttype_create', ['as' => 'producttype.create', 'uses' => 'ProductTypeController@createProductType']);
    Route::get('/producttype_repair', ['as' => 'producttype.repair', 'uses' => 'ProductTypeController@repairProductType']);
    Route::get('/producttype_edit', ['as' => 'producttype.edit', 'uses' => 'ProductTypeController@editProductType']);
    Route::post('/producttype_editsave', ['as' => 'producttype.edit', 'uses' => 'ProductTypeController@editSaveProductType']);
    Route::post('/producttype_store', ['as' => 'producttype.store', 'uses' => 'ProductTypeController@storeProductType']);

});

Route::group(['middleware' => 'auth', 'prefix' => 'permission', 'permission' => ['admin']], function () {
    Route::get('/', ['as' => 'permission.list', 'uses' => 'PermissionController@index']);
    Route::get('/add', ['as' => 'permission.add', 'uses' => 'PermissionController@add']);
    Route::post('/save', ['as' => 'permission.save', 'uses' => 'PermissionController@save']);
    Route::post('/rolesAddPermission', ['as' => 'permission.rolesAddPermission', 'uses' => 'PermissionController@rolesAddPermission']);
    Route::get('/edit/{id}', ['as' => 'permission.edit', 'uses' => 'PermissionController@edit']);
    Route::post('/store', ['as' => 'permission.store', 'uses' => 'PermissionController@store']);
    Route::get('/delete/{id}', ['as' => 'permission.delete', 'uses' => 'PermissionController@delete']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'articles', 'permission' => ['news']], function () {
    Route::get('/index', ['as' => 'article.list', 'uses' => 'ArticlesController@index']);
    Route::get('/create/{lang?}', ['as' => 'article.create', 'uses' => 'ArticlesController@create', function ($lang) {($lang == null) & $lang = 'cn';}]);
    Route::post('/store', ['as' => 'article.store', 'uses' => 'ArticlesController@store']);
    Route::get('/edit/{id}', ['as' => 'article.edit', 'uses' => 'ArticlesController@edit']);
    Route::post('/update/{id}', ['as' => 'article.update', 'uses' => 'ArticlesController@update']);
    Route::any('/delete', ['as' => 'article.batch.delete', 'uses' => 'ArticlesController@delete']);
    Route::post('/batchMove', ['as' => 'article.batch.move', 'uses' => 'ArticlesController@batchMove']);
    Route::post('/batch', ['as' => 'article.batch', 'uses' => 'ArticlesController@batch']);
    Route::post('/uploadImage', ['as' => 'article.uploadImage', 'uses' => 'ArticlesController@uploadImage']);
    Route::post('/upload', ['as' => 'article.upload', 'uses' => 'ArticlesController@upload']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'newtype', 'permission' => ['news']], function () {
    Route::get('/index', ['as' => 'newtype.list', 'uses' => 'NewTypeController@index']);
    Route::get('/create', ['as' => 'newtype.create', 'uses' => 'NewTypeController@create']);
    Route::post('/store', ['as' => 'newtype.store', 'uses' => 'NewTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'newtype.edit', 'uses' => 'NewTypeController@edit']);
    Route::post('/update/{id}', ['as' => 'newtype.update', 'uses' => 'NewTypeController@update']);
    Route::any('/delete', ['as' => 'newtype.batch.delete', 'uses' => 'NewTypeController@delete']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'archivesinfo', 'permission' => ['news']], function () {
    Route::get('/index', ['as' => 'archivesinfo.list', 'uses' => 'ArchivesInfoController@index']);
    Route::get('/create', ['as' => 'archivesinfo.create', 'uses' => 'ArchivesInfoController@create']);
    Route::post('/store', ['as' => 'archivesinfo.store', 'uses' => 'ArchivesInfoController@store']);
    Route::get('/edit/{id}', ['as' => 'archivesinfo.edit', 'uses' => 'ArchivesInfoController@edit']);
    Route::post('/update/{id}', ['as' => 'archivesinfo.update', 'uses' => 'ArchivesInfoController@update']);
    Route::any('/delete', ['as' => 'archivesinfo.batch.delete', 'uses' => 'ArchivesInfoController@delete']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'documenttype', 'permission' => ['info']], function () {
    Route::get('/index', ['as' => 'documenttype.list', 'uses' => 'DocumentTypeController@index']);
    Route::get('/create', ['as' => 'documenttype.create', 'uses' => 'DocumentTypeController@create']);
    Route::post('/store', ['as' => 'documenttype.store', 'uses' => 'DocumentTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'documenttype.edit', 'uses' => 'DocumentTypeController@edit']);
    Route::post('/update/{id}', ['as' => 'documenttype.update', 'uses' => 'DocumentTypeController@update']);
    Route::any('/delete', ['as' => 'documenttype.batch.delete', 'uses' => 'DocumentTypeController@delete']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'productdocument', 'permission' => ['info']], function () {
    Route::get('/index', ['as' => 'productdocument.list', 'uses' => 'ProductDocumentController@index']);
    Route::get('/create', ['as' => 'productdocument.create', 'uses' => 'ProductDocumentController@create']);
    Route::post('/store', ['as' => 'productdocument.store', 'uses' => 'ProductDocumentController@store']);
    Route::get('/edit/{id}', ['as' => 'productdocument.edit', 'uses' => 'ProductDocumentController@edit']);
    Route::post('/update/{id}', ['as' => 'productdocument.update', 'uses' => 'ProductDocumentController@update']);
    Route::any('/delete', ['as' => 'productdocument.batch.delete', 'uses' => 'ProductDocumentController@delete']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'langs', 'permission' => ['product']], function () {
    Route::get('/', ['as' => 'langs', 'uses' => 'LangsController@index']);
    Route::get('/add', ['as' => 'langs.add', 'uses' => 'LangsController@add']);
    Route::get('/del/{id}', ['as' => 'langs.delete', 'uses' => 'LangsController@delete']);
    Route::get('/edit/{id}', ['as' => 'langs.edit', 'uses' => 'LangsController@edit']);
    Route::post('/save', ['as' => 'langs.save', 'uses' => 'LangsController@save']);
    Route::post('/store', ['as' => 'langs.store', 'uses' => 'LangsController@store']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'job', 'permission' => ['recruit']], function () {
    Route::get('/index', ['as' => 'job.list', 'uses' => 'JobController@index']);
    Route::get('/create/{lang?}', ['as' => 'job.create', 'uses' => 'JobController@create']);
    Route::post('/store', ['as' => 'job.store', 'uses' => 'JobController@store']);
    Route::get('/edit/{id}', ['as' => 'job.edit', 'uses' => 'JobController@edit']);
    Route::post('/update/{id}', ['as' => 'job.update', 'uses' => 'JobController@update']);
    Route::any('/delete', ['as' => 'job.batch.delete', 'uses' => 'JobController@delete']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'countryarea', 'permission' => ['product']], function () {
    Route::get('/', ['as' => 'countryarea', 'uses' => 'CountryareaController@index']);
    Route::get('/add', ['as' => 'countryarea.add', 'uses' => 'CountryareaController@add']);
    Route::get('/del/{id}', ['as' => 'countryarea.delete', 'uses' => 'CountryareaController@delete']);
    Route::get('/edit/{id}', ['as' => 'countryarea.edit', 'uses' => 'CountryareaController@edit']);
    Route::post('/save', ['as' => 'countryarea.save', 'uses' => 'CountryareaController@save']);
    Route::post('/store', ['as' => 'countryarea.store', 'uses' => 'CountryareaController@store']);
    Route::get('/list', ['as' => 'countryarea.store', 'uses' => 'CountryareaController@selectAreaCounty']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'basecolor', 'permission' => ['product']], function () {
    Route::get('/index', ['as' => 'basecolor', 'uses' => 'BasecolorController@index']);
    Route::get('/add', ['as' => 'basecolor.add', 'uses' => 'BasecolorController@add']);
    Route::any('/del', ['as' => 'basecolor.delete', 'uses' => 'BasecolorController@delete']);
    Route::get('/edit/{id}', ['as' => 'basecolor.edit', 'uses' => 'BasecolorController@edit']);
    Route::any('/save', ['as' => 'basecolor.save', 'uses' => 'BasecolorController@save']);
    Route::post('/store/{id}', ['as' => 'basecolor.store', 'uses' => 'BasecolorController@store']);
    Route::get('/action', ['as' => 'product.action', 'uses' => 'BasecolorController@action']);

});

Route::group(['middleware' => 'auth', 'prefix' => 'video', 'permission' => ['video']], function () {
    Route::get('/', ['as' => 'countryarea', 'uses' => 'VideoController@index']);
    Route::get('/add', ['as' => 'countryarea.add', 'uses' => 'VideoController@add']);
    Route::any('/del', ['as' => 'countryarea.delete', 'uses' => 'VideoController@delete']);
    Route::get('/edit/{id}', ['as' => 'countryarea.edit', 'uses' => 'VideoController@edit']);
    Route::any('/save', ['as' => 'countryarea.save', 'uses' => 'VideoController@save']);
    Route::post('/store/{id}', ['as' => 'countryarea.store', 'uses' => 'VideoController@store']);
    Route::get('/action', ['as' => 'product.action', 'uses' => 'VideoController@action']);

});

Route::group(['middleware' => 'auth', 'prefix' => 'producttranslate', 'permission' => ['product']], function () {
    Route::get('/', ['as' => 'countryarea', 'uses' => 'ProductTranslateController@index']);
    Route::get('/add', ['as' => 'countryarea.add', 'uses' => 'ProductTranslateController@add']);
    Route::any('/del', ['as' => 'countryarea.delete', 'uses' => 'ProductTranslateController@delete']);
    Route::get('/edit/{id}', ['as' => 'countryarea.edit', 'uses' => 'ProductTranslateController@edit']);
    Route::any('/save', ['as' => 'countryarea.save', 'uses' => 'ProductTranslateController@save']);
    Route::any('/store', ['as' => 'countryarea.store', 'uses' => 'ProductTranslateController@store']);
    Route::get('/action', ['as' => 'product.action', 'uses' => 'ProductTranslateController@action']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'productcolor', 'permission' => ['product']], function () {
    Route::get('/', ['as' => 'productcolor', 'uses' => 'ProductcolorController@index']);
    Route::get('/add', ['as' => 'productcolor.add', 'uses' => 'ProductcolorController@add']);
    Route::get('/del/{id}', ['as' => 'productcolor.delete', 'uses' => 'ProductcolorController@delete']);
    Route::get('/edit/{id}', ['as' => 'productcolor.edit', 'uses' => 'ProductcolorController@edit']);
    Route::post('/save', ['as' => 'productcolor.save', 'uses' => 'ProductcolorController@save']);
    Route::post('/store', ['as' => 'productcolor.store', 'uses' => 'ProductcolorController@store']);
    Route::any('/getModelColors', ['as' => 'productcolor.getModelColors', 'uses' => 'ProductcolorController@getModelColors']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'supply', 'permission' => ['setting']], function () {
    Route::get('/index', ['as' => 'supply.list', 'uses' => 'SupplyController@index']);
    Route::get('/create', ['as' => 'supply.create', 'uses' => 'SupplyController@create']);
    Route::post('/store', ['as' => 'supply.store', 'uses' => 'SupplyController@store']);
    Route::get('/edit/{id}', ['as' => 'supply.edit', 'uses' => 'SupplyController@edit']);
    Route::post('/update/{id}', ['as' => 'supply.update', 'uses' => 'SupplyController@update']);
    Route::any('/delete', ['as' => 'supply.batch.delete', 'uses' => 'SupplyController@delete']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'proxy', 'permission' => ['setting']], function () {
    Route::get('/index', ['as' => 'proxy.list', 'uses' => 'ProxyController@index']);
    Route::get('/create', ['as' => 'proxy.create', 'uses' => 'ProxyController@create']);
    Route::post('/store', ['as' => 'proxy.store', 'uses' => 'ProxyController@store']);
    Route::get('/edit/{id}', ['as' => 'proxy.edit', 'uses' => 'ProxyController@edit']);
    Route::post('/update/{id}', ['as' => 'proxy.update', 'uses' => 'ProxyController@update']);
    Route::any('/delete', ['as' => 'proxy.batch.delete', 'uses' => 'ProxyController@delete']);
});
Route::group(['middleware' => ['auth'], 'prefix' => 'sitespell', 'permission' => ['setting']], function () {
    Route::get('/index', ['as' => 'sitespell.list', 'uses' => 'SiteSpellController@index']);
    Route::get('/create', ['as' => 'sitespell.create', 'uses' => 'SiteSpellController@create']);
    Route::post('/store', ['as' => 'sitespell.store', 'uses' => 'SiteSpellController@store']);
    Route::get('/edit/{id}', ['as' => 'sitespell.edit', 'uses' => 'SiteSpellController@edit']);
    Route::post('/update/{id}', ['as' => 'sitespell.update', 'uses' => 'SiteSpellController@update']);
    Route::any('/delete', ['as' => 'sitespell.batch.delete', 'uses' => 'SiteSpellController@delete']);
});
