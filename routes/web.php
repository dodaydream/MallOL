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

Route::get('/', function () {
    return view('index');
});

Route::get('/product/{product}',                               'ProductController@show')->name('show-prod');

Route::get('/products',                               'ProductController@index')->name('list-prod');


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('products')->name('products/')->group(static function() {
            Route::get('/',                                             'ProductsController@index')->name('index');
            Route::get('/create',                                       'ProductsController@create')->name('create');
            Route::post('/',                                            'ProductsController@store')->name('store');
            Route::get('/{product}/edit',                               'ProductsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ProductsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{product}',                                   'ProductsController@update')->name('update');
            Route::delete('/{product}',                                 'ProductsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('categories')->name('categories/')->group(static function() {
            Route::get('/',                                             'CategoriesController@index')->name('index');
            Route::get('/create',                                       'CategoriesController@create')->name('create');
            Route::post('/',                                            'CategoriesController@store')->name('store');
            Route::get('/{category}/edit',                              'CategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}',                                  'CategoriesController@update')->name('update');
            Route::delete('/{category}',                                'CategoriesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('brands')->name('brands/')->group(static function() {
            Route::get('/',                                             'BrandsController@index')->name('index');
            Route::get('/create',                                       'BrandsController@create')->name('create');
            Route::post('/',                                            'BrandsController@store')->name('store');
            Route::get('/{brand}/edit',                                 'BrandsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BrandsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{brand}',                                     'BrandsController@update')->name('update');
            Route::delete('/{brand}',                                   'BrandsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('inventories')->name('inventories/')->group(static function() {
            Route::get('/',                                             'InventoriesController@index')->name('index');
            Route::get('/create',                                       'InventoriesController@create')->name('create');
            Route::post('/',                                            'InventoriesController@store')->name('store');
            Route::get('/{inventory}/edit',                             'InventoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'InventoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{inventory}',                                 'InventoriesController@update')->name('update');
            Route::delete('/{inventory}',                               'InventoriesController@destroy')->name('destroy');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('carts')->name('carts/')->group(static function() {
    Route::get('/',                                             'CartsController@index')->name('index');
    Route::get('/create',                                       'CartsController@create')->name('create');
    Route::post('/',                                            'CartsController@store')->name('store');
    Route::get('/{cart}/edit',                                  'CartsController@edit')->name('edit');
    Route::post('/bulk-destroy',                                'CartsController@bulkDestroy')->name('bulk-destroy');
    Route::post('/{cart}',                                      'CartsController@update')->name('update');
    Route::delete('/{cart}',                                    'CartsController@destroy')->name('destroy');
});

Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');

Route::post('/checkout_success', 'CheckoutController@checkout_success')->name('checkout_success');

Route::get('/orders',                                             'Admin\OrdersController@indexUser')->name('orders');
Route::get('/order/{order}',                                 'Admin\OrdersController@userShow')->name('order/show');


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('users')->name('users/')->group(static function() {
            Route::get('/',                                             'UsersController@index')->name('index');
            Route::get('/create',                                       'UsersController@create')->name('create');
            Route::post('/',                                            'UsersController@store')->name('store');
            Route::get('/{user}/edit',                                  'UsersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}',                                      'UsersController@update')->name('update');
            Route::delete('/{user}',                                    'UsersController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('order-items')->name('order-items/')->group(static function() {
            Route::get('/',                                             'OrderItemsController@index')->name('index');
            Route::get('/create',                                       'OrderItemsController@create')->name('create');
            Route::post('/',                                            'OrderItemsController@store')->name('store');
            Route::get('/{orderItem}/edit',                             'OrderItemsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'OrderItemsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{orderItem}',                                 'OrderItemsController@update')->name('update');
            Route::delete('/{orderItem}',                               'OrderItemsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('orders')->name('orders/')->group(static function() {
            Route::get('/',                                             'OrdersController@index')->name('index');
            Route::get('/create',                                       'OrdersController@create')->name('create');
            Route::get('/{order}',                                 'OrdersController@show')->name('show');
            Route::post('/',                                            'OrdersController@store')->name('store');
            Route::get('/{order}/edit',                                 'OrdersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'OrdersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{order}',                                     'OrdersController@update')->name('update');
            Route::delete('/{order}',                                   'OrdersController@destroy')->name('destroy');
        });
    });
});
