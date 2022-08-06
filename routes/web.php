<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setup\Install;
use App\Http\Controllers\Socialite\Google;
use App\Http\Controllers\Socialite\Facebook;
use App\Http\Controllers\Welcome;
use App\Http\Controllers\User\HomeController as Home;
use App\Http\Controllers\User\ProfileController as Profile;
use App\Http\Controllers\User\TicketController as Ticket;
use App\Http\Controllers\User\AddressController as Address;
use App\Http\Controllers\User\AccountController as Account;
// data controller
use App\Http\Controllers\HotelGetController as HotelDataFrontedController;
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
// welcome controller route
Route::permanentRedirect('/','/login');
// Route::get('/',[Welcome::class, 'index']);
Route::get('about-us',[Welcome::class, 'about'])->name('about-us');
// hotel url
Route::get('hotel',[Welcome::class, 'hotelFunction'])->name('hotel');
Route::get('hotel-inner/{slug}',[Welcome::class, 'hotel_inner_Function'])->name('hotel-inner');
Route::get('hotel-inner/get/details',[HotelDataFrontedController::class, 'getResultHotelInner'])->name('hotel-inner.hotels.details-get');
// book now url
Route::get('Book-Now',[Welcome::class, 'Book_Now_Function'])->name('Book-Now');
Route::get('hotel-list',[Welcome::class, 'hotel_list_function'])->name('hotel-list'); 
Route::get('country/hotels/get', [HotelDataFrontedController::class, 'getHotelsCountry'])->name('country.hotels.get'); 
Route::post('country/get/zones/{id}', [HotelDataFrontedController::class, 'getHotelsZones']); 

Route::get('member',[Welcome::class, 'member_Function'])->name('member'); 

// setup route
Route::prefix('setup')->group(function(){
    Route::get('install',[Install::class, 'setupRun'])->name('setup.install');
    Route::get('finish',[Install::class, 'setupFinsihLast'])->name('setup.finish');
    Route::post('finshing/installing',[Install::class, 'setupInstallFunctionPage'])->name('setup.finshing.installing');
    Route::post('register',[Install::class, 'createUserAdmin'])->name('setup.register');
});
if(config('settings.facebook_module_status')):
// facebook login routes;
Route::get('login/facebook', [Facebook::class, 'redirectToProvider'])->name('login.facebook');
Route::get('login/facebook/callback', [Facebook::class, 'handleProviderCallback']);
endif;
if(config('settings.google_module_status')):
// google login;
Route::get('login/google', [Google::class, 'redirectToProviderGoogle'])->name('login.google');
Route::get('login/google/callback', [Google::class, 'handleProviderCallbackGoogle']);
endif;
// Main Routes;
// get auth verified by users;
Auth::routes(['verify' => true]);
// dashboard
Route::get('/home', [Home::class, 'index'])->name('home');
    Route::group(['middleware' => ['auth','profilecomplete'],'prefix'=>'home'],function(){    
        if(config('settings.config_profile_edit') || config('settings.config_password_edit') || config('settings.config_two_way_authentication') || config('settings.config_other_devices')):
            // Profile Routes;    
            Route::get('profile', [Profile::class, 'profilePageFunction'])->name('home.profile');
            if(config('settings.config_profile_edit')):
                Route::post('profile/update', [Profile::class, 'profile_updateFunction'])->name('profile.update');
                Route::get('delete-photo', [Profile::class, 'deletePhotoFunction'])->name('delete-photo');    
            endif;
            if(config('settings.config_password_edit')):
                // password edit
                Route::post('profile/password-change', [Profile::class, 'passwordUpdateEdit'])->name('profile.password.edit');
            endif;
        endif;

        if(config('settings.config_ticket_support_panel')):
            // support route
            Route::get('support', [Ticket::class, 'supportForm'])->name('home.support');
            Route::get('ticket/add', [Ticket::class, 'supportFormAddTicket'])->name('home.support.add');
            Route::post('ticket/send', [Ticket::class, 'supportFormAddTicketRequest'])->name('home.ticket.add');
            Route::get('support/ticket/{ticket}', [Ticket::class, 'supportTicketChatFunction'])->name('home.support.ticket')->where(['ticket' => '[0-9]+']);
            Route::post('ticket/replies', [Ticket::class, 'supportRequestReplyFunction'])->name('home.ticket.replies');
        endif;
        // Notifications routes
        Route::post('clear-all', [Home::class, 'MarkAsReadFunction'])->name('home.mark-read-all');
        // hotel routes
    
        // account route;
        Route::get('account', [Account::class, 'accountForm'])->name('home.accounts');
        Route::get('account/add', [Account::class, 'accountAddForm'])->name('home.account.add');
        Route::post('account_add', [Account::class, 'account_add_function'])->name('home.account_add');
        Route::post('account-default', [Account::class, 'setDefaultAccount'])->name('home.default_set');
        Route::get('delete_account', [Account::class, 'deleteAccountData'])->name('home.delete');
    
        // address route;
        Route::get('address', [Address::class, 'addressForm'])->name('home.address');
        Route::get('address/add', [Address::class, 'addressAddForm'])->name('home.address.add');
        Route::post('address_add', [Address::class, 'address_add_function'])->name('home.address_add');
        Route::post('address-default', [Address::class, 'setDefaultAddress'])->name('home.default_addr');
        Route::get('delete_address', [Address::class, 'deleteAddressData'])->name('home.delete_add'); 

});
