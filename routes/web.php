<?php

use Illuminate\Support\Facades\Route;

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
// frontend
Route::get('/', 'WebController@homePage');

// Header menus routes
Route::get('/tech', 'WebController@techPage');
Route::get('/apparel', 'WebController@apparelPage');
Route::get('/sponsors', 'WebController@sponsorsPage');
Route::get('/races', 'WebController@racesPage');
Route::get('/charity', 'WebController@charityPage');
Route::get('/design-demo', 'WebController@designDemo');

// Footer menus routes
Route::get('/story', 'FooterPageController@storyPage');
Route::get('/contact', 'FooterPageController@contactPage');
Route::get('/press', 'FooterPageController@pressPage');
Route::get('/blog', 'FooterPageController@blogPage');
Route::get('/terms-privacy', 'FooterPageController@termsPrivacyPage');

Route::get('/sizing', 'FooterPageController@sizingPage');
Route::get('/group-orders', 'FooterPageController@groupOrdersPage');
Route::get('/Shipping-delivery', 'FooterPageController@ShippingDeliveryPage');

Route::get('/partnerships', 'FooterPageController@partnershipsPage');
Route::get('/social-responsibility', 'FooterPageController@socialResponsibilityPage');


// Add frontauth middleware to avoid access to login, join route after fully authenticated
Route::get('/login', 'WebController@loginPage')->middleware('frontauth')->name('login');
Route::get('/join', 'WebController@joinPage')->middleware('frontauth');

Route::post('login', 'WebController@doLogin')->name('dologin');

Route::get('/forgot-password', 'PasswordResetController@forgotPasswordPage');
Route::post('/forgot-password', 'PasswordResetController@forgotPassword');

Route::get('/reset-password/{token}/{email}', 'PasswordResetController@resetPasswordPage');
Route::post('/reset-password', 'PasswordResetController@resetPassword');
Route::post('/create-password-token', 'PasswordResetController@create');

Route::middleware(['auth'])->group(function() {
    Route::get('doLogout', 'WebController@doLogout')->name('doLogout');
    Route::get('/profile', 'WebController@profilePage');
    Route::get('/profile/edit-account', 'WebController@editAccountPage');
    Route::patch('profile/{id}', 'ProfileController@update');
    Route::get('doLogout', 'WebController@doLogout')->name('doLogout');
    Route::get('/admin/logout', 'WebController@doLogout');

    Route::get('/profile/permission', 'ProfileController@getPermission');
    Route::get('/profile/getPhoto', 'ProfileController@getPhoto');
    Route::post('/profile/editPhoto', 'ProfileController@editPhoto');
    Route::get('/profile/my-events', 'WebController@myEventsPage');
    Route::get('/profile/my-events/{id}', 'ProfileController@getEvents');
    Route::post('/profile/my-events', 'ProfileController@registerEvent');
    Route::get('/profile/my-designs', 'WebController@myDesignsPage');

    Route::get('/cart', 'CartController@index');

    Route::get('/profile/my-design', 'DesignController@myDesign');
    Route::post('/profile/my-design', 'DesignController@saveDesign');

    // Design
    Route::get('/design', 'DesignController@index');

    // charities
    Route::get('/charities', 'DesignController@getCharities');

    // Sponsors
    Route::get('/sponsor', 'DesignController@getSponsors');
    Route::get('/sponsor/{sponsor}', 'SponsorController@index')->name('sponsor.index')->middleware('slug_detect');
    Route::get('/sponsor/{id}/profile/edit', 'SponsorController@show');
    Route::put('/sponsor/{id}/profile/edit', 'SponsorController@update');
    Route::get('/sponsor/{id}/payment/history', 'PaymentController@paymentHistoryShow');
    Route::put('/sponsor/{id}/profile/updateCover', 'SponsorController@updateCover');
    Route::post('/sponsor/{id}/profile/updateProfilePicture', 'SponsorController@updateProfilePicture');
    Route::get('/sponsor/{id}/campaign', 'CampaignController@index');
    Route::get('/sponsor/{id}/campaign/list-json', 'CampaignController@list');
    Route::get('/sponsor/{id}/campaign/create', 'CampaignController@create');
    Route::get('/sponsor/{id}/campaign/{campaignId}/edit', 'CampaignController@edit');
    Route::post('/sponsor/{id}/campaign/save', 'CampaignController@createOrUpdate');
    Route::delete('/campaign/{id}', 'CampaignController@destroy');

    // Charities...
    Route::get('charity/{charity}/donation', 'CharityController@getDonations')->name('charities.donations.index');
    Route::get('charity/{charity}/order', 'CharityController@getOrders')->name('charities.orders.index');
    Route::get('charity/{charity}', 'CharityController@index')->name('charity.index')->middleware('slug_detect');
    Route::get('/charity/{charity_id}/profile/edit', 'CharityController@show');
    Route::put('/charity/{charity_id}/profile/edit', 'CharityController@update');
    Route::get('charity/{id}/report', 'CharityController@report')->name('charity.report');
    Route::get('charity/{id}/campaign', 'CharityCampaignController@index');    
    Route::get('charity/{id}/campaign/list-json', 'CharityCampaignController@list');
    Route::get('charity/{id}/campaign/create', 'CharityCampaignController@create');
    Route::get('charity/{id}/campaign/{campaignId}/edit', 'CharityCampaignController@edit');
    Route::post('charity/{id}/campaign/save', 'CharityCampaignController@createOrUpdate');
    Route::delete('charity-campaign/{id}', 'CharityCampaignController@destroy');        
});



// backend
Route::namespace('Admin')->middleware(['auth'])->group(function() {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        // sponsor
        Route::get('/sponsor/{sponsor_id}/home', 'AdminController@dashboardSponsor');
        Route::middleware(['superadmin'])->group(function() {
            Route::resource('sponsors', 'SponsorController')->only(['index', 'show', 'create']);
            Route::prefix('sponsors/{sponsor_id}/users')->group(function() {
                Route::get('create', 'SponsorController@createUser')->name('sponsors.user.create');
                Route::get('{user_id}', 'SponsorController@editUser')->name('sponsors.user.edit');
            });
        });

        Route::resource('charities', 'CharityController')->only(['index', 'show', 'create', 'edit']);
        Route::get('/charity/{charity_id}/home', 'AdminController@dashboardCharity');

        Route::resource('events', 'EventController')->only(['index', 'show', 'create', 'edit']);
        Route::get('/event/{event_id}/home', 'AdminController@dashboardEvent');
        Route::resource('users', 'UserController')->only(['index', 'show', 'create', 'edit']);
        Route::get('/user/{user}/change-password', 'UserController@changePassword');
        Route::post('/user/{user}/change-password', 'UserController@savePassword');
        Route::resource('products', 'ProductController')->only(['index', 'show', 'create', 'edit']);
        Route::resource('locations', 'LocationController')->only(['index', 'show', 'create', 'edit']);
        Route::resource('orders', 'OrderController')->only(['index', 'show', 'create', 'edit']);
        Route::resource('designs', 'DesignController')->only(['index', 'show', 'create', 'edit']);

        Route::resource('/assets', 'AssetController')->only(['index', 'show', 'create', 'edit']);

    });
});


Route::prefix('internal')->group(function() {

    Route::middleware(['auth'])->group(function() {
        // sponsor
        Route::get('sponsors', 'InternalController@sponsors');
        Route::get('sponsor/{sponsor_id}', 'InternalController@sponsorDetails');
        Route::get('sponsor/{sponsor_id}/users', 'InternalController@usersWithSponsorId');
        Route::post('sponsor/user', 'InternalController@createOrUpdateUserUnderSponsor');
        Route::post('sponsor', 'InternalController@createOrUpdateSponsor');
        Route::delete('sponsor/{sponsor_id}', 'InternalController@deleteSponsor');

        // charity
        Route::get('charities', 'InternalController@charities');
        Route::get('charity/{charity_id}', 'InternalController@charityDetails');
        Route::post('charity', 'InternalController@createOrUpdateCharity');
        Route::delete('charity/{charity_id}', 'InternalController@deleteCharity');

        // Asset
        Route::get('/assets', 'InternalController@Assets');
        Route::get('asset/{asset_id}', 'InternalController@assetDetails');
        Route::post('asset', 'InternalController@createOrUpdateAsset');
        Route::delete('asset/{asset_id}', 'InternalController@deleteAsset');

        // event
        Route::get('events', 'InternalController@events');
        Route::get('event/{event_id}', 'InternalController@eventDetails');
        Route::post('event', 'InternalController@createOrUpdateEvent');
        Route::delete('event/{event_id}', 'InternalController@deleteEvent');
        Route::post('event/register', 'InternalController@registerEvent');

        // user
        Route::get('users', 'InternalController@users');
        Route::delete('user/{user_id}', 'InternalController@deleteUser');
        Route::post('user', 'InternalController@createOrUpdateUser');
        Route::get('/user/{user_id}/dashboard_achievements', 'InternalController@dashboardAchievements');

        // product
        Route::get('products', 'InternalController@products');
        Route::post('product', 'InternalController@createOrUpdateProduct');
        Route::delete('product/{product_id}', 'InternalController@deleteProduct');
        Route::put('product/{product_id}/category/{category_id}', 'InternalController@addProductToCategory');
        Route::delete('product/{product_id}/category/{category_id}', 'InternalController@deleteProductFromCategory');
        Route::put('product/{product_id}/size/{size_id}', 'InternalController@addProductToSize');
        Route::delete('product/{product_id}/size/{size_id}', 'InternalController@deleteProductFromSize');

        // location
        Route::get('locations', 'InternalController@locations');
        Route::post('address', 'InternalController@createAddress');
        Route::get('address/{user_id}', 'InternalController@getAddress');
        Route::post('location', 'InternalController@createOrUpdateLocation');
        Route::delete('location/{location_id}', 'InternalController@deleteLocation');

        // order
        Route::get('orders', 'InternalController@orders');
        Route::post('order/item', 'InternalController@createOrUpdateOrderItem');
        Route::post('order', 'InternalController@updateOrder');
        Route::post('order/place', 'InternalController@placeOrder');
        Route::get('order/{order_id}/shipping_rate', 'InternalController@getLowestCarrierRate');

        // billing
        Route::post('billing', 'InternalController@createBilling');
        Route::get('sponsor/{sponsor_id}/billing', 'InternalController@getBillingsWithSponsorId');
        Route::get('sponsor/{user_id}/billing', 'InternalController@getBillingsWithUserId');
        Route::get('sponsor/{user_id}/cards', 'BillingController@index');
        Route::post('billing/card', 'InternalController@updateBilling');

        // design
        Route::get('designs', 'InternalController@designs');
        Route::post('design/upload', 'InternalController@uploadDesignFile');
        Route::post('design', 'InternalController@createOrUpdateDesign');
        Route::delete('design/{design_id}', 'InternalController@deleteDesign');

        // extra
        Route::post('image/upload', 'InternalController@uploadImage');        

        // profile
        Route::get('profile', 'ProfileController@index')->name('profile');
    });
});
Route::get('{slug}', 'SlugController@fetch')->name('slug.fetch')->middleware(['auth']);