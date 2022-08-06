<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as HomeController;
use App\Http\Controllers\Admin\SettingController as Setting;
use App\Http\Controllers\Admin\ProfileController as Profile;
use App\Http\Controllers\Admin\TicketController as Ticket;
use App\Http\Controllers\Admin\UsersController as Users;
use App\Http\Controllers\Admin\CategoryController as Category;
use App\Http\Controllers\Admin\Hotel\HotelController as Hotel;
use App\Http\Controllers\Admin\Hotel\RoomController as Room;
use App\Http\Controllers\Admin\Hotel\FacilitiesController as Facilities;
use App\Http\Controllers\Admin\Hotel\OptionalFacilitiesController as OptionalFacilities;
use App\Http\Controllers\Admin\extension\module\Facebook;
use App\Http\Controllers\Admin\extension\module\Google;
use App\Http\Controllers\Admin\extension\module\Ticket as TicketConfiguration;
use App\Http\Controllers\Admin\Hotel\CustomerReviewsController;
use App\Http\Controllers\Admin\Chat\ChatBoatController as ChatBoat;

// Dashboard
    Route::group(['middleware' => ['admin.verified','admin.auth']],function(){   
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('users', [Users::class, 'clientsTable'])->name('client');
   
    //category
    Route::get('category', [Category::class, 'index'])->name('category');
    Route::get('category/add', [Category::class, 'AddCeteroy_Function'])->name('category.add');
    Route::get('category/autocomplete', [Category::class, 'CatgoryAutocomplete'])->name('category.autocomplete');
    Route::post('category_add', [Category::class, 'categoryAddFunction'])->name('category_add');
    Route::get('category/edit/{edit}', [Category::class, 'editCategoryFunction'])->name('category.edit')->where(['edit' => '[0-9]+']);
    Route::post('category/delete', [Category::class, 'categoryDeleteFunction'])->name('category.delete');

    // Hotel routes
    Route::get('hotels', [Hotel::class, 'index'])->name('hotel.list');
    Route::get('hotel/add/form', [Hotel::class, 'hotelAddForm'])->name('hotel.add.form');
    Route::post('hotel/add', [Hotel::class, 'hotelAdd'])->name('hotel.add');

    Route::get('hotel/customer/autocomplate', [Hotel::class, 'autocompleteFunction'])->name('hotel.customer.autocomplate');
    Route::post('hotel/get-country-citys-list', [Hotel::class, 'getListOfCitys'])->name('hotel.get-country-citys');    
    
    Route::get('hotel/edit/form/{id}', [Hotel::class, 'hotelEditForm'])->name('hotel.edit.form');
    Route::post('hotel/fetch/hotel-edit', [Hotel::class, 'HotelFetchEditForm'])->name('hotel.fetch.hotel-edit');
    Route::post('hotel/edit', [Hotel::class, 'hotelEdit'])->name('hotel.edit');

    // Hotel Room routes
    Route::get('hotel/room/list', [Room::class, 'index'])->name('hotel.room');
    Route::get('hotel/form/room', [Room::class, 'roomAddForm'])->name('hotel.room.form');
    Route::post('hotel/room/add', [Room::class, 'roomAddFunction'])->name('hotel.room.add');
    // angular get content;
    Route::post('hotel/room/get-content', [Room::class, 'getAutoloadData'])->name('hotel.room.get-content');
    Route::get('hotel/room/attribute/autocomplate', [Room::class, 'attributeAutocomplete'])->name('hotel.room.attribute.autocomplate');
    
    // customer reviews
    Route::get('hotel/customer/reviews', [CustomerReviewsController::class, 'index'])->name('hotel.customer.reviews');

    // hotel.facilities
    Route::get('hotel/facilities', [Facilities::class, 'index'])->name('hotel.facilities');
    Route::get('hotel/add/facilities/form', [Facilities::class, 'facilitiesFunction'])->name('hotel.facilities.add');
    Route::post('hotel/add/facilities', [Facilities::class, 'facilitiesFunctionAdd'])->name('hotel.facilities.add.form');
    Route::post('hotel/delete/facilities', [Facilities::class, 'facilitiesFunctionDelete'])->name('hotel.facilities.delete');

    // hotel.optional.facilities
    Route::get('hotel/optional', [OptionalFacilities::class, 'index'])->name('hotel.optional.facilities');
    Route::post('hotel/add/optional', [OptionalFacilities::class, 'optionalFacilitiesFunction'])->name('hotel.optional.facilities.add');
    Route::post('hotel/delete/optional', [OptionalFacilities::class, 'optionalFacilitiesDeleteFunction'])->name('hotel.optional.facilities.delete');
    // hotel.booking
    Route::get('hotel/booking', [Hotel::class, 'index'])->name('hotel.booking');

    // support route
    Route::get('ticket/lists', [Ticket::class, 'index'])->name('ticket');
    Route::get('ticket/view/{ticket}/{client}', [Ticket::class, 'supportTicketChatFunction'])->name('ticket.view')->where(['ticket' => '[0-9]+','client' =>'[0-9]+' ]);
    Route::post('ticket/replies', [Ticket::class, 'supportRequestReplyFunction'])->name('ticket.replies');
    Route::post('ticket/note', [Ticket::class, 'noteAddOnTicket'])->name('ticket.note');
    Route::post('ticket/update', [Ticket::class, 'ticketUpdateFunction'])->name('ticket.update');
    Route::post('ticket/related/{ticket}/{client}', [Ticket::class, 'getRelatedTicket'])->name('ticket.related')->where(['ticket' => '[0-9]+','client' =>'[0-9]+' ]);
    Route::get('ticket/assign/autocomplate', [Ticket::class, 'autocompleteFunction'])->name('ticket.assign.autocomplate');
    Route::post('ticket/assignee/user', [Ticket::class, 'changeAssigneeFunction'])->name('ticket.assignee.user');
    Route::post('ticket/get/assigne/list/{list}', [Ticket::class, 'getAssigneeListFunction']);
    Route::post('ticket/get/assigne/delete/{list}', [Ticket::class, 'removeAssigneesFunction']);
    // chatboat
    Route::get('chatboat', [ChatBoat::class, 'index'])->name('chat');
    Route::post('chat/getchatpersonslist',[ChatBoat::class,'getChatList'])->name('chat.getlist');
    Route::post('chat/send/data',[ChatBoat::class, 'chatSendFunction'])->name('chat.send');
    Route::post('chat/send/files',[ChatBoat::class, 'chatSendFilesFunction'])->name('chat.send.files');
    Route::post('chat/getData',[ChatBoat::class, 'chatGetdataUser'])->name('chat.getData');
    // Notifications routes
    Route::post('clear-all', [HomeController::class, 'MarkAsReadFunction'])->name('mark-read-all');
    
        // make chart;
        Route::post('chart', [HomeController::class, 'makeChartFunction'])->name('chart.create');
    
        // Profile Routres
        Route::get('profile', [Profile::class, 'profilePageFunction'])->name('profile');
        Route::post('profile/update', [Profile::class, 'profile_updateFunction'])->name('profile.update');
        Route::get('delete-photo', [Profile::class, 'deletePhotoFunction'])->name('delete-photo');
        Route::post('profile/password-change', [Profile::class, 'passwordUpdateEdit'])->name('profile.password.edit');

        // web setting;
        // Route::group(['middleware' => ['admin.password.confirm']],function(){    
        Route::get('web/env-editor', [Setting::class, 'UserPanelView'])->name('web.env');
        Route::get('web/config', [Setting::class, 'ConfigFunction'])->name('web.site');
        Route::get('web/edit', [Setting::class, 'SiteImageunction'])->name('web-edit');
        Route::get('web/route-manages', [Setting::class, 'routesPermissionFunction'])->name('web.routes');

        Route::get('web/error-logs', [Setting::class, 'settingFunction'])->name('web.error.logs');
        Route::get('web/env-logs', [Setting::class, 'settingFunctionEdit'])->name('web.setting');
        Route::post('web/envUpdate', [Setting::class, 'updateSettingFile'])->name('web.edit.env');
        Route::post('web/clear_error_log', [Setting::class, 'clearLogsFunction'])->name('web.clear_error_log');
        
        Route::post('web/logo', [Setting::class, 'logoChangeFUnction'])->name('logo');
        Route::post('web/favicon', [Setting::class, 'faviconChangeFUnction'])->name('favicon');
        
        Route::get('web/users-list', [Setting::class, 'getUserListFunction'])->name('web.users-list');
        
        Route::post('web/env/edit', [Setting::class, 'saveEnvFunction'])->name('web.panel.env.edit'); // env edit function
        
        Route::post('web/setting/edit', [Setting::class, 'saveSettingFunction'])->name('web.panel.setting.edit'); // setting edit function

        Route::get('web/get-panel-config', [Setting::class, 'UserPanel_config'])->name('web.get-panel-config');
        Route::get('web/config-update-request/{id}', [Setting::class, 'UserPanel_config_update'])->name('web.config-update');
        // setting
        Route::get('extension', [Setting::class, 'ConfigrationTable'])->name('web.setting.configration');
        
        // facebook mode
        Route::get('extension/module/facebook', [Facebook::class, 'index'])->name('extension.module.facebook');
        Route::post('extension/module/facebook/edit', [Facebook::class, 'edit'])->name('extension.module.facebook.edit');
        // google mod
        Route::get('extension/module/google', [Google::class, 'index'])->name('extension.module.google');
        Route::post('extension/module/google/edit', [Google::class, 'edit'])->name('extension.module.google.edit');
        // ticket
        Route::get('extension/module/ticket', [TicketConfiguration::class, 'index'])->name('extension.module.ticket');
        Route::post('extension/module/ticket/edit', [TicketConfiguration::class, 'edit'])->name('extension.module.ticket.edit');

        // user groups
        Route::get('setting/user-group', [Setting::class, 'permissionFunction'])->name('web.setting.permission');
        
        Route::get('setting/user-group/role/{role}/{name}', [Setting::class, 'permissions'])->name('web.setting.permission.roles')->where(['role' => '[0-9]+','name'=> '[a-z A-Z]+']);

        Route::post('usergroup/delete', [Setting::class, 'userGroupDeleteFunction'])->name('usergroup.delete');
        Route::get('create/user', [Setting::class, 'createUserFunction'])->name('create.user');
        Route::post('create/confirm/user', [Setting::class, 'createConfirmUserFunction'])->name('create.confirm.user');
        Route::post('web/permission/add', [Setting::class, 'permission_addFunction'])->name('web.permission.add');
        Route::get('setting/user-group/add/group', [Setting::class, 'roleAddFunction'])->name('web.role.add');
        Route::post('web/role/create', [Setting::class, 'roleCreateFunction'])->name('web.role.create');
        
        //cache clear
        Route::get('cache-clear', [Setting::class, 'cacheClear'])->name('cache-clear');
        Route::get('view-clear', [Setting::class, 'viewClear'])->name('view-clear');

        // delete route
        Route::get('/delete', [Setting::class, 'deletedataFunction'])->name('delete');
    // });
});

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
