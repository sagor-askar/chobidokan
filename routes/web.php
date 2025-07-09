<?php
// backend modules
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;

// frontend pages
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WebsiteController;

Route::controller(WebsiteController::class)->group(function() {
    Route::get('/', 'index')->name('welcome');
    // header routes
    Route::get('info', 'info')->name('info');
    Route::get('customize', 'customization')->name('customize');
    Route::get('customize-details', 'customizationDetail')->name('customize-details');
    Route::get('job-submission', 'submission')->name('job-submission');
    Route::get('closed-jobs', 'closedJobs')->name('closed-jobs');
    Route::get('signin', 'signin')->name('signin');
    Route::get('signup', 'signup')->name('signup');
    Route::get('uploads', 'uploadImages')->name('uploads');
    Route::get('submission-guidelines', 'guidelines')->name('submission-guidelines');
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
    Route::get('seller-dashboard', 'sellerDash')->name('seller-dashboard');
    // designer profile
    Route::get('designer-profile', 'designerProfile')->name('designer-profile');
});

// user dashboard route
Route::get('/user-dashboard', function () {
    return view('frontend.profiles.userProfile');
})->name('dashboard');

//user & seller Registration
Route::post('/user/register', 'Auth\RegisterController@userRegister')->name('user.register');
Route::post('/user-login', 'Auth\LoginController@customLogin')->name('customLogin');
Route::post('/seller/register', 'Auth\RegisterController@sellerRegister')->name('seller.register');


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

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // faqs
    Route::resource('faqs', 'FaqController');
    Route::delete('faqs/massDestroy', 'FaqController@massDestroy')->name('faqs.massDestroy');

    // testimonials
    Route::resource('testimonials', 'TestimonialController');
    Route::delete('testimonials/massDestroy', 'TestimonialController@massDestroy')->name('testimonial.massDestroy');

    // Privacy & policy
    Route::get('privacy-policy', 'SettingController@privacyPolicy')->name('privacy.policy');
    Route::post('privacy-policy/store', 'SettingController@privacyPolicyStore')->name('privacy.store');

    // Terms of Use
    Route::get('terms-of-use', 'SettingController@termsOfUse')->name('terms.use');
    Route::post('terms-of-use/store', 'SettingController@termsOfUseStore')->name('terms.use.store');

    // Licencing
    Route::get('licencing', 'SettingController@licencing')->name('licencing.info');
    Route::post('licencing/store', 'SettingController@licencingStore')->name('licencing.info.store');

    // Search Tips
    Route::get('search-tips', 'SettingController@searchTips')->name('search.tips');
    Route::post('search-tips/store', 'SettingController@searchTipsStore')->name('search.tips.store');

    // Technical
    Route::get('technical-info', 'SettingController@technicalInfo')->name('technical.info');
    Route::post('technical-info/store', 'SettingController@technicalInfoStore')->name('technical.info.store');

    // Image Research
    Route::get('image-research', 'SettingController@imgResearch')->name('img.research');
    Route::post('image-research/store', 'SettingController@imgResearchStore')->name('img.research.store');

    // software settings
    Route::get('settings', 'SettingController@setting')->name('settings');
    Route::post('settings/store', 'SettingController@store')->name('settings.store');

    // Info Setup
    Route::get('info', 'SettingController@infoSetup')->name('info.setup');
    Route::post('info/store', 'SettingController@infoSetupStore')->name('info.setup.store');

});

Route::group(['middleware' => ['custom_auth','is_unbanned']], function () {
    Route::get('/custom-request', [WebsiteController::class, 'customRequest'])->name('custom-request');
    Route::post('/project-store', [ProjectController::class, 'projectStore'])->name('project.store');

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
