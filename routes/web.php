<?php
// backend modules
use App\Http\Controllers\Admin\FaqController;

// frontend pages
use App\Http\Controllers\WebsiteController;

Route::controller(WebsiteController::class)->group(function() {
    Route::get('/', 'index')->name('welcome');
    // header routes
    Route::get('info', 'info')->name('info');
    Route::get('customize', 'customization')->name('customize');
    Route::get('customize-details', 'customizationDetail')->name('customize-details');
    Route::get('signin', 'signin')->name('signin');
    Route::get('signup', 'signup')->name('signup');
    Route::get('uploads', 'uploadImages')->name('uploads');
    // footer routes
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('testimonials', 'testimonial')->name('testimonials');
    Route::get('image-research', 'imageResearch')->name('image-research');
    Route::get('pricing-info', 'pricingTable')->name('pricing-info');
    Route::get('licencing', 'licenceInfo')->name('licencing');
    Route::get('terms-of-use', 'termsofUse')->name('terms-of-use');
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('contact-us', 'contactUs')->name('contact-us');
    Route::get('search-tips', 'searchTips')->name('search-tips');
    Route::get('faq', 'faqs')->name('faq');
    Route::get('technical', 'technicals')->name('technical');
    // seller authentication
    Route::get('seller-registration', 'sellerReg')->name('seller-registration');
    Route::get('seller-login', 'sellerLog')->name('seller-login');
    // designer profile
    Route::get('designer-profile', 'designerProfile')->name('designer-profile');
});


Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // faqs
    Route::resource('faqs', 'FaqController');
    Route::delete('faqs/massDestroy', 'FaqController@massDestroy')->name('faqs.massDestroy');

    // testimonials
    Route::resource('testimonials', 'TestimonialController');
    Route::delete('testimonials/massDestroy', 'TestimonialController@massDestroy')->name('testimonial.massDestroy');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
