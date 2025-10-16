<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', action: [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('permission:profile,can_view');
        Route::post('/settings/update', [ProfileController::class, 'updateProfile'])->name('settings.update')->middleware('permission:profile,can_edit');
        Route::post('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password')->middleware('permission:profile,can_edit');

        //news
        Route::middleware(['role.superadmin'])->group(function () {            
            // roles & permissions
            Route::get('role-permissions', [RolePermissionController::class, 'index'])->name('role-permissions')->middleware('permission:permissions,can_view');
            Route::post('role-permission-form', [RolePermissionController::class, 'rolePermissionForm'])->name('role-permission-form')->middleware('permission:permissions,can_add');
            Route::post('update-role-permission', [RolePermissionController::class, 'update'])->name('update-role-permission')->middleware('permission:permissions,can_add');
            Route::get('role/{id}/permissions', [RolePermissionController::class, 'getPermissions'])->name('role.get-permissions')->middleware('permission:permissions,can_view');
            
            // user permissions
            Route::post('user-permission-form', [UserController::class, 'userPermissionForm'])->name('user-permission-form')->middleware('permission:permissions,can_add');
            Route::post('update-user-permission', [UserController::class, 'updatePermission'])->name('update-user-permission')->middleware('permission:permissions,can_add');
            
        });
        
        // Users Module
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class,'index'])->name('index')->middleware('permission:users,can_view');
            Route::any('/list', [App\Http\Controllers\UserController::class,'list'])->name('list')->middleware('permission:users,can_view'); // Ajax JSON
            Route::post('/form', [App\Http\Controllers\UserController::class,'form'])->name('form')->middleware('permission:users,can_add');
            Route::post('/save', [App\Http\Controllers\UserController::class,'save'])->name('save')->middleware('permission:users,can_add');
            Route::post('/toggle-status/{id}', [App\Http\Controllers\UserController::class,'toggleStatus'])->name('toggle-status')->middleware('permission:users,can_edit');
            Route::any('/duri: elete/{id}', [App\Http\Controllers\UserController::class,'destroy'])->name('delete')->middleware('permission:users,can_edit');
        });

        //customer module
        Route::middleware(['permission:customers,can_view'])->group(function () {
            Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
                Route::get('/', [CustomerController::class, 'index'])->name('index');
                Route::any('/list', [CustomerController::class, 'list'])->name('list');
                Route::get('/create', [CustomerController::class, 'create'])->name('create')->middleware('permission:customers,can_add');
                Route::post('/store', [CustomerController::class, 'store'])->name('store')->middleware('permission:customers,can_add');
                Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit')->middleware('permission:customers,can_edit');
                Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update')->middleware('permission:customers,can_edit');
                Route::post('/toggle-status/{id}', [CustomerController::class, 'toggleStatus'])->name('toggle-status')->middleware('permission:customers,can_edit');
                Route::post('/toggle-dashboard/{id}', [CustomerController::class, 'toggleDashboard'])->name('toggle-dashboard')->middleware('permission:customers,can_edit');
                // Customer form load (Add / Edit)
                Route::post('form', [CustomerController::class, 'form'])->name('form')->middleware('permission:customers,can_edit');

                // Customer save (Add / Edit)
                Route::post('save', [CustomerController::class, 'save'])->name('save')->middleware('permission:customers,can_edit');

                Route::any('/view', [CustomerController::class, 'view'])->name('view')->middleware('permission:customers,can_view');

                // download customers list
                Route::any('/download-customers', [CustomerController::class, 'downloadCustomers'])->name('download-customers')->middleware('permission:customers,can_view');

            });
        });

        //Branches module
        Route::prefix('branches')->group(function () {
            Route::get('/', [BranchController::class, 'index'])->name('branches.index');
            Route::get('/list', [BranchController::class, 'list'])->name('branches.list');
            Route::post('/form', [BranchController::class, 'form'])->name('branches.form');
            Route::post('/save', [BranchController::class, 'save'])->name('branches.save');
            Route::delete('/{id}', [BranchController::class, 'delete'])->name('branches.delete');
        });
        
        // Products module
        Route::middleware(['permission:products,can_view'])->group(function () {
            Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::any('/list', [ProductController::class, 'list'])->name('list');
                Route::any('/form', [ProductController::class, 'form'])->name('form');
                Route::post('/save', [ProductController::class, 'save'])->name('save');
                Route::post('/view', [ProductController::class, 'view'])->name('view');
                Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
                Route::post('/toggle-status/{id}', [ProductController::class, 'toggleStatus'])->name('toggleStatus');
                Route::post('/toggle-featured/{id}', [ProductController::class, 'toggleFeatured'])->name('toggleFeatured');

                // Product Categories CRUD routes
                Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
                    Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
                    Route::get('list', [ProductCategoryController::class, 'list'])->name('list');
                    Route::get('form', [ProductCategoryController::class, 'form'])->name('form');
                    Route::post('store', [ProductCategoryController::class, 'store'])->name('store');
                    Route::put('{id}', [ProductCategoryController::class, 'update'])->name('update');
                    Route::delete('{id}', [ProductCategoryController::class, 'destroy'])->name('destroy');
                    Route::any('toggle-status/{id}', [ProductCategoryController::class, 'toggleStatus'])->name('toggleStatus');
                });

                // Product Brands CRUD routes
                Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
                    Route::get('/', [ProductBrandController::class, 'index'])->name('index');
                    Route::get('list', [ProductBrandController::class, 'list'])->name('list');
                    Route::get('form', [ProductBrandController::class, 'form'])->name('form');
                    Route::post('store', [ProductBrandController::class, 'store'])->name('store');
                    Route::put('{id}', [ProductBrandController::class, 'update'])->name('update');
                    Route::delete('{id}', [ProductBrandController::class, 'destroy'])->name('destroy');
                    Route::any('toggle-status/{id}', [ProductBrandController::class, 'toggleStatus'])->name('toggleStatus');
                });
            });
        });
    });
    
});

//Frontend

Route::get('/homepage', [FrontendController::class, 'home'])->name('homepage');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/shops', [FrontendController::class, 'shops'])->name('shops');