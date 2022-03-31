<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;

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

// Route::get('/', function () {
//     return view('first-page'); 
// });
// Route::get('/', function () {
//     return view('dashboard'); 
// });
// Route::get('/categories', function () {
//     return view('categories'); 
// });
// Route::get('/contact-us', function () {
//     return view('contact-us'); 
// });
// Route::get('/first-page', function () {
//     return view('first-page'); 
// });

Auth::routes();

//diffrent from resouce

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/first_page', [App\Http\Controllers\HomeController::class, 'first_page']);
Route::get('/second_page', [App\Http\Controllers\HomeController::class, 'second_page']);

//contact-us
Route::get('/contact-us', [App\Http\Controllers\contactUsController::class, 'index'])->name('contact-us');

//checkout
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout.index');
Route::PUT('/checkout-payment', [App\Http\Controllers\HomeController::class, 'payment'])->name('checkout.payment');

//coupon
Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupon.index');
Route::get('/coupons/create', [App\Http\Controllers\CouponController::class, 'create'])->name('coupons.create');
Route::post('/coupons', [App\Http\Controllers\CouponController::class, 'store'])->name('coupon.store');

//Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// dashboardController
Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
// Route::get('/list-product', [dashboardController::class, 'listproduct']);
Route::get('/dashboard/status/update', [dashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');

// Profile
Route::get('/profile/index', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/profile/view', [App\Http\Controllers\ProfileController::class, 'view']);

Route::get('/my-order', [App\Http\Controllers\MyOrderController::class, 'index']);



Route::get('/order-received', [App\Http\Controllers\OrderReceivedController::class, 'index']);
Route::get('/order-received/update/{id}', [App\Http\Controllers\OrderReceivedController::class, 'prepareOrder'])->name('order-received.prepareOrder');
Route::get('/order-received/rejectOrder/{id}', [App\Http\Controllers\OrderReceivedController::class, 'rejectOrder'])->name('order-received.rejectOrder');
Route::get('/order-received/update-pickup-ready/{id}', [App\Http\Controllers\OrderReceivedController::class, 'pickupReady'])->name('order-received.pickupReady');



Route::get('/my-job', [App\Http\Controllers\MyJobController::class, 'index']);
Route::get('/my-job/update-accept-job/{id}', [App\Http\Controllers\MyJobController::class, 'acceptJobs'])->name('my-jobs.acceptJobs');
// Route::get('/my-job/update-reject-job/{id}', [App\Http\Controllers\MyJobController::class, 'rejectJobs'])->name('my-jobs.rejectJobs');
Route::get('/my-job/update-rider-pickup/{id}', [App\Http\Controllers\MyJobController::class, 'riderPickup'])->name('my-jobs.riderPickup');
Route::get('/my-job/update-item-delivered/{id}', [App\Http\Controllers\MyJobController::class, 'itemDelivered'])->name('my-jobs.itemDelivered');


//myaddresss
Route::get('/my-address', [App\Http\Controllers\MyAddressController::class, 'index'])->name('my-address.index');
Route::get('/my-address/create', [App\Http\Controllers\MyAddressController::class, 'create'])->name('my-address.create');
Route::get('/my-address/edit/{id}', [App\Http\Controllers\MyAddressController::class, 'update'])->name('my-address.update');
Route::post('/my-address', [App\Http\Controllers\MyAddressController::class, 'store'])->name('my-address.store');
Route::GET('/my-address/update-default', [App\Http\Controllers\MyAddressController::class, 'updateDefault'])->name('my-address.updateDefault');


// -----------------------------------------------------------------------Members-----------------------------------------------------------------------
// Admin Members
Route::get('/admin-members', [App\Http\Controllers\AdminMembersController::class, 'index']);
Route::get('/admin-members/view/{id}', [App\Http\Controllers\AdminMembersController::class, 'view'])->name('admin-members.view');
Route::get('/admin-members/edit/{id}', [App\Http\Controllers\AdminMembersController::class, 'edit'])->name('admin-members.edit');
Route::PUT('/admin-members/update/{id}', [App\Http\Controllers\AdminMembersController::class, 'update'])->name('admin-members.update');
Route::PUT('/admin-members/upload/{id}', [App\Http\Controllers\AdminMembersController::class, 'upload'])->name('admin-members.upload');

// Restaurants Members
Route::get('/restaurants-members', [App\Http\Controllers\RestaurantsMembersController::class, 'index']);

// Riders Members
Route::get('/riders-members', [App\Http\Controllers\RidersMembersController::class, 'index']);

// Users Members
Route::get('/users-members', [App\Http\Controllers\UsersMembersController::class, 'index']);

//-----------------------------------------------------------------Permission Management-----------------------------------------------------------------
Route::get('/permission-management', [App\Http\Controllers\PermissionManagementController::class, 'index']);
Route::get('/permission-management/show/{id}', [App\Http\Controllers\PermissionManagementController::class, 'show'])->name('permission-management.show');
Route::get('/permission-management/edit/{id}', [App\Http\Controllers\PermissionManagementController::class, 'edit'])->name('permission-management.edit');

//Roles
Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index']);
Route::get('/roles/create', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.create');
Route::post('/roles', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
Route::get('/roles/show/{id}', [App\Http\Controllers\RolesController::class, 'show'])->name('roles.show');
Route::get('/roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
Route::put('/roles/update/{id}', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
Route::get('/roles/destroy/{id}', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.destroy');

//Permissions
Route::get('/permissions', [App\Http\Controllers\PermissionsController::class, 'index']);
Route::get('/permissions/create', [App\Http\Controllers\PermissionsController::class, 'create'])->name('permissions.create');
Route::post('/permissions', [App\Http\Controllers\PermissionsController::class, 'store'])->name('permissions.store');
Route::get('/permissions/show/{id}', [App\Http\Controllers\PermissionsController::class, 'show'])->name('permissions.show');
Route::get('/permissions/edit/{id}', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/update/{id}', [App\Http\Controllers\PermissionsController::class, 'update'])->name('permissions.update');
Route::get('/permissions/destroy/{id}', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('permissions.destroy');

//Members
Route::get('/members', [App\Http\Controllers\MembersController::class, 'index']);

//-----------------------------------------------------------------User-----------------------------------------------------------------
//Approved
Route::get('/approved-users', [App\Http\Controllers\ApprovedUsersController::class, 'index']);
Route::get('/approved-users/show/{id}', [App\Http\Controllers\ApprovedUsersController::class, 'show'])->name('approved-users.show');
Route::get('/approved-users/edit/{id}', [App\Http\Controllers\ApprovedUsersController::class, 'edit'])->name('approved-users.edit');
Route::put('/approved-users/update/{id}', [App\Http\Controllers\ApprovedUsersController::class, 'update'])->name('approved-users.update');
Route::get('/approved-users/destroy/{id}', [App\Http\Controllers\ApprovedUsersController::class, 'destroy'])->name('approved-users.destroy');

//Pending
Route::get('/pending-users', [App\Http\Controllers\PendingUsersController::class, 'index']);
Route::get('/pending-users/show/{id}', [App\Http\Controllers\PendingUsersController::class, 'show'])->name('pending-users.show');
Route::get('/pending-users/edit/{id}', [App\Http\Controllers\PendingUsersController::class, 'edit'])->name('pending-users.edit');
Route::put('/pending-users/update/{id}', [App\Http\Controllers\PendingUsersController::class, 'update'])->name('pending-users.update');
Route::get('/pending-users/destroy/{id}', [App\Http\Controllers\PendingUsersController::class, 'destroy'])->name('pending-users.destroy');
Route::get('/pending-users/approved/{id}', [App\Http\Controllers\PendingUsersController::class, 'approved'])->name('pending-users.approved');
Route::get('/pending-users/rejected/{id}', [App\Http\Controllers\PendingUsersController::class, 'rejected'])->name('pending-users.rejected');

//Rejected
Route::get('/rejected-users', [App\Http\Controllers\RejectedUsersController::class, 'index']);
Route::get('/rejected-users/show/{id}', [App\Http\Controllers\RejectedUsersController::class, 'show'])->name('rejected-users.show');
Route::get('/rejected-users/edit/{id}', [App\Http\Controllers\RejectedUsersController::class, 'edit'])->name('rejected-users.edit');
Route::put('/rejected-users/update/{id}', [App\Http\Controllers\RejectedUsersController::class, 'update'])->name('rejected-users.update');
Route::get('/rejected-users/destroy/{id}', [App\Http\Controllers\RejectedUsersController::class, 'destroy'])->name('rejected-users.destroy');
Route::get('/rejected-users/reapproved/{id}', [App\Http\Controllers\RejectedUsersController::class, 'reapproved'])->name('rejected-users.reapproved');

//All Users
Route::get('/all-users', [App\Http\Controllers\AllUsersController::class, 'index']);
Route::get('/all-users/show/{id}', [App\Http\Controllers\AllUsersController::class, 'show'])->name('all-users.show');
Route::get('/all-users/edit/{id}', [App\Http\Controllers\AllUsersController::class, 'edit'])->name('all-users.edit');
Route::put('/all-users/update/{id}', [App\Http\Controllers\AllUsersController::class, 'update'])->name('all-users.update');
Route::get('/all-users/destroy/{id}', [App\Http\Controllers\AllUsersController::class, 'destroy'])->name('all-users.destroy');
Route::get('/all-users/approved/{id}', [App\Http\Controllers\AllUsersController::class, 'approved'])->name('all-users.approved');
Route::get('/all-users/rejected/{id}', [App\Http\Controllers\AllUsersController::class, 'rejected'])->name('all-users.rejected');

//Block Users
Route::get('/block-users', [App\Http\Controllers\BlockUsersController::class, 'index']);
Route::get('/block-users/show/{id}', [App\Http\Controllers\BlockUsersController::class, 'show'])->name('block-users.show');
Route::get('/block-users/edit/{id}', [App\Http\Controllers\BlockUsersController::class, 'edit'])->name('block-users.edit');
Route::put('/block-users/update/{id}', [App\Http\Controllers\BlockUsersController::class, 'update'])->name('block-users.update');
Route::get('/block-users/destroy/{id}', [App\Http\Controllers\BlockUsersController::class, 'destroy'])->name('block-users.destroy');
Route::get('/rejected-users/undoblock/{id}', [App\Http\Controllers\BlockUsersController::class, 'undoblock'])->name('block-users.undoblock');

//-----------------------------------------------------------------Merchant-----------------------------------------------------------------
//Approved
Route::get('/approved-merchants', [App\Http\Controllers\ApprovedMerchantsController::class, 'index']);
Route::get('/approved-merchants/show/{id}', [App\Http\Controllers\ApprovedMerchantsController::class, 'show'])->name('approved-merchants.show');
Route::get('/approved-merchants/edit/{id}', [App\Http\Controllers\ApprovedMerchantsController::class, 'edit'])->name('approved-merchants.edit');
Route::put('/approved-merchants/update/{id}', [App\Http\Controllers\ApprovedMerchantsController::class, 'update'])->name('approved-merchants.update');
Route::get('/approved-merchants/destroy/{id}', [App\Http\Controllers\ApprovedMerchantsController::class, 'destroy'])->name('approved-merchants.destroy');

//Pending
Route::get('/pending-merchants', [App\Http\Controllers\PendingMerchantsController::class, 'index']);
Route::get('/pending-merchants/show/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'show'])->name('pending-merchants.show');
Route::get('/pending-merchants/edit/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'edit'])->name('pending-merchants.edit');
Route::put('/pending-merchants/update/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'update'])->name('pending-merchants.update');
Route::get('/pending-merchants/destroy/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'destroy'])->name('pending-merchants.destroy');
Route::get('/pending-merchants/approved/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'approved'])->name('pending-merchants.approved');
Route::get('/pending-merchants/rejected/{id}', [App\Http\Controllers\PendingMerchantsController::class, 'rejected'])->name('pending-merchants.rejected');

//Rejected
Route::get('/rejected-merchants', [App\Http\Controllers\RejectedMerchantsController::class, 'index']);
Route::get('/rejected-merchants/show/{id}', [App\Http\Controllers\RejectedMerchantsController::class, 'show'])->name('rejected-merchants.show');
Route::get('/rejected-merchants/edit/{id}', [App\Http\Controllers\RejectedMerchantsController::class, 'edit'])->name('rejected-merchants.edit');
Route::put('/rejected-merchants/update/{id}', [App\Http\Controllers\RejectedMerchantsController::class, 'update'])->name('rejected-merchants.update');
Route::get('/rejected-merchants/destroy/{id}', [App\Http\Controllers\RejectedMerchantsController::class, 'destroy'])->name('rejected-merchants.destroy');
Route::get('/rejected-merchants/reapproved/{id}', [App\Http\Controllers\RejectedMerchantsController::class, 'reapproved'])->name('rejected-merchants.reapproved');

//-----------------------------------------------------------------Rider-----------------------------------------------------------------
//Approved
Route::get('/all-riders', [App\Http\Controllers\AllRidersController::class, 'index']);
Route::get('/all-riders/show/{id}', [App\Http\Controllers\AllRidersController::class, 'show'])->name('all-riders.show');
Route::get('/all-riders/edit/{id}', [App\Http\Controllers\AllRidersController::class, 'edit'])->name('all-riders.edit');
Route::put('/all-riders/update/{id}', [App\Http\Controllers\AllRidersController::class, 'update'])->name('all-riders.update');
Route::get('/all-riders/destroy/{id}', [App\Http\Controllers\AllRidersController::class, 'destroy'])->name('all-riders.destroy');
Route::get('/all-riders/document/{id}', [App\Http\Controllers\AllRidersController::class, 'document'])->name('all-riders.document');
Route::get('/all-riders/document/{id}/addDocument', [App\Http\Controllers\AllRidersController::class, 'addDocument'])->name('all-riders.addDocument');
Route::get('/all-riders/document/{id}/storedocument', [App\Http\Controllers\AllRidersController::class, 'storeDocument'])->name('all-riders.storeDocument');
Route::get('/all-riders/document/{id}/downloadDocument', [App\Http\Controllers\AllRidersController::class, 'downloadDocument'])->name('all-riders.downloadDocument');
Route::get('/all-riders/document/{id}/deleteDocument', [App\Http\Controllers\AllRidersController::class, 'deleteDocument'])->name('all-riders.deleteDocument');

//Pending
Route::get('/pending-riders', [App\Http\Controllers\PendingRidersController::class, 'index']);
Route::get('/pending-riders/show/{id}', [App\Http\Controllers\PendingRidersController::class, 'show'])->name('pending-riders.show');
Route::get('/pending-riders/edit/{id}', [App\Http\Controllers\PendingRidersController::class, 'edit'])->name('pending-riders.edit');
Route::put('/pending-riders/update/{id}', [App\Http\Controllers\PendingRidersController::class, 'update'])->name('pending-riders.update');
Route::get('/pending-riders/destroy/{id}', [App\Http\Controllers\PendingRidersController::class, 'destroy'])->name('pending-riders.destroy');
Route::get('/pending-riders/approved/{id}', [App\Http\Controllers\PendingRidersController::class, 'approved'])->name('pending-riders.approved');
Route::get('/pending-riders/rejected/{id}', [App\Http\Controllers\PendingRidersController::class, 'rejected'])->name('pending-riders.rejected');

//Rejected
Route::get('/rejected-riders', [App\Http\Controllers\RejectedRidersController::class, 'index']);
Route::get('/rejected-riders/show/{id}', [App\Http\Controllers\RejectedRidersController::class, 'show'])->name('rejected-riders.show');
Route::get('/rejected-riders/edit/{id}', [App\Http\Controllers\RejectedRidersController::class, 'edit'])->name('rejected-riders.edit');
Route::put('/rejected-riders/update/{id}', [App\Http\Controllers\RejectedRidersController::class, 'update'])->name('rejected-riders.update');
Route::get('/rejected-riders/destroy/{id}', [App\Http\Controllers\RejectedRidersController::class, 'destroy'])->name('rejected-riders.destroy');
Route::get('/rejected-riders/reapproved/{id}', [App\Http\Controllers\RejectedRidersController::class, 'reapproved'])->name('rejected-riders.reapproved');

//-----------------------------------------------------------------Menu-----------------------------------------------------------------
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('/menu/create', [App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
Route::post('/menu', [App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/approved', [App\Http\Controllers\MenuController::class, 'approved'])->name('menu.approved');
Route::get('/menu/rejected', [App\Http\Controllers\MenuController::class, 'rejected'])->name('menu.rejected');
Route::get('/menu/destroy', [App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
Route::get('/menu/show/{id}', [App\Http\Controllers\MenuController::class, 'show'])->name('menu.show');
Route::get('/menu/edit/{id}', [App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
Route::PUT('/menu/update/{id}', [App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
Route::PUT('/menu/upload/{id}', [App\Http\Controllers\MenuController::class, 'upload'])->name('menu.upload');
Route::get('/approved-menu', [App\Http\Controllers\MenuController::class, 'approvedMenu']);
Route::get('/rejected-menu', [App\Http\Controllers\MenuController::class, 'rejectedMenu']);
Route::get('/rejected-menu/reapproved', [App\Http\Controllers\MenuController::class, 'reapproved'])->name('rejected-menu.reapproved');

//-----------------------------------------------------------------Zone Menagement-----------------------------------------------------------------
Route::get('/zone-menagement', [App\Http\Controllers\ZoneMenagementController::class, 'index']);
Route::get('/zone-menagement/create', [App\Http\Controllers\ZoneMenagementController::class, 'create'])->name('zone-menagement.create');
Route::get('/zone-menagement/show/{id}', [App\Http\Controllers\ZoneMenagementController::class, 'show'])->name('zone-menagement.show');
Route::post('/zone-menagement', [App\Http\Controllers\ZoneMenagementController::class, 'store'])->name('zone-menagement.store');
Route::get('/zone-menagement/destroy', [App\Http\Controllers\ZoneMenagementController::class, 'destroy'])->name('zone-menagement.destroy');
Route::get('/zone-menagement/edit/{id}', [App\Http\Controllers\ZoneMenagementController::class, 'edit'])->name('zone-menagement.edit');
Route::PUT('/zone-menagement/update/{id}', [App\Http\Controllers\ZoneMenagementController::class, 'update'])->name('zone-menagement.update');

Route::get('/zone-menagement/approved', [App\Http\Controllers\ZoneMenagementController::class, 'approved'])->name('zone-menagement.approved');
Route::get('/zone-menagement/rejected', [App\Http\Controllers\ZoneMenagementController::class, 'rejected'])->name('zone-menagement.rejected');

//-----------------------------------------------------------------Zone Menagement-----------------------------------------------------------------
Route::get('/my-menu', [App\Http\Controllers\MyMenuController::class, 'index']);
Route::get('/my-menu/create', [App\Http\Controllers\MyMenuController::class, 'create'])->name('my-menu.create');
Route::post('/my-menu', [App\Http\Controllers\MyMenuController::class, 'store'])->name('my-menu.store');
Route::get('/my-menu/viewMenu/{id}', [App\Http\Controllers\MyMenuController::class, 'viewMenu'])->name('my-menu.viewMenu');
Route::get('/my-menu/show/{id}', [App\Http\Controllers\MyMenuController::class, 'show'])->name('my-menu.show');
Route::get('/my-menu/edit/{id}', [App\Http\Controllers\MyMenuController::class, 'edit'])->name('my-menu.edit');
Route::PUT('/my-menu/update/{id}', [App\Http\Controllers\MyMenuController::class, 'update'])->name('my-menu.update');

Route::get('add-to-cart/{id}', [App\Http\Controllers\MyMenuController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart', [App\Http\Controllers\MyMenuController::class, 'cart'])->name('my-menu.cart');
Route::patch('update-cart', [App\Http\Controllers\MyMenuController::class, 'updateCart'])->name('updateCart.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\MyMenuController::class, 'removeCart'])->name('remove.from.cart');

//-----------------------------------------------------------------Invoice-----------------------------------------------------------------
Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index']);

Route::group(['middleware' => ['guest']], function() {
});

Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/email', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('send.email');